
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>

    <!-- Full-width Heading -->
    <div class="container-fluid">
        <h1 class="crm-heading text-center">Customer Relationship Management</h1>
    </div>

    <!-- Main Content -->
    <div class="container-fluid main-container">
        <div class="row align-items-center">
            <div class="col-md-8 left-content">
                <div class="section">
                    <h2 class="section-title">Leads</h2>
                    <a href="add_lead.php" class="btn btn-primary wide-btn">Add Lead</a>
                    <a href="search_lead.php" class="btn btn-secondary wide-btn">Search Lead</a>
                    <a href="display_lead.php" class="btn btn-success wide-btn">Display Lead</a>
                </div>

                <div class="section contacts-section">
                    <h2 class="section-title">Contacts</h2>
                    <a href="add_contact.php" class="btn btn-primary wide-btn">Add Contact</a>
                    <a href="search_contact.php" class="btn btn-secondary wide-btn">Search Contact</a>
                    <a href="display_contact.php" class="btn btn-success wide-btn">Display Contact</a>
                </div>

                <div class="section details-section">
                    <h2 class="section-title">Details</h2>
                    <a href="display_lead_contact.php" class="btn btn-dark wide-btn">Display Lead & Contact</a>
                </div>
            </div>

            <div class="col-md-4"></div>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
