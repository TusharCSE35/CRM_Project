<?php
require_once 'includes/crm.php';

$crm = new CRM();
$contacts = $crm->displayContacts(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Contacts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/display_contact.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Display Contacts</h1>

        <!-- Contact Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contact Name</th>
                        <th>Email</th>
                        <th>Contact Address</th>
                        <th>Lead ID</th>
                        <th>Lead Name</th>
                        <th>Lead Website</th>
                        <th>Lead Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact['id']) ?></td>
                            <td><?= htmlspecialchars($contact['name']) ?></td>
                            <td><?= htmlspecialchars($contact['email']) ?></td>
                            <td><?= htmlspecialchars($contact['address']) ?></td>
                            <td><?= isset($contact['lead_id']) ? htmlspecialchars($contact['lead_id']) : 'N/A' ?></td>
                            <td><?= isset($contact['lead_name']) ? htmlspecialchars($contact['lead_name']) : 'N/A' ?></td>
                            <td>
                                <?php if (!empty($contact['lead_website'])): ?>
                                    <a href="<?= htmlspecialchars($contact['lead_website']) ?>" target="_blank">
                                        <?= htmlspecialchars($contact['lead_website']) ?>
                                    </a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?= isset($contact['lead_address']) ? htmlspecialchars($contact['lead_address']) : 'N/A' ?></td>
                            <td>
                                <a href="edit_contact.php?id=<?= htmlspecialchars($contact['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_contact.php?id=<?= htmlspecialchars($contact['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
