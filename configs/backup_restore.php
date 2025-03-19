<?php
include 'config.php';

if (isset($_GET['backup'])) {
    $database = "your_database_name";  // Change this to your actual database name
    $user = "root";  // XAMPP default user
    $password = "";  // Default password (empty in XAMPP)

    // Define backup file location
    $backupFile = "backup_" . date("Y-m-d_H-i-s") . ".sql";
    $backupPath = "C:/xampp/tmp/" . $backupFile;  // Use /tmp/ to avoid permission issues

    // MySQL Dump Command
    $command = "\"C:\\xampp\\mysql\\bin\\mysqldump\" --user=$user --password=$password --databases $database > \"$backupPath\" 2>&1";
    $output = shell_exec($command);

    if (file_exists($backupPath)) {
        // Force download
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="' . $backupFile . '"');
        readfile($backupPath);
        unlink($backupPath);  // Delete after download
        exit;
    } else {
        echo "Backup failed! Debug output: " . htmlspecialchars($output);
    }
}

// Restore Function
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["backup_file"])) {
    $file = $_FILES["backup_file"]["tmp_name"];
    if ($file) {
        $command = "\"C:\\xampp\\mysql\\bin\\mysql\" --user=$user --password=$password $database < \"$file\" 2>&1";
        $restoreOutput = shell_exec($command);

        if ($restoreOutput === null) {
            echo "<script>alert('✅ Database restored successfully!'); window.location.href='settings.php';</script>";
        } else {
            echo "<script>alert('❌ Restore failed: " . htmlspecialchars($restoreOutput) . "');</script>";
        }
    }
}
?>
