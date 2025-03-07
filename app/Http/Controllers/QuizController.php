<?php

// app/Http/Controllers/QuizController.php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function startQuiz()
    {
        $quiz = Quiz::where('is_active', true)->first();

        if (!$quiz) {
            
            $quiz = Quiz::create([
                'is_active' => true,
                'start_time' => Carbon::now(),
                'duration' => 60 * 30 
            ]);
        }

        return redirect()->route('quiz.play', ['quiz' => $quiz->id]);
    }

    public function playQuiz($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        $questions = Question::inRandomOrder()->limit(20)->get();

        $elapsedTime = Carbon::now()->diffInSeconds($quiz->start_time);
        $remainingTime = $quiz->duration - $elapsedTime;

        if ($remainingTime <= 0) {
            return redirect()->route('quiz.end', ['quiz' => $quizId]);
        }

        return view('quiz.play', compact('quiz', 'questions', 'remainingTime'));
    }

    public function submitAnswer(Request $request, $quizId, $questionId)
    {
        $question = Question::findOrFail($questionId);
        $user = Auth::user();

        $isCorrect = $request->selected_option === $question->correct_option;

        UserAnswer::create([
            'user_id' => $user->id,
            'quiz_id' => $quizId,
            'question_id' => $questionId,
            'selected_option' => $request->selected_option,
            'is_correct' => $isCorrect,
        ]);

        return response()->json(['success' => true, 'is_correct' => $isCorrect]);
    }

    public function endQuiz($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $quiz->update(['is_active' => false]);

        $winner = UserAnswer::where('quiz_id', $quizId)
            ->select('user_id')
            ->groupBy('user_id')
            ->orderByRaw('SUM(is_correct) DESC')
            ->first();

        if ($winner) {
            $quiz->update(['winner_id' => $winner->user_id]);
        }

        return redirect()->route('quiz.results', ['quiz' => $quizId]);
    }

    public function showResults($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $winner = $quiz->winner ? $quiz->winner->name : 'No winner';

        return view('quiz.results', compact('quiz', 'winner'));
    }
}
