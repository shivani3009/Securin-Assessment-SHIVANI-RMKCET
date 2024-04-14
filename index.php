<?php
require 'db.php';

// Pagination settings
$perPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Fetch total records
$total_result = $conn->query("SELECT COUNT(*) AS total FROM cve_details");
$total = $total_result->fetch_assoc()['total'];

// Fetch paginated records
$sql = "SELECT cve_id, published_date, last_modified_date, status FROM cve_details LIMIT $perPage OFFSET $offset";
$result = $conn->query($sql);

echo "<h1>CVE LIST</h1>";
echo "<p>Total records: $total</p>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
        <th>CVE ID</th>
        <th>Published Date</th>
        <th>Last Modified Date</th>
        <th>Status</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr onclick=\"window.location='details.php?id=" . $row['cve_id'] . "'\">
            <td>{$row['cve_id']}</td>
            <td>{$row['published_date']}</td>
            <td>{$row['last_modified_date']}</td>
            <td>{$row['status']}</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No results!";
}

// Pagination Links
$totalPages = ceil($total / $perPage);
echo "<div style='text-align: right;'>";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='?page=$i'> $i </a>";
}
echo "</div>";
?>
