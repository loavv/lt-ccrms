<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            background-color:rgb(255, 255, 255);
            box-shadow: 3px 3px 10px #f5dbcb;
            min-height: 95vh;
            padding: 10px;
            display: flex;
            flex-direction: column;
            border-radius: 20px;
            font-size: 20px;
            margin-top: 23px;
            
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


        .logo {
            width: 50px; 
            height: auto;
        }
        .menu {
            list-style: none;
        }
        .menu li a {
            text-decoration: none;
            color:rgb(205, 94, 3);
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

        .menu i {
            justify-content: center;
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
            margin-top: 20px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #f6c77f;
            color: #f99858;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px; 
            transition: all 0.3s ease-in-out;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1),
                        -4px -4px 10px rgba(255, 255, 255, 0.1);
        }

        .lupon-btn i {
            color: #db8505; 
            font-size: 18px;
            transition: color 0.3s ease-in-out;
        }

        .lupon-btn:hover {
            background-color: #db8505;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.2),
                        -6px -6px 12px rgba(255, 255, 255, 0.1);
        }

        .lupon-btn:hover i {
            color: #ffffff; 
        }

        .lupon-btn:active {
            transform: translateY(1px);
            box-shadow: inset 3px 3px 6px rgba(0, 0, 0, 0.2),
                        inset -3px -3px 6px rgba(255, 255, 255, 0.1);
        }

        .lupon-btn i {
            margin-left: 5px;
        }
         /* Search & Filter Row */
         .search-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #f6c77f;
            margin-bottom: 11px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            border: 2px solid #d36c2f;
            border-radius: 25px;
            padding: 8px 15px;
            background: white;
            width: 300px;
        }

        .search-bar i {
            color: #d36c2f;
        }

        .search-bar input {
            border: none;
            outline: none;
            padding: 5px;
            margin-left: 8px;
            font-size: 14px;
            width: 200px;
        }

        .filters {
            display: flex;
            gap: 12px;
        }

        .filter-btn, .add-btn {
            background: #f6eee3;
            color: #683500;
            border: 2px solid #a85d2b;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background 0.3s ease;
        }

        .filter-btn:hover, .add-btn:hover {
            background: #b25624;
            color: white;
        }
      
        .table-container {
    max-height: 680px; /* Adjust height as needed */
    overflow-y: auto;
    display: block;
    border: 2px solid #f6c77f; /* Optional: Add border for visibility */
    border-radius: 8px; /* Optional: Rounded edges */
    background: white; /* Ensure the table background remains white */
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); /* Optional: Add shadow */
}

table {
    width: 100%; /* Ensure it takes full width */
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 2px solid #f6c77f;
}

th {
    background-color: #f6c77f;
    color: #683500;
    font-weight: bold;
}

tbody tr:nth-child(odd) {
    background-color: #f9f3eb;
}

tbody tr:hover {
    background-color: #f6eee3;
}


td i {
    color: #a85d2b;
    cursor: pointer;
    margin-right: 10px;
    font-size: 18px;
    transition: color 0.3s ease;
}

td i:hover {
    color: #b25624;
}
#addCaseModal h2 {
    margin-bottom: 20px;
    font-size: 40px;
    color: #a85d2b
}

.modal {
    font-family: 'Arial', sans-serif;  /* Set your preferred font */
    font-size: 15px;  /* Set a comfortable font size */
    color: black;  
    display:none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 700px;
    border: 2px solid #c76c2e;
    padding: 20px;
    border-radius: 10px;
    background: white;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    z-index: 1000;
}

.modal button {
   
    margin-top: 30px; /* Adjust the space between the button and the content above */
}

        h2 {
            margin-top: 0;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .inline {
            display: inline-block;
            width: 23%;
            margin-right: 2%;
        }
        .inline:last-child {
            margin-right: 0;
        }
        textarea, input {
            
            padding: 5px;
            margin-top: 5px;
        }
        .modal input, .modal textarea {
            border: 3px solid #c85c2e;
}

        .case {
            width: 100%;
            height:100px;
            border: 3px solid #c85c2e;

        }
        .radio-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section {
            margin-bottom: 15px;
        }
        button {
            background-color: #c76c2e;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            display: block;
            margin: auto;
        }
        button:hover {
            background-color: #a55a25;
        }
                

        .case-details-container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.case-left, .case-center, .case-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
}

textarea, input[type="text"], input[type="date"] {
    width: 100%;
    max-width: 250px;
}
.complainant-container {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.complainant-fields {
    display: grid;
    grid-template-columns: auto auto auto auto;
    gap: 10px;
    align-items: start;
}

.complainant-fields input {
    padding: 5px;
    border: 3px solid #c85c2e; /* Adjust to match your theme */
    border-radius: 3px;
    width: 150px; /* Adjust width as needed */
}

/* Adjusting the Add Complainant button to the right */
.add-complainant-container {
    display: flex;
    justify-content: flex-end; /* Align the button to the right */
    margin-top: 10px;
    width: 100%; /* Make sure the container takes full width */
}

.add-complainant {
    background-color: #c85c2e; /* Adjust button color */
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    width: 150px; /* Adjust width to suit */
    text-align: center;
}

.respondent-container {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.respondent-fields {
    display: grid;
    grid-template-columns: auto auto auto auto;
    gap: 10px;
    align-items: start;
}

.respondent-fields input {
    padding: 5px;
    border: 3px solid #c85c2e; /* Adjust to match your theme */
    border-radius: 3px;
    width: 150px; /* Adjust width as needed */
}

/* Adjusting the Add Respondent button to the right */
.add-respondent-container {
    display: flex;
    justify-content: flex-end; /* Align the button to the right */
    margin-top: 10px;
    width: 100%; /* Make sure the container takes full width */
}

.add-respondent {
    background-color: #c85c2e; /* Adjust button color */
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    width: 150px; /* Adjust width to suit */
    text-align: center;
    margin-bottom: 30px;
}

input[type="radio"]:checked {
    accent-color: #c85c2e;
}

.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    width: 500px;
    max-width: 90%;
}

.popup-content {
    background: white;
    width: 320px;
    padding: 20px;
    text-align: left;
    margin: 15% auto;
    border-radius: 10px;
    box-shadow: 0px 0px 10px #aaa;
    position: relative;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    color: red;
}

.case-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 10px;
}

.case-info-grid div {
    background: #f9f9f9;
    padding: 10px;
    border-radius: 5px;
}

.trash-icon {
    width: 50px;
    height: 50px;
    color: red;
}

.delete-text {
    font-size: 20px;
    font-weight: bold;
    margin: 10px 0;
}

.button-group {
    display: flex;
    justify-content: center;
    gap: 15px;  /* Ensures horizontal spacing */
    margin-top: 15px;
}

.yes-btn {
    background: #a50000;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    flex: 1;
    max-width: 100px;
}

.no-btn {
    background: lightgray;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    flex: 1;
    max-width: 100px;
}

    </style>
</head>
<body>
    <div class="container">

        <div class="sidebar">
            <h1>
             LUPON
            </h1>

            <ul class="menu">
                <li><a href="index.php"><i class="fas fa-home" ></i> Dashboard</a></li>
                <li><a href="cases.php" class = "active"><i class="fas fa-balance-scale"></i> Cases</a></li>
                <li><a href="reports.php"><i class="fas fa-chart-line" ></i> Reports</a></li>
                <li><a href="archive.php"><i class="fas fa-archive"></i> Archive</a></li>
                <li><a href="settings.php"><i class="fas fa-cog" ></i> Settings</a></li>
            </ul>

        </div>

    </div>

    <div class="main-content">

        <div class="dashboard-header">
            <span>Cases</span>
            <div class="header-right">
                
                <button onclick=" redirectToAuthorization(event)" class="lupon-btn">LOG OUT <i class="fas fa-sign-out-alt"></i></button>
            </div>
        </div>
        <div class="search-container">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search Case by Case ID">
            </div>
            <div class="filters">
                <select class="filter-btn">
                    <option value="all">ALL CASES</option>
                    <option value="criminal">Criminal Cases</option>
                    <option value="civil">Civil Cases</option>
                </select>
                <button class="add-btn"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Complainant</th>
                        <th>Respondent</th>
                        <th>Title</th>
                        <th>Nature</th>
                        <th>Date Filed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    include 'configs/config.php';

    $sql = "SELECT 
            c.case_no, 
            GROUP_CONCAT(DISTINCT CONCAT(p1.first_name, ' ', COALESCE(p1.middle_name, ''), ' ', p1.last_name, ' ', COALESCE(p1.suffix, '')) SEPARATOR ' & ') AS complainants,
            GROUP_CONCAT(DISTINCT CONCAT(p2.first_name, ' ', COALESCE(p2.middle_name, ''), ' ', p2.last_name, ' ', COALESCE(p2.suffix, '')) SEPARATOR ' & ') AS respondents,
            c.title, 
            c.nature, 
            c.file_date, 
            c.confrontation_date, 
            c.action_taken, 
            c.settlement_date, 
            c.exec_settlement_date, 
            c.main_agreement, 
            c.compliance_status, 
            c.remarks
        FROM cases c
        LEFT JOIN case_persons cp1 ON c.case_no = cp1.case_no AND cp1.role = 'Complainant'
        LEFT JOIN persons p1 ON cp1.person_id = p1.person_id
        LEFT JOIN case_persons cp2 ON c.case_no = cp2.case_no AND cp2.role = 'Respondent'
        LEFT JOIN persons p2 ON cp2.person_id = p2.person_id
        WHERE c.is_archived = 0
        GROUP BY c.case_no, c.title, c.nature, c.file_date, c.confrontation_date, c.action_taken, 
                 c.settlement_date, c.exec_settlement_date, c.main_agreement, c.compliance_status, c.remarks
        ORDER BY c.case_no ASC";


    $result = $conn->query($sql);

    if (!$result) {
        die("<tr><td colspan='7'>SQL Error: " . $conn->error . "</td></tr>");
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr id='row-{$row['case_no']}'>
                    <td>{$row['case_no']}</td>
                    <td>" . htmlspecialchars($row['complainants']) . "</td>
                    <td>" . htmlspecialchars($row['respondents']) . "</td>
                    <td>" . htmlspecialchars($row['title']) . "</td>
                    <td>" . htmlspecialchars($row['nature']) . "</td>
                    <td>" . htmlspecialchars($row['file_date']) . "</td>
                    <td>
                        <i class='fas fa-ellipsis-h case-details-btn' 
                            data-case-no='" . htmlspecialchars($row['case_no']) . "'
                            data-complainants='" . htmlspecialchars($row['complainants']) . "'
                            data-respondents='" . htmlspecialchars($row['respondents']) . "'
                            data-title='" . htmlspecialchars($row['title']) . "'
                            data-nature='" . htmlspecialchars($row['nature']) . "'
                            data-file-date='" . htmlspecialchars($row['file_date']) . "'
                            data-confrontation-date='" . htmlspecialchars($row['confrontation_date']) . "'
                            data-action='" . htmlspecialchars($row['action_taken']) . "'
                            data-settlement-date='" . htmlspecialchars($row['settlement_date']) . "'
                            data-exec-settlement-date='" . htmlspecialchars($row['exec_settlement_date']) . "'
                            data-main-agreement='" . htmlspecialchars($row['main_agreement']) . "'
                            data-compliance='" . htmlspecialchars($row['compliance_status']) . "'
                            data-remarks='" . htmlspecialchars($row['remarks']) . "'>
                        </i>
                        <i class='fas fa-edit'></i>
                        <i class='fas fa-trash-alt delete-btn' data-case-no='{$row['case_no']}'></i>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No cases found</td></tr>";
    }

    $conn->close();
    ?>
</tbody>


            </table>
        </div>
    </div>
       
    <div id="addCaseModal" class="modal">
    <span class="close-button">&times;</span>
    <h2>Add Case</h2>

        <form id="addCaseForm">
            <!-- Complainant -->
            <div class="complainant-container">
                <label>Complainant:</label>
                <div id="complainantFields">
                    <div class="complainant-fields">
                        <input type="text" name="complainant_first_name[]" placeholder="First Name" required>
                        <input type="text" name="complainant_middle_name[]" placeholder="Middle Initial">
                        <input type="text" name="complainant_last_name[]" placeholder="Last Name" required>
                        <input type="text" name="complainant_suffix[]" placeholder="Suffix">
                    </div>
                </div>
                <button type="button" class="add-complainant">+ Add complainant</button>
            </div>

            <!-- Respondent -->
            <div class="respondent-container">
                <label>Respondent:</label>
                <div id="respondentFields">
                    <div class="respondent-fields">
                        <input type="text" name="respondent_first_name[]" placeholder="First Name" required>
                        <input type="text" name="respondent_middle_name[]" placeholder="Middle Initial">
                        <input type="text" name="respondent_last_name[]" placeholder="Last Name" required>
                        <input type="text" name="respondent_suffix[]" placeholder="Suffix">
                    </div>
                </div>
                <button type="button" class="add-respondent">+ Add respondent</button>
            </div>

            <!-- Case Details -->
            <div class="case-details-container">
                <div class="case-left">
                    <h3>Case Details:</h3>
                    <textarea name="title" placeholder="Title" class="case" required></textarea>
                    <label>Nature:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="nature" value="Criminal" required> Criminal</label>
                        <label><input type="radio" name="nature" value="Civil"> Civil</label>
                    </div>
                    <label>Date Filed: <input type="date" name="file_date" required></label>
                </div>

                <div class="case-center">
                    <label>Date of Initial Confrontation: <input type="date" name="confrontation_date"></label>
                    <input type="text" name="action_taken" placeholder="Action Taken">
                    <label>Date of Settlement or Award:  <input type="text" name="settlement_date" class="date-or-text" placeholder="YYYY-MM-DD or CFA/N/A"></label>
                    <label>Date of Execution:  <input type="text" name="exec_settlement_date" class="date-or-text" placeholder="YYYY-MM-DD or CFA/N/A"></label>
                </div>

                <div class="case-right">
                    <h3>Main Point of Agreement:</h3>
                    <textarea name="main_agreement" placeholder="Enter details..."></textarea>

                    <h4>Compliance:</h4>
                    <div class="radio-group">
                        <label><input type="radio" name="compliance_status" value="Complete"> Complete</label>
                        <label><input type="radio" name="compliance_status" value="Ongoing"> Ongoing</label>
                    </div>

                    <h4>Remarks:</h4>
                    <div class="radio-group">
                        <label><input type="radio" name="remarks" value="Settled"> Settled</label>
                        <label><input type="radio" name="remarks" value="Issued CFA"> Issued CFA</label>
                    </div>
                </div>
            </div>

            <button type="submit">Add Case</button>
        </form>
    </div>

    
    <div id="caseDetailsPopup" class="popup">
        <div class="popup-content">
            <span class="close-button" id="closeCasePopup">&times;</span>
            <h2>Case Details</h2>
            <div class="case-info-grid">
                <div><strong>Case No.:</strong> <span id="caseNo"></span></div>
                <div><strong>Complainant:</strong> <span id="complainant"></span></div>
                <div><strong>Respondent:</strong> <span id="respondent"></span></div>
                <div><strong>Title:</strong> <span id="title"></span></div>
                <div><strong>Nature:</strong> <span id="nature"></span></div>
                <div><strong>Date Filed:</strong> <span id="dateFiled"></span></div>
                <div><strong>Initial Confrontation:</strong> <span id="initialConfrontation"></span></div>
                <div><strong>Action Taken:</strong> <span id="action"></span></div>
                <div><strong>Settlement Date:</strong> <span id="settlement"></span></div>
                <div><strong>Execution Date:</strong> <span id="execution"></span></div>
                <div><strong>Agreement:</strong> <span id="agreement"></span></div>
                <div><strong>Compliance:</strong> <span id="compliance"></span></div>
                <div><strong>Remarks:</strong> <span id="remarks"></span></div>
            </div>
        </div>
    </div>


    <div id="deletePopup" class="popup">
        <div class="popup-content">
            <img src="trash-icon.png" alt="Trash Icon" class="trash-icon">
            <p>Archive this case?</p>
            <div class="button-group">
                <button class="yes-btn" onclick="confirmDelete()">YES</button>
                <button class="no-btn" onclick="closePopup()">NO</button>
            </div>
        </div>
    </div>
    
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("addCaseModal");
    const addBtn = document.querySelector(".add-btn");
    const closeBtn = document.querySelector(".close-button"); // Fixed selector
    const editIcons = document.querySelectorAll(".fa-edit"); // Select all edit icons
    const modalTitle = modal.querySelector("h2"); // The modal title
    const modalAddButton = modal.querySelector("button"); // The button in modal
    const caseDetailsButtons = document.querySelectorAll(".case-details-btn");
    const deleteButtons = document.querySelectorAll(".delete-btn");


    document.getElementById("addCaseForm").addEventListener("submit", function(event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch("configs/add_case.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                alert("Case added successfully!");
                location.reload();
            } else {
                alert("Error: " + data);
            }
        })
        .catch(error => console.error("Error:", error));
    });
    // Function to handle opening the modal for adding a case
    addBtn.addEventListener("click", function () {
        modal.style.display = "block";
        modalTitle.textContent = "Add Case"; // Set the title to Add Case
        modalAddButton.textContent = "Add"; // Set the button text to Add
        clearModalFields(); // Clear the modal fields
    });

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            const caseNo = this.getAttribute("data-case-no");
            showDeletePopup(caseNo);
        });
    });

    caseDetailsButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Retrieve data from `data-*` attributes
            document.getElementById("caseNo").innerText = button.dataset.caseNo;
            document.getElementById("complainant").innerText = button.dataset.complainants;
            document.getElementById("respondent").innerText = button.dataset.respondents;
            document.getElementById("title").innerText = button.dataset.title;
            document.getElementById("nature").innerText = button.dataset.nature;
            document.getElementById("dateFiled").innerText = button.dataset.fileDate;
            document.getElementById("initialConfrontation").innerText = button.dataset.confrontationDate;
            document.getElementById("action").innerText = button.dataset.action;
            document.getElementById("settlement").innerText = button.dataset.settlementDate;
            document.getElementById("execution").innerText = button.dataset.execSettlementDate;
            document.getElementById("agreement").innerText = button.dataset.mainAgreement;
            document.getElementById("compliance").innerText = button.dataset.compliance;
            document.getElementById("remarks").innerText = button.dataset.remarks;

            // Show the case details modal
            document.getElementById("caseDetailsPopup").style.display = "block";
        });
    });

    // Close popup
    document.getElementById("closeCasePopup").addEventListener("click", function () {
        document.getElementById("caseDetailsPopup").style.display = "none";
    });

    // Function to handle opening the modal for editing a case
    editIcons.forEach(icon => {
        icon.addEventListener("click", function (event) {
            const row = event.target.closest("tr"); // Get the row of the clicked edit icon
            const caseId = row.querySelector("td:nth-child(1)").textContent; // Get the Case ID
            const complainant = row.querySelector("td:nth-child(2)").textContent; // Get the complainant
            const respondent = row.querySelector("td:nth-child(3)").textContent; // Get the respondent
            const title = row.querySelector("td:nth-child(4)").textContent; // Get the case title
            const nature = row.querySelector("td:nth-child(5)").textContent; // Get the case nature
            const dateFiled = row.querySelector("td:nth-child(6)").textContent; // Get the filed date

            // Set the modal content to match the case being edited
            modal.style.display = "block";
            modalTitle.textContent = "Edit Case"; // Set the title to Edit Case
            modalAddButton.textContent = ""; // Change button text to Save Changes

            // Fill the modal with the case data
            modal.querySelector("input[name='case_id']").value = caseId;
            modal.querySelector("input[name='complainant']").value = complainant;
            modal.querySelector("input[name='respondent']").value = respondent;
            modal.querySelector("input[name='title']").value = title;
            modal.querySelector("input[name='nature']").value = nature;
            modal.querySelector("input[name='date_filed']").value = dateFiled;
        });
    });

    // Close the modal when the close button is clicked
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Close the modal if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Helper function to clear modal fields when adding a new case
    function clearModalFields() {
        modal.querySelector("input[name='case_id']").value = "";
        modal.querySelector("input[name='complainant']").value = "";
        modal.querySelector("input[name='respondent']").value = "";
        modal.querySelector("input[name='title']").value = "";
        modal.querySelector("input[name='nature']").value = "";
        modal.querySelector("input[name='date_filed']").value = "";
    }
});

function redirectToAuthorization(event) {
            event.preventDefault(); 
            window.location.href = "authorization.html"; 
        }

        function showDeletePopup(caseNo) {
    const popup = document.getElementById("deletePopup");
    popup.style.display = "block";
    popup.setAttribute("data-case-no", caseNo);
}

function closePopup() {
    document.getElementById("deletePopup").style.display = "none";
}

function confirmDelete() {
    const popup = document.getElementById("deletePopup");
    const caseNo = popup.getAttribute("data-case-no");

    if (!caseNo) {
        alert("Error: No case selected.");
        return;
    }

    fetch("configs/delete_case.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "case_no=" + encodeURIComponent(caseNo),
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            document.getElementById("row-" + caseNo).remove(); // Hide row
            closePopup();
        } else {
            alert("Error archiving case.");
        }
    })
    .catch(error => console.error("Error:", error));
}

</script>

</html>
