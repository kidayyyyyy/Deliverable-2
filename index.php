<?php
    require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | EquipEase Rentals</title>
</head>
<body>
    <nav>
        <h1><a href="index.php">Dashboard | EquipEase Rentals</a></h1>
    </nav>
    <div class="main">
        
        <!-- Search rentals by customer's email -->
        <h2>Search Rentals by Customer's Email</h2>
        <form action="rentals.php" method="GET">
            <!-- note; isset takes name -->
            <input type="email" id="email" name="email" placeholder="Customer's Email" required>
            <button type="submit">Search Rentals</button>
        </form>


        <!-- Allow staff to add new equipment -->
        <h2>Add New Equipment</h2>
        <form action="add" method="post">
            <input type="text" name="equipment_id" placeholder="Equipment ID" required>
            <input type="number" name="equipment_availability" placeholder="Equipment Availability" max="1" min="0" required>
            <input type="date" name="equipment_purchase_date" placeholder="Purchase Date" required>
            <input type="text" name="equipment_branch" placeholder="Branch Name" required>
            <input type="text" name="equipment_type" placeholder="Equipment Type" required>
            <button type="submit">Add Equipment</button>
            <button type="reset">Reset</button>
        </form>
       
        <!-- All equipment in table -->
        <h2>View All Equipment</h2>
        <?php
            $sql = "SELECT * FROM Equipment";
            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Available</th><th>Purchase Date</th><th>Branch</th><th>Type</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
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
                echo "There is no equipment to show.";
            }
            mysqli_close($conn);
        ?>

    </div>
</body>
</html>