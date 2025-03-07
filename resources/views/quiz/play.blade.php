
    <div class="container">
        <h3>Quiz: {{ $quiz->title }}</h3>
        <p>Time Remaining: <span id="timer">{{ $remainingTime }}</span> seconds</p>
        <div id="question-box">
            <h4 id="question-text"></h4>
            <ul id="options">
                <li><button class="option-btn" data-option="a"></button></li>
                <li><button class="option-btn" data-option="b"></button></li>
                <li><button class="option-btn" data-option="c"></button></li>
                <li><button class="option-btn" data-option="d"></button></li>
            </ul>
        </div>
        <button id="next-question" class="btn btn-primary mt-3">Next Question</button>
    </div>

    <script>
        let questions = @json($questions);
        let currentQuestionIndex = 0;
        let quizId = {{ $quiz->id }};
        let totalTime = {{ $remainingTime }};
        let timer;

        function loadQuestion() {
            if (currentQuestionIndex >= questions.length || totalTime <= 0) {
                alert("Quiz Finished!");
                window.location.href = "/quiz/" + quizId + "/results";
                return;
            }

            let question = questions[currentQuestionIndex];
            document.getElementById('question-text').innerText = question.question;
            document.querySelectorAll('.option-btn').forEach((btn, index) => {
                let option = ['option_a', 'option_b', 'option_c', 'option_d'][index];
                btn.innerText = question[option];
                btn.onclick = () => submitAnswer(question.id, btn.dataset.option);
            });
        }

        function submitAnswer(questionId, selectedOption) {
            clearInterval(timer);

            fetch(`/quiz/${quizId}/question/${questionId}/submit`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ selected_option: selectedOption })
            }).then(res => res.json()).then(data => {
                currentQuestionIndex++;
                loadQuestion();
                startTimer();  
            });
        }

        function startTimer() {
            timer = setInterval(() => {
                if (totalTime > 0) {
                    totalTime--;
                    document.getElementById("timer").innerText = totalTime;
                } else {
                    clearInterval(timer);
                    alert("Time's up! The quiz will now end.");
                    window.location.href = "/quiz/" + quizId + "/results"; // Redirect to results page
                }
            }, 1000);
        }

        document.getElementById("next-question").addEventListener("click", loadQuestion);

        loadQuestion(); // Start the quiz when the page loads
        startTimer(); // Start the timer when the page loads
    </script>
