<?php
// rentals.php
require 'db.php';

$email = isset($_GET['email']) ? trim($_GET['email']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Rentals - EquipEase</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Dashboard</a>
    </nav>

    <div class="container">
        <h2>Rental History</h2>
        
        <?php
        if (empty($email)) {
            echo "<p class='message'>Please provide a valid customer email address.</p>";
        } else {
            echo "<p>Showing rentals for: <strong>" . htmlspecialchars($email) . "</strong></p>";
            
            // Prepare statement to prevent SQL injection
            $sql = "SELECT rental_id, start_time, hire_from FROM rental WHERE customer_email = ?";
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Rental ID</th><th>Start Time</th><th>Hire From</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["rental_id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["start_time"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["hire_from"]) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='message'>No rentals found for this customer email.</p>";
                }
                $stmt->close();
            } else {
                echo "<p class='message'>Database query failed. Please try again later.</p>";
            }
        }
        $conn->close();
        ?>
        <p><a href="index.php"><button>Return to Dashboard</button></a></p>
    </div>
</body>
</html>