<?php
require_once 'includes/crm.php';

$crm = new CRM();
$leads = $crm->displayLeads();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Leads and Contacts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/display_lead_contact.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Display Leads and Contacts</h1>

        <div class="table-responsive">
            <?php if (empty($leads)): ?>
                <h3 class="text-center">No Lead Data Available</h3>
            <?php else: ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Lead Information</th>
                            <th>Contact ID</th>
                            <th>Contact Name</th>
                            <th>Contact Email</th>
                            <th>Contact Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leads as $lead): ?>
                            <?php
                            $contacts = $crm->getContactsByLeadId($lead['id']);
                            $contactCount = count($contacts);
                            ?>
                            <tr>
                                <td rowspan="<?= max($contactCount, 1) ?>">
                                    <strong>Lead ID:</strong> <?= htmlspecialchars($lead['id']) ?><br>
                                    <strong>Name:</strong> <?= htmlspecialchars($lead['name']) ?><br>
                                    <strong>Website:</strong> <a href="<?= htmlspecialchars($lead['website']) ?>" target="_blank"><?= htmlspecialchars($lead['website']) ?></a><br>
                                    <strong>Address:</strong> <?= htmlspecialchars($lead['address']) ?>
                                </td>
                                <?php if ($contactCount > 0): ?>
                                    <td><?= htmlspecialchars($contacts[0]['id']) ?></td>
                                    <td><?= htmlspecialchars($contacts[0]['name']) ?></td>
                                    <td><?= htmlspecialchars($contacts[0]['email']) ?></td>
                                    <td><?= htmlspecialchars($contacts[0]['address']) ?></td>
                            </tr>
                            <?php for ($i = 1; $i < $contactCount; $i++): ?>
                                <tr>
                                    <td><?= htmlspecialchars($contacts[$i]['id']) ?></td>
                                    <td><?= htmlspecialchars($contacts[$i]['name']) ?></td>
                                    <td><?= htmlspecialchars($contacts[$i]['email']) ?></td>
                                    <td><?= htmlspecialchars($contacts[$i]['address']) ?></td>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <td colspan="4" class="text-center">No contact added in this lead</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
