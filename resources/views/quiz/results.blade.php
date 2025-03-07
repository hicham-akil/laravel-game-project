
    <div class="container">
        <h3>Quiz Results</h3>
        @if($winner)
            <p>The winner is: {{ $winner }}</p>
        @else
            <p>No winner for this quiz yet.</p>
        @endif

        <a href="{{ route('quiz.start') }}" class="btn btn-primary">Start New Quiz</a>
    </div>
