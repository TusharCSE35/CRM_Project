<?php
// Include database connection and other necessary files
// include('includes/db.php'); // assuming you have this file to connect to MySQL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>

<!-- Navbar -->
<nav>
    <div class="container">
        <ul class="nav-links">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="add_contact.php">Add Contact</a></li>
            <li><a href="add_lead.php">Add Lead</a></li>
            <li><a href="modify_contact.php">Modify Contact</a></li>
            <li><a href="modify_lead.php">Modify Lead</a></li>
            <li><a href="search_contact.php">Search Contact</a></li>
            <li><a href="search_lead.php">Search Lead</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <h1>Welcome to Your CRM Dashboard</h1>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="row">
            <div class="col">
                <a href="add_contact.php" class="button">Add Contact</a>
            </div>
            <div class="col">
                <a href="add_lead.php" class="button">Add Lead</a>
            </div>
            <div class="col">
                <a href="modify_contact.php" class="button">Modify Contact</a>
            </div>
            <div class="col">
                <a href="modify_lead.php" class="button">Modify Lead</a>
            </div>
        </div>
    </div>

    <!-- Dashboard Overview -->
    <div class="dashboard-overview">
        <h2>Recent Activities</h2>
        
        <!-- Example: Fetching and displaying recent leads and contacts -->
        <div class="recent-leads">
            <h3>Recent Leads</h3>
            <table>
                <tr>
                    <th>Lead ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
                <?php
                // Fetch recent leads from the database
                $query = "SELECT * FROM leads ORDER BY created_at DESC LIMIT 5";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['lead_id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['status'] . "</td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <div class="recent-contacts">
            <h3>Recent Contacts</h3>
            <table>
                <tr>
                    <th>Contact ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                <?php
                // Fetch recent contacts from the database
                $query = "SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['contact_id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['phone'] . "</td>
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>
