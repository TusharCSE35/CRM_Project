<?php
require_once 'controllers/lead_controller.php';

$leadController = new LeadController();
$leadController->addLead(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lead</title>
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/add_lead.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main code -->
    <div class="container mt-5">
        <h1 class="text-center">Add New Lead</h1>
        <form action="add_lead.php" method="POST" id="addLeadForm">
            <div class="mb-3">
                <label for="name" class="form-label">Lead Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" rows="4" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" id="website" name="website" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add Lead</button>
        </form>
    </div>

    <!-- Success Message Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                </div>
                <div class="modal-body">
                    Lead added successfully!
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.getElementById('addLeadForm').addEventListener('submit', function (event) {
            event.preventDefault(); 
            
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            setTimeout(function() {
                successModal.hide();
                event.target.submit();
            }, 1000);
        });
    </script>
</body>
</html>
