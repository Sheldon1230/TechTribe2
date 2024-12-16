let isQuizStarted = false; // Flag to track quiz start
let timeRemaining = 300;   // Total quiz time in seconds
let timer;                 // Variable to hold the interval reference

// Function to show tutorial prompt
function showTutorialPrompt() {
    const confirmation = confirm("Start the tutorial? Once you start, the timer will begin.");
    if (confirmation) {
        document.getElementById('quiz-container').style.display = 'block';
        startQuiz();
    } else {
        window.location.href = 'cousers.php'; // Redirect if user cancels
    }
}

// Function to start the quiz and timer
function startQuiz() {
    // Start Timer
    timer = setInterval(() => {
        timeRemaining--;
        document.getElementById('time').innerText = timeRemaining;

        if (timeRemaining <= 0) {
            clearInterval(timer); // Stop timer
            alert("Time's up! Submitting your quiz...");
            document.getElementById('quiz-form').submit();
        }
    }, 1000);

    // Ensure quiz container is visible
    document.getElementById('quiz-container').style.display = 'block';
}

// Fetch questions from the backend
fetch('S_fetch_question.php')
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

            // Show prompt only if quiz hasn't started
            if (!isQuizStarted) {
                showTutorialPrompt();
                isQuizStarted = true;
            }
        }
    })
    .catch(err => {
        document.getElementById('questions').innerHTML = `
            <div class="question" style="text-align: center; color: #E53E3E;">
                <p>Failed to load questions. Please try again later.</p>
            </div>`;
    });

// Handle form submission
document.getElementById('quiz-form').addEventListener('submit', function (e) {
    e.preventDefault();

    // Disable submit button
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
                const resultDiv = document.getElementById('result');
                resultDiv.style.opacity = '0';
                resultDiv.innerHTML = `<h2>${data.message}</h2>`;
                setTimeout(() => {
                    resultDiv.style.transition = 'opacity 0.5s ease';
                    resultDiv.style.opacity = '1';
                }, 100);

                // Redirect to results page
                setTimeout(() => {
                    window.location.href = 'results_page.php';
                }, 3000);
            } else {
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
