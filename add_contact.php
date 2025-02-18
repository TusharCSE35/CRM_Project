<?php
require_once 'includes/crm.php';
$crm = new CRM();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lead_name'])) {
        $lead_name = $_POST['lead_name'];
        $leads = $crm->searchLeadsByName($lead_name);
    } 
    if (isset($_POST['contact_name']) && isset($_POST['selected_lead_id'])) {
        $lead_id = $_POST['selected_lead_id'];
        $contact_name = $_POST['contact_name'];
        $contact_email = $_POST['contact_email'];
        $contact_address = $_POST['contact_address'];

        $crm->addContact($lead_id, $contact_name, $contact_email, $contact_address);
        $contact_added = true; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/add_contact.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Start add contact -->
    <div class="container mt-5">
        <h1 class="text-center">Add Contact to a Lead</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="lead_name" class="form-label">Search Lead by Name</label>
                <input type="text" id="lead_name" name="lead_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Search Leads</button>
        </form>

        <!-- Display Matching Leads -->
        <?php if (isset($leads) && count($leads) > 0): ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h2 class="mb-4">Matching Leads</h2>
                    <div class="list-group">
                        <?php foreach ($leads as $lead): ?>
                            <div class="list-group-item">
                                <p><strong>Lead ID:</strong> <?= $lead['id'] ?></p>
                                <p><strong>Name: </strong><?= $lead['name'] ?></p>
                                <p><strong>Address:</strong> <?= $lead['address'] ?></p>
                                <p><strong>Website:</strong> <a href="<?= $lead['website'] ?>" target="_blank"><?= $lead['website'] ?></a></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Contact Form on Right Side -->
                <div class="col-md-6">
                    <h2 class="mt-4">Add Contact</h2>
                    <form method="POST">
                        <input type="hidden" name="lead_name" value="<?= $lead_name ?>">

                        <div class="mb-3">
                            <label for="selected_lead_id" class="form-label">Select Lead</label>
                            <select id="selected_lead_id" name="selected_lead_id" class="form-select" required>
                                <?php foreach ($leads as $lead): ?>
                                    <option value="<?= $lead['id'] ?>"><?= $lead['name'] ?> (ID: <?= $lead['id'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="contact_name" class="form-label">Contact Name</label>
                            <input type="text" id="contact_name" name="contact_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Contact Email</label>
                            <input type="email" id="contact_email" name="contact_email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_address" class="form-label">Contact Address</label>
                            <textarea id="contact_address" name="contact_address" class="form-control" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Add Contact</button>
                    </form>
                </div>
            </div>
        <?php elseif (isset($leads)): ?>
            <p>No leads found with the name "<?= htmlspecialchars($lead_name) ?>". Please try a different name.</p>
        <?php endif; ?>
    </div>

    <!-- Success Message Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                </div>
                <div class="modal-body">
                    Contact added successfully under Lead ID: <?= $lead_id ?>!
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (for collapsible navbar) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        <?php if (isset($contact_added) && $contact_added): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            setTimeout(function() {
                successModal.hide();
            }, 1000);
        <?php endif; ?>
    </script>
</body>
</html>
