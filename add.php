<?php
    require 'db.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Equipment | EquipEase Rentals</title>
</head>
<body>
    <nav>
        <h1><a href="index.php">EquipEase Rentals</a></h1>
    </nav>

    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
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

                if ($stmt->execute()) {
                    echo "<div class='message'>";
                    echo "<h3>Successfully Added New Equipment!</h3>";
                    echo "<p><strong>ID:</strong> " . htmlspecialchars($equipment_id) . "</p>";
                    echo "<p><strong>Available:</strong> " . ($equipment_availability ? 'Yes' : 'No') . "</p>";
                    echo "<p><strong>Purchase Date:</strong> " . htmlspecialchars($equipment_purchase_date) . "</p>";
                    echo "<p><strong>Branch:</strong> " . htmlspecialchars($equipment_branch_name) . "</p>";
                    echo "<p><strong>Type:</strong> " . htmlspecialchars($equipment_type) . "</p>";
                    echo "</div>";
                } else {
                    echo "<p class='message'>Error adding equipment: It is possible the Branch Name or Type Name does not exist in the database, or the ID is already taken.</p>";
                }
                $stmt->close();
            } else {
                echo "<p class='message'>Database query failed. Please check your inputs.</p>";
            }

        }
    mysqli_close($conn);
    ?>
    <p><a href="index.php"><button>Return to Dashboard</button></a></p>
</body>
</html>
