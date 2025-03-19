<?php
include 'config.php'; // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["case_no"])) {
    $case_no = $conn->real_escape_string($_POST["case_no"]);
    
    // Update the `is_archived` flag to 1
    $sql = "UPDATE cases SET is_archived = 1 WHERE case_no = '$case_no'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
