<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EquipEase Rentals: Dashboard</title>
</head>
<body>
    <nav>
        <h1><a href="index.php">EquipEase Rentals</a></h1>
    </nav>
    <div class="main">
        
        <!-- Search rentals by customer's email -->
        <h2>Search Rentals by Customer's Email</h2>
        <form action="rentals" method="get">
            <input type="email" name="customer_email" placeholder="Customer's Email" required>
            <button type="submit">Search Rentals</button>
        </form>


        <!-- Allow staff to add new equipment -->
        <h2>Add New Equipment</h2>
        <form action="add" method="post">
            <input type="text" name="equipment_id" placeholder="Equipment ID" required>
            <input type="number" name="equipment_availability" placeholder="Equipment Availability" max=1 min=0required>
            <input type="date" name="equipment_purchase_date" placeholder="Purchase Date" required>
            <input type="text" name="equipment_branch" placeholder="Branch Name" required>
            <input type="text" name="equipment_type" placeholder="Equipment Type" required>
            <button type="submit">Add Equipment</button>
            <button type="reset">Reset</button>
        </form>
       

        <h2>View All Equipment</h2>
    </div>
</body>
</html>