<?php
include '../dbconnection.php'; // Ensure the correct path to your DB connection file

$query = "SELECT  name, username FROM admin WHERE verified = 0"; // Fetch pending requests
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='text-center'>";
        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td class='border border-gray-300 p-2'>";
        echo "<button class='px-4 py-2 bg-green-500 text-white rounded' onclick='approveAdmin(\"" . htmlspecialchars($row['username']) . "\")'>Accept</button> ";
        echo "<button class='px-4 py-2 bg-red-500 text-white rounded' onclick='declineAdmin(\"" . htmlspecialchars($row['username']) . "\")'>Decline</button>";
               
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3' class='border border-gray-300 p-2 text-center'>No pending requests</td></tr>";
}

$conn->close();
?>
