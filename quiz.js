// Check if user is ready to start
function showTutorialPrompt() {
    const confirmation = confirm("Start the tutorial? Once you start, the timer will begin.");
    if (confirmation) {
        document.getElementById('quiz-container').style.display = 'block';
        startQuiz();
    } else {
        window.location.href = 'tutorial_page.html'; // Redirect to the tutorial page
    }
}

function startQuiz() {
    // Timer already starts automatically, no need to add extra logic
    document.getElementById('quiz-container').style.display = 'block';
}

// Call fetch and prepare the tutorial prompt
fetch('fetch_questions.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            document.getElementById('questions').innerHTML = `
                <div class="question" style="text-align: center; color: #E53E3E;">
                    <p>${data.error}</p>
                </div>`;
        } else {
            let questionsHtml = '';
            data.forEach((question, index) => {
                questionsHtml += `
                    <div class="question">
                        <p>${index + 1}. ${question.question}</p>
                        <label class="radio-container">
                            ${question.option_a}
                            <input type="radio" name="question_${question.id}" value="A" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">
                            ${question.option_b}
                            <input type="radio" name="question_${question.id}" value="B">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">
                            ${question.option_c}
                            <input type="radio" name="question_${question.id}" value="C">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">
                            ${question.option_d}
                            <input type="radio" name="question_${question.id}" value="D">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                `;
            });
            document.getElementById('questions').innerHTML = questionsHtml;

            // Display prompt after fetching questions
            showTutorialPrompt();
        }
    })
    .catch(err => {
        document.getElementById('questions').innerHTML = `
            <div class="question" style="text-align: center; color: #E53E3E;">
                <p>Failed to load questions. Please try again later.</p>
            </div>`;
    });

    //Pause the timer
    if (timeRemaining <= 0) {
        clearInterval(timer);
        alert("Time's up! Submitting your quiz...");
        document.getElementById('quiz-form').submit();
    }


    // Handle form submission with animation
    document.getElementById('quiz-form').addEventListener('submit', function (e) {
        e.preventDefault();

        // Disable submit button and show loading state
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = 'Submitting...';

        const formData = new FormData(this);

        fetch('submit_quiz.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // Show result with animation (optional)
                    const resultDiv = document.getElementById('result');
                    resultDiv.style.opacity = '0';
                    resultDiv.innerHTML = `<h2>${data.message}</h2>`;

                    // Fade in animation
                    setTimeout(() => {
                        resultDiv.style.transition = 'opacity 0.5s ease';
                        resultDiv.style.opacity = '1';
                    }, 100);

                    // Redirect to results page after a short delay
                    setTimeout(() => {
                        window.location.href = 'results_page.html'; // Redirect after showing results
                    }, 3000); // Adjust delay as needed (3000ms = 3 seconds)
                } else {
                    // Handle error message
                    document.getElementById('result').innerHTML = `
                        <div style="color: #E53E3E;">
                            <p>${data.error || 'Submission failed. Please try again.'}</p>
                        </div>`;
                }
                submitButton.disabled = false;
                submitButton.innerHTML = 'Submit Quiz';
            })
            .catch(err => {
                document.getElementById('result').innerHTML = `
                    <div style="color: #E53E3E;">
                        <p>Submission failed. Please try again.</p>
                    </div>`;
                submitButton.disabled = false;
                submitButton.innerHTML = 'Submit Quiz';
            });
    });

    
    