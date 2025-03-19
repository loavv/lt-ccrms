<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["case_no"])) {
    $case_no = $conn->real_escape_string($_POST["case_no"]);

    // Restore the case by setting is_archived = 0
    $sql = "UPDATE cases SET is_archived = 0 WHERE case_no = '$case_no'";

    if ($conn->query($sql) === TRUE) {
        echo "success"; // AJAX will check for this response
    } else {
        echo "error";
    }
}

$conn->close();
?>
