<?php
    // Get database
    require 'db.php';

    // Get email and check if user added email
    $email = isset($_GET['customer_email']) ? trim($_GET['customer_email']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Rentals | EquipEase Rentals</title>
</head>
<body>
    <nav>
        <h1><a href="index.php">EquipEase Rentals</a></h1>
    </nav>

    <div class="main">
        <h2>Rental History</h2>
        <?php
            // Check if email is not empty
            if (empty($email)) {
                echo "<p class='message'>Please provide a valid customer email.</p>";
            } else {
                $clean_email = mysqli_real_escape_string($conn, $email);
                $sql = "SELECT rental_id, start_time, hire_from FROM rental WHERE customer_email = '$clean_email'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>";
                        echo "<tr><th>Rental ID</th><th>Start Time</th><th>Hire From</th></tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["rental_id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["start_time"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["hire_from"]) . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                } else {
                    echo "</p>There is no rental history for $email</>";
                }
                } else {
                    echo "bitch";
                }

            }
            mysqli_close($conn);
        ?>
        <p><a href="index.php"><button>Return to Dashboard</button></a></p>
    </div>
</body>
</html>
