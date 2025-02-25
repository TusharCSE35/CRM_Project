<?php
require_once 'classes/crm.php';

$crm = new CRM();

// Handle Delete
if (isset($_GET['delete'])) {
    $contactId = $_GET['delete'];
    $crm->deleteContact($contactId);
    echo "<script>sessionStorage.setItem('deleteSuccess', 'true');</script>";
    echo "<script>window.location.href='display_contact.php';</script>";
    exit;
}

// Handle Edit (when form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_id'])) {
    $contactId = $_POST['contact_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $crm->updateContact($contactId, $name, $email, $address);

    echo "<script>sessionStorage.setItem('editSuccess', 'true');</script>";
    echo "<script>window.location.href='display_contact.php';</script>";
    exit;
}

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

        <div class="table-responsive mt-4">
            <?php if (empty($contacts)): ?>
                <h3 class="text-center">No Contact Data Available</h3>
            <?php else: ?>
                <table class="table table-striped">
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
                                    <button class="btn btn-warning btn-sm" onclick="openEditModal(<?= htmlspecialchars($contact['id']) ?>, '<?= htmlspecialchars($contact['name']) ?>', '<?= htmlspecialchars($contact['email']) ?>', '<?= htmlspecialchars($contact['address']) ?>')">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= htmlspecialchars($contact['id']) ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Edit Contact Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="display_contact.php">
                        <input type="hidden" id="editContactId" name="contact_id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Contact Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="address" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white model-edit-success">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                </div>
                <div class="modal-body text-center">
                    Contact edited successfully!
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Success Message Modal -->
    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white model-delete-success">
                    <h5 class="modal-title" id="deleteSuccessModalLabel">Success</h5>
                </div>
                <div class="modal-body text-center">
                    Contact deleted successfully!
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this contact?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="deleteConfirmBtn" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteContactId = null;

        function confirmDelete(contactId) {
            deleteContactId = contactId;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        document.getElementById('deleteConfirmBtn').addEventListener('click', function () {
            if (deleteContactId) {
                sessionStorage.setItem("deleteSuccess", "true");
                window.location.href = "display_contact.php?delete=" + deleteContactId;
            }
        });

        function openEditModal(contactId, name, email, address) {
            document.getElementById('editContactId').value = contactId;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editAddress').value = address;

            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }

        document.addEventListener("DOMContentLoaded", function () {
            if (sessionStorage.getItem("editSuccess") === "true") {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                setTimeout(() => {
                    successModal.hide();
                    sessionStorage.removeItem("editSuccess");
                }, 1000);
            }

            if (sessionStorage.getItem("deleteSuccess") === "true") {
                var deleteSuccessModal = new bootstrap.Modal(document.getElementById('deleteSuccessModal'));
                deleteSuccessModal.show();
                setTimeout(() => {
                    deleteSuccessModal.hide();
                    sessionStorage.removeItem("deleteSuccess");
                }, 1000);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
