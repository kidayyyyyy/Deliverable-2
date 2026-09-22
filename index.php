<?php
    require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard | EquipEase Rentals</title>
</head>
<body>
    <nav>
        <h1><a href="index.php">EquipEase Rentals</a></h1>
    </nav>
    <div class="main">
        <p class="info-sm">
            For Staff: Use this dashboard to view all current equipment inventory. You can also search for a customer's rental history using their email address, or add new equipment to the database using the forms below.
        </p>

        <div class="form-flex">
            <!-- Search rentals by customer's email -->
            <form action="rentals.php" method="GET">
                <h2>Search Rentals by Customer's Email</h2>
                <!-- note; isset takes name -->
                <label for="equipment_id">Customer's Email</label>
                <input type="email" id="email" name="customer_email" placeholder="john.doe@example.com" required>
                <button type="submit">Search Rentals</button>
            </form>


            <!-- Allow staff to add new equipment -->
            <form action="add.php" method="POST">
                <h2>Add New Equipment</h2>
                <div class="form-group">
                    <label for="equipment_id">Equipment ID</label>
                    <input type="text" name="equipment_id" placeholder="" required>
                </div>
            <div class="form-group">
                    <label for="equipment_availability">Equipment Availability</label>
                    <select name="equipment_availability" required>
                        <option value="" disabled>Select Yes or No</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
            </div>
            
                <div class="form-group">
                    <label for="equipment_purchase_date">Equipment Purchase Date</label>
                    <input type="date" name="equipment_purchase_date" placeholder="Purchase Date" required>
                </div>
                
                <!-- Takes branch names from branch table -->
                <div class="form-group">
                        <label for="equipment_branch">Equipment Branch</label>
                        <select name="equipment_branch" id="equipment_branch" required>
                        <option value="" disabled selected>Select Branch Name</option>
                        <?php
                            $branch_sql = "SELECT branch_name FROM branch";
                            $branch_result = mysqli_query($conn, $branch_sql);
                            if ($branch_result && mysqli_num_rows($branch_result) > 0) {
                                while ($branch_name_row = mysqli_fetch_assoc($branch_result)) {
                                    $branchName = htmlspecialchars($branch_name_row['branch_name']);
                                    echo "<option value='$branchName'>$branchName</option>";
                                }
                            } else {
                                // Show no branch name(s) available if none in table
                                echo "<option value='' disabled>No branch name(s) found</option>"; 
                            }
                        ?>
                        </select>
                </div>
                
                <!-- Takes equipment type from the equipment_type table -->
                <div class="form-group">
                    <label for="equipment_type">Equipment Type</label>
                    <select name="equipment_type" required>
                        <option value="" disabled selected>Select Equipment Type</option>
                        <?php
                            // Query the database for all available equipment types
                            $type_sql = "SELECT type_name FROM equipment_type";
                            $type_result = mysqli_query($conn, $type_sql);

                            // Check if the query succeeded and returned rows
                            if ($type_result && mysqli_num_rows($type_result) > 0) {
                                while ($type_row = mysqli_fetch_assoc($type_result)) {
                                    $typeName = htmlspecialchars($type_row['type_name']);
                                    echo "<option value='$typeName'>$typeName</option>";
                                }
                            } else {
                                // Show no equipment type if none are found
                                echo "<option value='' disabled>No equipment type(s) found</option>";
                            }
                        ?>
                    </select>
                </div>
                
                <button type="submit">Add Equipment</button>
                <button type="reset">Clear</button>
            </form>
        </div>

        <!-- All equipment in table -->
        <h2>View All Equipment</h2>
        <?php
            $sql = "SELECT * FROM Equipment";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
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
            mysql_close($conn);
        ?>
    </div>
</body>
</html>
