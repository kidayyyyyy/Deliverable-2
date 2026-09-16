<?php
// add.php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Equipment - EquipEase</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Dashboard</a>
    </nav>

    <div class="container">
        <h2>Add Equipment Status</h2>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $equipment_id = $_POST['equipment_id'];
            $available = $_POST['available'];
            $purchase_date = $_POST['purchase_date'];
            $branch_name = $_POST['branch_name'];
            $type_name = $_POST['type_name'];

            $sql = "INSERT INTO equipment (equipment_id, available, purchase_date, branch_name, type_name) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("iisss", $equipment_id, $available, $purchase_date, $branch_name, $type_name);
                
                if ($stmt->execute()) {
                    echo "<div class='message'>";
                    echo "<h3>Successfully Added New Equipment!</h3>";
                    echo "<p><strong>ID:</strong> " . htmlspecialchars($equipment_id) . "</p>";
                    echo "<p><strong>Available:</strong> " . ($available ? 'Yes' : 'No') . "</p>";
                    echo "<p><strong>Purchase Date:</strong> " . htmlspecialchars($purchase_date) . "</p>";
                    echo "<p><strong>Branch:</strong> " . htmlspecialchars($branch_name) . "</p>";
                    echo "<p><strong>Type:</strong> " . htmlspecialchars($type_name) . "</p>";
                    echo "</div>";
                } else {
                    echo "<p class='message'>Error adding equipment: It is possible the Branch Name or Type Name does not exist in the database, or the ID is already taken.</p>";
                }
                $stmt->close();
            } else {
                 echo "<p class='message'>Database query failed. Please check your inputs.</p>";
            }
        } else {
            echo "<p class='message'>Invalid request method. Please use the form on the dashboard.</p>";
        }
        $conn->close();
        ?>
        <p><a href="index.php"><button>Return to Dashboard</button></a></p>
    </div>
</body>
</html>