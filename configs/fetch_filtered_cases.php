<?php
include 'config.php';

$year = isset($_GET['year']) ? $_GET['year'] : '';
$month = isset($_GET['month']) ? $_GET['month'] : '';

$sql = "SELECT 
    c.case_no,
    GROUP_CONCAT(DISTINCT CONCAT(p1.first_name, ' ', COALESCE(p1.middle_name, ''), ' ', p1.last_name, ' ', COALESCE(p1.suffix, '')) SEPARATOR ' & ') AS complainants,
    GROUP_CONCAT(DISTINCT CONCAT(p2.first_name, ' ', COALESCE(p2.middle_name, ''), ' ', p2.last_name, ' ', COALESCE(p2.suffix, '')) SEPARATOR ' & ') AS respondents,
    c.title,
    c.nature,
    DATE_FORMAT(c.file_date, '%Y-%m-%d') as file_date
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

$sql .= " GROUP BY c.case_no, c.title, c.nature, c.file_date ORDER BY c.file_date DESC";

$result = $conn->query($sql);
$cases = array();

while ($row = $result->fetch_assoc()) {
    $cases[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cases);
$conn->close();
?> 