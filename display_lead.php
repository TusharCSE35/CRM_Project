<?php
require_once 'includes/crm.php'; // Include your CRM class
$crm = new CRM();

// Get all leads
$leads = $crm->displayLeads();

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $crm->deleteLead($delete_id);
    header("Location: display_lead.php"); // Redirect after deletion
    exit();
}

if (isset($_GET['update_id'])) {
    $update_id = $_GET['update_id'];
    // You can create a separate update form to handle updating
    header("Location: modify_lead.php?id=$update_id"); // Redirect to update page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Leads</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/display_lead.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">All Leads</h1>

        <!-- Display Leads Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead class="table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?= $lead['id'] ?></td>
                            <td><?= htmlspecialchars($lead['name']) ?></td>
                            <td><?= htmlspecialchars($lead['address']) ?></td>
                            <td><a href="<?= htmlspecialchars($lead['website']) ?>" target="_blank"><?= htmlspecialchars($lead['website']) ?></a></td>
                            <td>
                                <a href="display_lead.php?update_id=<?= $lead['id'] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="display_lead.php?delete_id=<?= $lead['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lead?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
