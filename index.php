<?php
// index.php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EquipEase Rentals - Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Dashboard</a>
    </nav>
    
    <div class="container">
        <h1>EquipEase Rentals</h1>
        <p><strong>Instructions for Staff:</strong> Use this dashboard to view all current equipment inventory. You can also search for a customer's rental history using their email address, or add new equipment to the database using the forms below.</p>
        
        <hr>

        <h2>Search Customer Rentals</h2>
        <form action="rentals.php" method="GET">
            <div class="form-group">
                <label for="email">Customer Email:</label>
                <input type="text" id="email" name="email" required placeholder="e.g., john.doe@example.com">
            </div>
            <button type="submit">View Rentals</button>
        </form>

        <hr>

        <h2>Add New Equipment</h2>
        <form action="add.php" method="POST">
            <div class="form-group">
                <label for="equipment_id">Equipment ID:</label>
                <input type="number" id="equipment_id" name="equipment_id" required>
            </div>
            <div class="form-group">
                <label for="available">Available (1 for Yes, 0 for No):</label>
                <input type="number" id="available" name="available" min="0" max="1" required>
            </div>
            <div class="form-group">
                <label for="purchase_date">Purchase Date:</label>
                <input type="date" id="purchase_date" name="purchase_date" required>
            </div>
            <div class="form-group">
                <label for="branch_name">Branch Name:</label>
                <input type="text" id="branch_name" name="branch_name" required placeholder="e.g., Auckland Central Branch">
            </div>
            <div class="form-group">
                <label for="type_name">Equipment Type:</label>
                <input type="text" id="type_name" name="type_name" required placeholder="e.g., Concrete Mixer">
            </div>
            <button type="submit">Add Equipment</button>
        </form>

        <hr>

        <h2>All Equipment</h2>
        <?php
        $sql = "SELECT * FROM equipment";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Available</th><th>Purchase Date</th><th>Branch</th><th>Type</th></tr>";
            while($row = $result->fetch_assoc()) {
                $available = $row["available"] ? 'Yes' : 'No';
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["equipment_id"]) . "</td>";
                echo "<td>" . $available . "</td>";
                echo "<td>" . htmlspecialchars($row["purchase_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["branch_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["type_name"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='message'>No equipment found in the database or query failed.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>