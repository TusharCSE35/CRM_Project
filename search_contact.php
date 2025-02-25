<?php
require_once 'includes/crm.php';

$crm = new CRM();
$contacts = [];
$noResults = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = trim($_POST["search"]);
    $contacts = $crm->searchContactsByName($searchTerm);

    if (empty($contacts)) {
        $noResults = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Lead</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/search_contact.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Search Contact</h1>

        <!-- Lead Search Form -->
        <form method="POST" action="search_contact.php">
            <div class="mb-3">
                <label for="search" class="form-label">Search Contact by Name</label>
                <input type="text" id="search" name="search" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Search Contact</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])): ?>
            <?php if ($noResults): ?>
                <p class="mt-4 text-center">No contacts found.</p>
            <?php elseif (!empty($contacts)): ?>
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
