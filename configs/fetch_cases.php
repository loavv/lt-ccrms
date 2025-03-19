<?php
include 'config.php';

// Get the selected year from the request
$year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");

// Get total cases (excluding archived cases)
$totalCasesQuery = "SELECT COUNT(*) AS total FROM cases WHERE is_archived = 0";
$totalCasesResult = $conn->query($totalCasesQuery);
$totalCases = $totalCasesResult->fetch_assoc()['total'];

// Get total criminal cases (excluding archived cases)
$criminalCasesQuery = "SELECT COUNT(*) AS total FROM cases WHERE nature = 'Criminal' AND is_archived = 0";
$criminalCasesResult = $conn->query($criminalCasesQuery);
$criminalCases = $criminalCasesResult->fetch_assoc()['total'];

// Get total civil cases (excluding archived cases)
$civilCasesQuery = "SELECT COUNT(*) AS total FROM cases WHERE nature = 'Civil' AND is_archived = 0";
$civilCasesResult = $conn->query($civilCasesQuery);
$civilCases = $civilCasesResult->fetch_assoc()['total'];

// Get highest month by case count (excluding archived cases)
$highestMonthQuery = "
    SELECT MONTHNAME(file_date) AS month, COUNT(*) AS total_cases
    FROM cases
    WHERE YEAR(file_date) = ? AND is_archived = 0
    GROUP BY MONTH(file_date)
    ORDER BY total_cases DESC
    LIMIT 1
";

$stmt = $conn->prepare($highestMonthQuery);
$stmt->bind_param("i", $year);
$stmt->execute();
$highestMonthResult = $stmt->get_result();
$highestMonth = ($highestMonthResult->num_rows > 0) ? $highestMonthResult->fetch_assoc()['month'] : "None";
$stmt->close();

// Get monthly case counts (excluding archived cases)
$monthlyCasesQuery = "
    SELECT MONTH(file_date) AS month, COUNT(*) AS total
    FROM cases
    WHERE YEAR(file_date) = ? AND is_archived = 0
    GROUP BY MONTH(file_date)
    ORDER BY month
";

$stmt = $conn->prepare($monthlyCasesQuery);
$stmt->bind_param("i", $year);
$stmt->execute();
$monthlyCasesResult = $stmt->get_result();

$monthlyCases = array_fill(0, 12, 0); // Default 0 cases for each month (Jan to Dec)
while ($row = $monthlyCasesResult->fetch_assoc()) {
    $monthlyCases[$row['month'] - 1] = $row['total']; // Adjust index (Jan=0, Feb=1, etc.)
}
$stmt->close();

// Get yearly case statistics (excluding archived cases)
$yearlyCasesQuery = "
    SELECT YEAR(file_date) AS year, COUNT(*) AS total_cases
    FROM cases
    WHERE is_archived = 0
    GROUP BY YEAR(file_date)
    ORDER BY year ASC
";

$yearlyCasesResult = $conn->query($yearlyCasesQuery);
$yearlyCases = [];

while ($row = $yearlyCasesResult->fetch_assoc()) {
    $yearlyCases[$row['year']] = $row['total_cases']; // Store year as key, case count as value
}

// Get case status breakdown (excluding archived cases)
$statusQuery = "
    SELECT compliance_status, COUNT(*) AS total
    FROM cases
    WHERE is_archived = 0
    GROUP BY compliance_status
";
$statusResult = $conn->query($statusQuery);
$statusData = ["Complete" => 0, "Ongoing" => 0];

while ($row = $statusResult->fetch_assoc()) {
    $statusData[$row['compliance_status']] = $row['total'];
}

// Return data as JSON
echo json_encode([
    "total_cases" => $totalCases,
    "criminal_cases" => $criminalCases,
    "civil_cases" => $civilCases,
    "highest_month" => $highestMonth,
    "monthly_cases" => $monthlyCases,
    "yearly_cases" => $yearlyCases,
    "status_data" => $statusData
]);

$conn->close();
?>
