<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $case_no = $_POST["case_no"];
    $title = $_POST["title"];
    $nature = $_POST["nature"];
    $file_date = $_POST["file_date"];
    $confrontation_date = $_POST["confrontation_date"];
    $action_taken = $_POST["action_taken"];
    $settlement_date = $_POST["settlement_date"];
    $exec_settlement_date = $_POST["exec_settlement_date"];
    $main_agreement = $_POST["main_agreement"];
    $compliance_status = $_POST["compliance_status"];
    $remarks = $_POST["remarks"];

    // 1️⃣ Update the case details in `cases` table
    $sql = "UPDATE cases SET 
            title = ?, 
            nature = ?, 
            file_date = ?, 
            confrontation_date = ?, 
            action_taken = ?, 
            settlement_date = ?, 
            exec_settlement_date = ?, 
            main_agreement = ?, 
            compliance_status = ?, 
            remarks = ?
            WHERE case_no = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", 
        $title, 
        $nature, 
        $file_date, 
        $confrontation_date, 
        $action_taken, 
        $settlement_date, 
        $exec_settlement_date, 
        $main_agreement, 
        $compliance_status, 
        $remarks,
        $case_no
    );

    if (!$stmt->execute()) {
        echo "Error updating case: " . $conn->error;
        exit;
    }
    $stmt->close();

    // 2️⃣ Delete existing complainants/respondents for this case
    $sql_delete = "DELETE FROM case_persons WHERE case_no = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("s", $case_no);
    if (!$stmt_delete->execute()) {
        echo "Error clearing complainants/respondents: " . $conn->error;
        exit;
    }
    $stmt_delete->close();

    // 3️⃣ Insert updated complainants
    if (!empty($_POST['complainant_first_name'])) {
        foreach ($_POST['complainant_first_name'] as $index => $first_name) {
            $middle_name = $_POST['complainant_middle_name'][$index] ?? null;
            $last_name = $_POST['complainant_last_name'][$index];
            $suffix = $_POST['complainant_suffix'][$index] ?? null;

            $sql_insert = "INSERT INTO case_persons (case_no, first_name, middle_name, last_name, suffix, role) 
                           VALUES (?, ?, ?, ?, ?, 'Complainant')";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sssss", $case_no, $first_name, $middle_name, $last_name, $suffix);
            if (!$stmt_insert->execute()) {
                echo "Error adding complainants: " . $conn->error;
                exit;
            }
            $stmt_insert->close();
        }
    }

    // 4️⃣ Insert updated respondents
    if (!empty($_POST['respondent_first_name'])) {
        foreach ($_POST['respondent_first_name'] as $index => $first_name) {
            $middle_name = $_POST['respondent_middle_name'][$index] ?? null;
            $last_name = $_POST['respondent_last_name'][$index];
            $suffix = $_POST['respondent_suffix'][$index] ?? null;

            $sql_insert = "INSERT INTO case_persons (case_no, first_name, middle_name, last_name, suffix, role) 
                           VALUES (?, ?, ?, ?, ?, 'Respondent')";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sssss", $case_no, $first_name, $middle_name, $last_name, $suffix);
            if (!$stmt_insert->execute()) {
                echo "Error adding respondents: " . $conn->error;
                exit;
            }
            $stmt_insert->close();
        }
    }

    echo "success";
    $conn->close();
}
?>
