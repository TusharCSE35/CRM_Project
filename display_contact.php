<?php
require_once 'controllers/contact_controller.php';

$contactController = new ContactController();
$contactController->handleRequest();
$contacts = $contactController->displayContacts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Contacts</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/display_contact.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>
    
    <!-- Main code -->
    <div class="container mt-5">
        <h1 class="text-center">All Contacts</h1>

        <?php if (empty($contacts)): ?>
            <h3 class="text-center">No Contact Data Available</h3>
        <?php else: ?>
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table">
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
                                <td><?= isset($contact['lead_website']) ? htmlspecialchars($contact['lead_website']) : 'N/A' ?></td>
                                <td><?= isset($contact['lead_address']) ? htmlspecialchars($contact['lead_address']) : 'N/A' ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm update-btn" data-id="<?= $contact['id'] ?>" data-name="<?= htmlspecialchars($contact['name']) ?>" data-email="<?= htmlspecialchars($contact['email']) ?>" data-address="<?= htmlspecialchars($contact['address']) ?>" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $contact['id'] ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Update Contact Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header model-edit-success">
                    <h5 class="modal-title" id="updateModalLabel">Update Contact</h5>
                </div>
                <form method="POST" action="display_contact.php">
                    <div class="modal-body">
                        <input type="hidden" name="contact_id" id="updateContactId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="updateName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="updateEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="updateAddress" name="address" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn model-edit-success" name="update_contact">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header model-delete-success">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this contact?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal (Auto-Close After 1s) -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header model-edit-success">
                    <h5 class="modal-title" id="successModalLabel">Action Successful</h5>
                </div>
                <div class="modal-body text-center">
                    <p>The contact has been successfully updated.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal for Deletion (Auto-Close After 1s) -->
    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header model-delete-success">
                    <h5 class="modal-title" id="deleteSuccessModalLabel">Action Successful</h5>
                </div>
                <div class="modal-body text-center">
                    <p>The contact has been successfully deleted.</p>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript for Handling Update and Delete -->
    <script>
        document.querySelectorAll('.update-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('updateContactId').value = this.getAttribute('data-id');
                document.getElementById('updateName').value = this.getAttribute('data-name');
                document.getElementById('updateEmail').value = this.getAttribute('data-email');
                document.getElementById('updateAddress').value = this.getAttribute('data-address');
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let deleteId = this.getAttribute('data-id');
                document.getElementById('confirmDeleteBtn').href = "display_contact.php?delete=" + deleteId;
            });
        });

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('editSuccess')) {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            setTimeout(function() {
                successModal.hide();
            }, 1000);
        }

        if (urlParams.has('deleteSuccess')) {
            var deleteSuccessModal = new bootstrap.Modal(document.getElementById('deleteSuccessModal'));
            deleteSuccessModal.show();

            setTimeout(function() {
                deleteSuccessModal.hide();
            }, 1000);
        }

        window.history.replaceState(null, "", window.location.pathname);
    </script>
</body>
</html>
