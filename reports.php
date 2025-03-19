    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reports</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Montserrat', sans-serif;
            }
            body {
                display: flex;
                background-color: rgb(249, 244, 239);
            }
            .sidebar {
                width: 250px;
                background-color: rgb(255, 255, 255);
                box-shadow: 3px 3px 10px #f5dbcb;
                min-height: 95vh;
                padding: 10px;
                display: flex;
                flex-direction: column;
                border-radius: 20px;
                font-size: 20px;
            }
            .sidebar h1 {
                text-align: center;
                margin: 20px;
                font-size: 30px;
                font-weight: 900;
                background: linear-gradient(90deg, #fec961, #ff9800); 
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                margin-bottom: 50px;
            }
            .menu {
                list-style: none;
            }
            .menu li a {
                text-decoration: none;
                color: rgb(205, 94, 3);
                display: flex;
                width: 100%;
                padding: 20px;
            }
            .menu li:hover a, .menu li a.active  {
            background: #ffffff;
            border-radius:4px;
            border-left: 4px solid rgb(106, 70, 3);
            box-shadow: inset 4px 4px 6px rgba(0, 0, 0, 0.3), 
                        inset -8px -8px 10px rgba(255, 255, 255, 0.7);
            transform: scale(1.02); 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
            .menu li {
                padding: 10px;
                cursor: pointer;
                display: flex;
            }
            .menu li i {
                margin-right: 15px;
            }
            .main-content {
                flex: 1;
                padding: 20px;
            }
            .dashboard-header {
                font-size: 25px;
                font-weight: bold;
                margin-bottom: 20px;
                padding-bottom: 15px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 3px solid #f6c77f;
                color: #f99858;
            }
            .header-right {
                display: flex;
                align-items: center;
            }
            .lupon-btn {
                background-color: #ffffff; 
                color: #db8505;
                padding: 12px 24px;
                border-radius: 12px;
                font-weight: bold;
                font-size: 16px;
                cursor: pointer;
                border: 3px solid #db8505; 
                display: flex;
                align-items: center;
                gap: 8px; 
                transition: all 0.3s ease-in-out;
            }
            .lupon-btn:hover {
                background-color: #db8505;
                color: #ffffff;
                transform: translateY(-3px);
            }
            .reports-section {
                margin-top: 30px;
                display: flex;
        justify-content: center; /* Centers chart-container horizontally */
        align-items: center; /* Centers vertically (optional) */
        width: 100%;
            }
            .chart-container {
    position: relative; /* Important to make absolute positioning work */
    margin-top: 30px;
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    height: 50vh;
    width: 100%;
    max-width: 1200px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.year-selector {
    position: absolute;
    top: 10px;
    right: 10px;
    background: white;
    color: #a85d2b;
    font-weight: bold;
    border: 2px solid #a85d2b;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    z-index: 10; /* Ensures it appears above the chart */
}
                canvas {
        width: 100% !important; /* Force it to take full width */
        height: 100% !important; /* Adjust height dynamically */
    }


            .chart-container h2 {
                margin-bottom: 10px;
                color: #db8505;
                font-size: 20px;
            }
            
            .table-container {
        margin-top: 20px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .filter-container {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 10px;
        background: #f5dbcb;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .filter-container input {
        border: none;
        background: transparent;
        font-size: 14px;
        color: #db8505;
        outline: none;
    }

    .filter-container i {
        color: #db8505;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 2px solid #db8505;
    }

    th, td {
        border: 1px solid #db8505;
        padding: 10px;
        text-align: center;
    }

    th {
        background: white;
        color: #db8505;
        font-weight: bold;
    }

    .chart-wrapper {
        position: relative; /* Make this the reference for absolute positioning */
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
            .container {
                display: flex;
                justify-content: center;
                align-items: center; 
                height: 100vh;
            }
                
        </style>
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <h1>LUPON</h1>
                <ul class="menu">
                    <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="cases.php"><i class="fas fa-balance-scale"></i> Cases</a></li>
                    <li><a href="reports.php" class="active"><i class="fas fa-chart-line"></i> Reports</a></li>
                    <li><a href="archive.php"><i class="fas fa-archive"></i> Archive</a></li>
                    <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </div>
        </div>
        
        <div class="main-content">
            <div class="dashboard-header">
                <span>Reports</span>
                <div class="header-right">
                    <button onclick="redirectToAuthorization(event)"class="lupon-btn">LOG OUT <i class="fas fa-sign-out-alt"></i></button>
                </div>
            </div>
            
            <div class="reports-section">
                <div class="chart-container">
                    <div class="chart-wrapper">
                        <canvas id="caseChart"></canvas>
                        <select class="year-selector" id="yearSelect"></select>
                    </div>
                </div>
                
            </div>

            <div class="table-container">
                <div class="filter-container">
                    <input type="month" id="filterDate" placeholder="Filter Date (yyyy-mm)">
                    <i class="fas fa-filter"></i>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Case ID</th>
                            <th>Complainant</th>
                            <th>Respondent</th>
                            <th>Title</th>
                            <th>Nature</th>
                            <th>Date Filed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
            
        </div>

        
        <script>

document.addEventListener("DOMContentLoaded", function() {
    const yearSelect = document.getElementById("yearSelect");
    const currentYear = new Date().getFullYear(); // Get current year

    // Populate dropdown with years from 2022 to the current year
    for (let year = currentYear; year >= 2022; year--) {  // Reverse order
        let option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }

    yearSelect.value = currentYear; // Set default selection to the current year
});

document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('caseChart').getContext('2d');
    let caseChart;

    function updateChart(year) {
        fetch(`configs/fetch_cases.php?year=${year}`)
            .then(response => response.json())
            .then(data => {
                console.log("Fetched Data for Year:", year, data); // Debugging

                if (!data.monthly_cases || !Array.isArray(data.monthly_cases)) {
                    console.error("Invalid monthly_cases data format.");
                    return;
                }

                if (caseChart) {
                    caseChart.destroy();
                }

                caseChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: `Cases Filed in ${year}`,
                            data: data.monthly_cases,
                            borderColor: '#db8505',
                            borderWidth: 2,
                            fill: false,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: `Monthly Case Filing Statistics (${year})`,
                                font: {
                                    size: 20,
                                    weight: 'bold'
                                },
                                color: '#db8505',
                                padding: {
                                    top: 10,
                                    bottom: 20
                                }
                            },
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    // Initialize chart with the default year
    const yearSelect = document.getElementById("yearSelect");
    updateChart(yearSelect.value); // Load the chart with the currently selected year

    // Handle year selection change
    yearSelect.addEventListener("change", function() {
        updateChart(this.value);
    });
});


        </script>
    </body>
    </html>
