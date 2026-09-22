<?php
    require 'db.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
	<title>Add Equipment | EquipEase Rentals</title>
</head>
<body>
    <nav>
        <h1><a href="index.php">EquipEase Rentals</a></h1>
    </nav>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $equipment_id = htmlspecialchars($_POST['equipment_id']);
            $equipment_availability = htmlspecialchars($_POST['equipment_availability']);
            $equipment_purchase_date = htmlspecialchars($_POST['equipment_purchase_date']);
            $equipment_branch_name = htmlspecialchars($_POST['equipment_branch']);
            $equipment_type = htmlspecialchars($_POST['equipment_type']);
            $sql = "INSERT INTO equipment (equipment_id, available, purchase_date, branch_name, type_name) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("iisss", $equipment_id, $equipment_availability, $equipment_purchase_date, $equipment_branch_name, $equipment_type);

                try {
                    $stmt->execute();
                    echo "<div class='info-sm' style='margin-top: 2rem'>";
                    echo "<p><strong>ID:</strong> " . htmlspecialchars($equipment_id) . "</p>";
                    echo "<p><strong>Available:</strong> " . ($equipment_availability ? 'Yes' : 'No') . "</p>";
                    echo "<p><strong>Purchase Date:</strong> " . htmlspecialchars($equipment_purchase_date) . "</p>";
                    echo "<p><strong>Branch:</strong> " . htmlspecialchars($equipment_branch_name) . "</p>";
                    echo "<p><strong>Type:</strong> " . htmlspecialchars($equipment_type) . "</p>";
                    echo "<h3>Successfully Added New Equipment!</h3>";
                    echo "</div>";

                } catch (mysqli_sql_exception $e) {
                    // Grab the specific SQL error from the statement object
                    $sql_error = htmlspecialchars($e->getMessage());
                    echo "<div class='info-sm' style='margin-top: 2rem'>";
                    echo "<h3 style='margin-bottom: 1rem;'>Error Adding Equipment</h3>";
                    echo "<p>The database returned the following error:</p>";
                    echo "<p><strong>" . $sql_error . "</strong></p>";
                    echo "</div>";
                }
                $stmt->close();
            } else {
                echo "<p class='info-sm'>Database query failed.</p>";
            }

        }
    mysqli_close($conn);
    ?>
    <p><a href="index.php"><button>Return to Dashboard</button></a></p>
</body>
</html>
