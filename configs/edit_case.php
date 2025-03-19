<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate case number is provided
    if (!isset($_POST["case_no"]) || empty($_POST["case_no"])) {
        echo "Error: Case number is required";
        exit;
    }
    
    $case_no = $_POST["case_no"];
    $title = $_POST["title"];
    $nature = $_POST["nature"];
    $file_date = $_POST["file_date"];
    $confrontation_date = !empty($_POST["confrontation_date"]) ? $_POST["confrontation_date"] : null;
    $action_taken = !empty($_POST["action_taken"]) ? $_POST["action_taken"] : null;
    $settlement_date = !empty($_POST["settlement_date"]) ? $_POST["settlement_date"] : null;
    $exec_settlement_date = !empty($_POST["exec_settlement_date"]) ? $_POST["exec_settlement_date"] : null;
    $main_agreement = !empty($_POST["main_agreement"]) ? $_POST["main_agreement"] : null;
    $compliance_status = isset($_POST["compliance_status"]) ? $_POST["compliance_status"] : 'Ongoing';
    $remarks = !empty($_POST["remarks"]) ? $_POST["remarks"] : null;

    // Begin transaction
    $conn->begin_transaction();
    
    try {
        // 1. Update the case details in `cases` table
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
            throw new Exception("Error updating case: " . $conn->error);
        }
        $stmt->close();

        // 2. Get existing person IDs to check which ones we need to keep
        $existing_person_ids = [];
        $sql_persons = "SELECT cp.person_id FROM case_persons cp WHERE cp.case_no = ?";
        $stmt_persons = $conn->prepare($sql_persons);
        $stmt_persons->bind_param("s", $case_no);
        $stmt_persons->execute();
        $result_persons = $stmt_persons->get_result();
        
        while ($row = $result_persons->fetch_assoc()) {
            $existing_person_ids[] = $row['person_id'];
        }
        $stmt_persons->close();
        
        // 3. Delete all case_persons associations
        $sql_delete = "DELETE FROM case_persons WHERE case_no = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("s", $case_no);
        if (!$stmt_delete->execute()) {
            throw new Exception("Error clearing case persons: " . $conn->error);
        }
        $stmt_delete->close();

        // 4. Process complainants
        if (!empty($_POST['complainant_first_name'])) {
            foreach ($_POST['complainant_first_name'] as $index => $first_name) {
                $middle_name = !empty($_POST['complainant_middle_name'][$index]) ? $_POST['complainant_middle_name'][$index] : null;
                $last_name = $_POST['complainant_last_name'][$index];
                $suffix = !empty($_POST['complainant_suffix'][$index]) ? $_POST['complainant_suffix'][$index] : null;

                // Insert or update person
                $sql_person = "INSERT INTO persons (first_name, middle_name, last_name, suffix) 
                               VALUES (?, ?, ?, ?)";
                $stmt_person = $conn->prepare($sql_person);
                $stmt_person->bind_param("ssss", $first_name, $middle_name, $last_name, $suffix);
                
                if (!$stmt_person->execute()) {
                    throw new Exception("Error adding complainant person: " . $conn->error);
                }
                
                $person_id = $stmt_person->insert_id;
                $stmt_person->close();

                // Link to case
                $sql_link = "INSERT INTO case_persons (case_no, person_id, role) VALUES (?, ?, 'Complainant')";
                $stmt_link = $conn->prepare($sql_link);
                $stmt_link->bind_param("si", $case_no, $person_id);
                
                if (!$stmt_link->execute()) {
                    throw new Exception("Error linking complainant to case: " . $conn->error);
                }
                $stmt_link->close();
            }
        }

        // 5. Process respondents
        if (!empty($_POST['respondent_first_name'])) {
            foreach ($_POST['respondent_first_name'] as $index => $first_name) {
                $middle_name = !empty($_POST['respondent_middle_name'][$index]) ? $_POST['respondent_middle_name'][$index] : null;
                $last_name = $_POST['respondent_last_name'][$index];
                $suffix = !empty($_POST['respondent_suffix'][$index]) ? $_POST['respondent_suffix'][$index] : null;

                // Insert or update person
                $sql_person = "INSERT INTO persons (first_name, middle_name, last_name, suffix) 
                               VALUES (?, ?, ?, ?)";
                $stmt_person = $conn->prepare($sql_person);
                $stmt_person->bind_param("ssss", $first_name, $middle_name, $last_name, $suffix);
                
                if (!$stmt_person->execute()) {
                    throw new Exception("Error adding respondent person: " . $conn->error);
                }
                
                $person_id = $stmt_person->insert_id;
                $stmt_person->close();

                // Link to case
                $sql_link = "INSERT INTO case_persons (case_no, person_id, role) VALUES (?, ?, 'Respondent')";
                $stmt_link = $conn->prepare($sql_link);
                $stmt_link->bind_param("si", $case_no, $person_id);
                
                if (!$stmt_link->execute()) {
                    throw new Exception("Error linking respondent to case: " . $conn->error);
                }
                $stmt_link->close();
            }
        }
        
        // 6. Clean up unused persons
        // This is optional and depends on your requirements - uncommment if needed
        /*
        $used_person_ids_str = implode(',', $used_person_ids);
        if (!empty($existing_person_ids)) {
            $unused_person_ids = array_diff($existing_person_ids, $used_person_ids);
            if (!empty($unused_person_ids)) {
                $unused_person_ids_str = implode(',', $unused_person_ids);
                $sql_cleanup = "DELETE FROM persons WHERE person_id IN ($unused_person_ids_str)";
                $conn->query($sql_cleanup);
            }
        }
        */
        
        // Commit transaction
        $conn->commit();
        echo "success";
        
    } catch (Exception $e) {
        // Roll back on error
        $conn->rollback();
        echo $e->getMessage();
    }
    
    $conn->close();
}
?>