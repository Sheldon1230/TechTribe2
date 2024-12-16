const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

// Toggle Sidebar
toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
});

// Expand Sidebar on Search Click
if (searchBtn) {
    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    });
}

// Toggle Dark Mode
if (modeSwitch) {
    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");
        
        if(body.classList.contains("dark")){
            modeText.innerText = "Light mode";
        } else {
            modeText.innerText = "Dark mode";
        }
    });
}

//Button functions
function myButtonClassroom() {
  window.location.href = '#Classroom';
}

function myButtonPlan() {
  window.location.href = '#Plan';
}

function myButtonInsight() {
  window.location.href = '#Insight';
}

//Show the dashboard section by default
function myButtonDashboard() {
  window.location.href = '#Dashboard';
}

// See More Button
function showSection(sectionId) {
  // Hide all sections
  const sections = document.querySelectorAll('section');
  sections.forEach(section => section.classList.remove('active'));

  // Show the selected section
  const activeSection = document.getElementById(sectionId);
  if (activeSection) activeSection.classList.add('active');
}

// Pie Chart
$(document).ready(function () {
  $.ajax({
      url: "pie_chart_data.php", // Correct file path
      method: "GET",
      success: function (data) {
          console.log("Data received:", data); // Check the console for the data
          
          var names = [];   // For chart labels
          var values = [];  // For chart data

          for (var i in data) {
              // Correct keys based on JSON output
              names.push(data[i]['lan_name']);
              values.push(data[i]['progress']);
          }

          var chartdata = {
              labels: names,
              datasets: [{
                  label: 'Progress',
                  backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                  data: values
              }]
          };

          // Render Chart.js
          var graphTarget = $("#graphCanvas");
          new Chart(graphTarget, {
              type: 'pie',
              data: chartdata
          });
      },
      error: function (error) {
          console.log("Error fetching data:", error);
      }
  });
});

//Pie Chart 2
document.addEventListener("DOMContentLoaded", function () {
    // Fetch data for the pie charts
    fetch("student_performance.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "success") {
                createPieCharts(data.data);
            } else {
                console.error("Error fetching data:", data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });

    function createPieCharts(data) {
        // Get unique task names
        const taskNames = [...new Set(data.map((row) => row.task_name))];

        // Calculate data for Completion Rate pie chart
        const completionRateByTask = taskNames.map((task) => {
            const taskData = data.filter((row) => row.task_name === task);
            return taskData.reduce((sum, row) => sum + row.completion_rate, 0) / taskData.length;
        });

        // Calculate data for Time Spent pie chart
        const timeSpentByTask = taskNames.map((task) => {
            const taskData = data.filter((row) => row.task_name === task);
            return taskData.reduce((sum, row) => sum + row.time_spent, 0);
        });

        // Calculate data for Core Concept Understanding pie chart
        const coreUnderstandingByTask = taskNames.map((task) => {
            const taskData = data.filter((row) => row.task_name === task);
            return taskData.reduce((sum, row) => sum + row.core_concept_understanding, 0) / taskData.length;
        });

        // Render the Completion Rate pie chart
        const completionRateChart = document.getElementById("completionRateChart");
        if (completionRateChart) {
            new Chart(completionRateChart, {
                type: "pie",
                data: {
                    labels: taskNames,
                    datasets: [
                        {
                            label: "Completion Rate (%)",
                            data: completionRateByTask,
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"],
                        },
                    ],
                },
            });
        }

        // Render the Time Spent pie chart
        const timeSpentChart = document.getElementById("timeSpentChart");
        if (timeSpentChart) {
            new Chart(timeSpentChart, {
                type: "pie",
                data: {
                    labels: taskNames,
                    datasets: [
                        {
                            label: "Time Spent (Seconds)",
                            data: timeSpentByTask,
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"],
                        },
                    ],
                },
            });
        }

        // Render the Core Concept Understanding pie chart
        const coreUnderstandingChart = document.getElementById("coreUnderstandingChart");
        if (coreUnderstandingChart) {
            new Chart(coreUnderstandingChart, {
                type: "pie",
                data: {
                    labels: taskNames,
                    datasets: [
                        {
                            label: "Core Concept Understanding (%)",
                            data: coreUnderstandingByTask,
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"],
                        },
                    ],
                },
            });
        }
    }
});

//Data for the table
document.addEventListener("DOMContentLoaded", function () {
  // Fetch data from the database
  fetch("student_performance.php") // Ensure the correct PHP endpoint
      .then((response) => response.json()) // Parse response as JSON
      .then((data) => {
          if (data.status === "success") {
              populateTable(data.data); // Populate table with data
          } else {
              console.error("Error:", data.message);
          }
      })
      .catch((error) => {
          console.error("Error fetching data:", error);
      });

  // Function to populate the table
  function populateTable(data) {
      const tableBody = document.querySelector("#performanceTable tbody");
      tableBody.innerHTML = ""; // Clear any existing rows

      // Loop through the data and create table rows
      data.forEach((row) => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
              <td>${row.name}</td>
              <td>${row.task_name}</td>
              <td>${row.completion_rate}</td>
              <td>${row.time_spent}</td>
              <td>${row.core_concept_understanding}</td>
          `;
          tableBody.appendChild(tr); // Append row to table body
      });
  }
});


// Table
$(document).ready(function(){
  $('#data_table').Tabledit({
  deleteButton: false,
  editButton: false,
  columns: {
  identifier: [0, 'id'],
  editable: [[1, 'name'], [2, 'gender'], [3, 'age'], [4, 'designation'], [5, 'address']]
  },
  hideIdentifier: true,
  url: 'table_config.php'
  });
});

//The Student Dropdown
document.addEventListener("DOMContentLoaded", function () {
  // Fetch students and populate the dropdown
  fetch("get_students.php")
      .then(response => response.json())
      .then(data => {
          const studentDropdown = document.getElementById("student-list");
          data.forEach(student => {
              const option = document.createElement("option");
              option.value = student.id; // Use student ID as the value
              option.textContent = student.name; // Display student name
              studentDropdown.appendChild(option);
          });
      })
      .catch(error => {
          console.error("Error fetching students:", error);
      });

  // Add event listener to the dropdown
  const studentDropdown = document.getElementById("student-list");
  studentDropdown.addEventListener("change", function () {
      const selectedStudentId = this.value;
      if (selectedStudentId) {
          // Fetch data for the selected student
          fetch(`get_student_data.php?student_id=${selectedStudentId}`)
              .then(response => response.json())
              .then(data => {
                  if (data.error) {
                      console.error(data.error);
                      alert(data.error);
                      return;
                  }

                  // Update the content of the four boxes
                  document.querySelector(".details-info-1 h1").textContent = `${data.time_spent} hrs`;
                  document.querySelector(".details-info-2 .text-answer").textContent = data.questions_answered;
                  document.querySelector(".details-info-3 .completed-list").textContent = data.lessons_completed;
                  document.querySelector(".details-info-4 h1").textContent = `${data.challenges_solved} solved`;
              })
              .catch(error => {
                  console.error("Error fetching student data:", error);
              });
      }
  });
});

//The Classroom Dropdown
function loadClassroom() {
  const classroom = document.getElementById('classroom-dropdown').value;

  if (classroom) {
      fetch('fecth_classroom.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `classroom=${encodeURIComponent(classroom)}`
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              document.getElementById('content').innerHTML = `<h2>${classroom}</h2><p>${data.content}</p>`;
          } else {
              document.getElementById('content').innerHTML = `<p style="color: red;">${data.message}</p>`;
          }
      })
      .catch(error => {
          console.error('Error:', error);
          document.getElementById('content').innerHTML = `<p style="color: red;">An error occurred. Please try again later.</p>`;
      });
  } else {
      alert('Please select a classroom!');
  }
}


//Test
document.addEventListener("DOMContentLoaded", function() {
  // Fetch student performance data from PHP
  fetch('get_student_performance.php')
      .then(response => response.json())
      .then(data => {
          populateTable(data);
          visualizeMetrics(data);
      })
      .catch(error => {
          console.error("Error fetching data:", error);
      });

  // Function to populate the table with student performance data
  function populateTable(data) {
      const tableBody = document.querySelector('#performanceTable tbody');
      tableBody.innerHTML = ''; // Clear existing rows

      data.forEach(row => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
              <td>${row.name}</td>
              <td>${row.task_name}</td>
              <td>${row.completion_rate}</td>
              <td>${row.time_spent}</td>
              <td>${row.core_concept_understanding}</td>
          `;
          tableBody.appendChild(tr);
      });
  }

  // Function to visualize key metrics (e.g., Completion Rates, Time Spent, Core Concept Understanding)
  function visualizeMetrics(data) {
      const completionRates = data.map(row => row.completion_rate);
      const timeSpent = data.map(row => row.time_spent);
      const coreUnderstanding = data.map(row => row.core_concept_understanding);
      const studentNames = [...new Set(data.map(row => row.name))]; // Get unique student names

      // Completion Rates Chart
      new Chart(document.getElementById('completionRateChart'), {
          type: 'bar',
          data: {
              labels: studentNames,
              datasets: [{
                  label: 'Completion Rate (%)',
                  data: completionRates,
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              scales: {
                  y: { beginAtZero: true }
              }
          }
      });

      // Time Spent Chart
      new Chart(document.getElementById('timeSpentChart'), {
          type: 'line',
          data: {
              labels: studentNames,
              datasets: [{
                  label: 'Time Spent (Seconds)',
                  data: timeSpent,
                  backgroundColor: 'rgba(255, 159, 64, 0.2)',
                  borderColor: 'rgba(255, 159, 64, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true
          }
      });

      // Core Understanding Chart
      new Chart(document.getElementById('coreUnderstandingChart'), {
          type: 'radar',
          data: {
              labels: studentNames,
              datasets: [{
                  label: 'Core Concept Understanding (%)',
                  data: coreUnderstanding,
                  backgroundColor: 'rgba(153, 102, 255, 0.2)',
                  borderColor: 'rgba(153, 102, 255, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true
          }
      });
  }
});
