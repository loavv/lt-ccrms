<?php
include 'config.php';

// Get filter parameters
$year = isset($_GET['year']) ? $_GET['year'] : '';
$month = isset($_GET['month']) ? $_GET['month'] : '';

// Set headers for Excel download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="detailed_cases_report.xls"');

// Build the SQL query with filters
$sql = "SELECT 
    c.case_no,
    GROUP_CONCAT(DISTINCT CONCAT(p1.first_name, ' ', COALESCE(p1.middle_name, ''), ' ', p1.last_name, ' ', COALESCE(p1.suffix, '')) SEPARATOR ' & ') AS complainants,
    GROUP_CONCAT(DISTINCT CONCAT(p2.first_name, ' ', COALESCE(p2.middle_name, ''), ' ', p2.last_name, ' ', COALESCE(p2.suffix, '')) SEPARATOR ' & ') AS respondents,
    c.title,
    c.nature,
    DATE_FORMAT(c.file_date, '%Y-%m-%d') as file_date,
    DATE_FORMAT(c.confrontation_date, '%Y-%m-%d') as confrontation_date,
    c.action_taken,
    c.settlement_date as settlement_date,
    c.exec_settlement_date as exec_settlement_date,
    c.main_agreement,
    c.compliance_status,
    c.remarks
FROM cases c
LEFT JOIN case_persons cp1 ON c.case_no = cp1.case_no AND cp1.role = 'Complainant'
LEFT JOIN persons p1 ON cp1.person_id = p1.person_id
LEFT JOIN case_persons cp2 ON c.case_no = cp2.case_no AND cp2.role = 'Respondent'
LEFT JOIN persons p2 ON cp2.person_id = p2.person_id
WHERE c.is_archived = 0";

if ($year) {
    $sql .= " AND YEAR(c.file_date) = " . intval($year);
}
if ($month) {
    $sql .= " AND MONTH(c.file_date) = " . intval($month);
}

$sql .= " GROUP BY c.case_no, c.title, c.nature, c.file_date, c.confrontation_date, 
         c.action_taken, c.settlement_date, c.exec_settlement_date, 
         c.main_agreement, c.compliance_status, c.remarks
         ORDER BY c.file_date DESC";

$result = $conn->query($sql);

// Create Excel content
echo "<table border='1'>";
// Add headers
echo "<tr style='background-color: #db8505; color: white; font-weight: bold;'>
        <td>Case No</td>
        <td>Complainant(s)</td>
        <td>Respondent(s)</td>
        <td>Title</td>
        <td>Nature</td>
        <td>Date Filed</td>
        <td>Confrontation Date</td>
        <td>Action Taken</td>
        <td>Settlement Date</td>
        <td>Execution Date</td>
        <td>Agreement</td>
        <td>Status</td>
        <td>Remarks</td>
      </tr>";

// Add data rows
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['case_no']) . "</td>";
    echo "<td>" . htmlspecialchars($row['complainants']) . "</td>";
    echo "<td>" . htmlspecialchars($row['respondents']) . "</td>";
    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nature']) . "</td>";
    echo "<td>" . htmlspecialchars($row['file_date']) . "</td>";
    echo "<td>" . htmlspecialchars($row['confrontation_date']) . "</td>";
    echo "<td>" . htmlspecialchars($row['action_taken']) . "</td>";
    echo "<td>" . htmlspecialchars($row['settlement_date']) . "</td>";
    echo "<td>" . htmlspecialchars($row['exec_settlement_date']) . "</td>";
    echo "<td>" . htmlspecialchars($row['main_agreement']) . "</td>";
    echo "<td>" . htmlspecialchars($row['compliance_status']) . "</td>";
    echo "<td>" . htmlspecialchars($row['remarks']) . "</td>";
    echo "</tr>";
}

echo "</table>";
$conn->close();
?> 