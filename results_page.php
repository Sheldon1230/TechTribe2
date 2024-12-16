<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="quiz.css"> <!-- Include your existing quiz CSS for styling -->
</head>
<body>
    <div id="results-container">
        <h1>Quiz Results</h1>

        <!-- Latest quiz score -->
        <div id="latest-score">
            <h2>Your Latest Score</h2>
            <p>Score: <span id="current-score"></span>/10</p>
            <p><strong>Date:</strong> <span id="quiz-date"></span></p>
        </div>

        <!-- Previous quiz scores -->
        <div id="previous-scores">
            <h2>Previous Scores</h2>
            <table class="results-table" id="score-table">
                <thead>
                    <tr>
                        <th>Quiz Date</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Previous scores will be populated here -->
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        // Fetch the latest score and previous scores from the database
        fetch('fetch_score.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('latest-score').innerHTML = `
                        <p style="color: #E53E3E;">${data.error}</p>
                    `;
                } else {
                    // Display latest score
                    document.getElementById('current-score').textContent = data.latest_score.score;
                    document.getElementById('quiz-date').textContent = data.latest_score.quiz_date;

                    // Display previous scores
                    let scoresHtml = '';
                    data.previous_scores.forEach(score => {
                        scoresHtml += `
                            <tr>
                                <td>${score.quiz_date}</td>
                                <td>${score.score}</td>
                            </tr>
                        `;
                    });

                    document.getElementById('score-table').querySelector('tbody').innerHTML = scoresHtml;
                }
            })
            .catch(err => {
                document.getElementById('latest-score').innerHTML = `
                    <p style="color: #E53E3E;">Failed to load quiz results. Please try again later.</p>
                `;
            });
    </script>
</body>
</html>

</html>
