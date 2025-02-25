<?php
require_once 'controllers/lead_controller.php';

$leadController = new LeadController();
$searchResult = $leadController->searchLeads();

$leads = $searchResult['leads'] ?? null;
$searched_name = $searchResult['searched_name'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Lead</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/search_lead.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Search Lead</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="lead_name" class="form-label">Search Lead by Name</label>
                <input type="text" id="lead_name" name="lead_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Search Leads</button>
        </form>

        <?php if (isset($leads) && count($leads) > 0): ?>
            <div class="table-responsive mt-4">
                <h2 class="mb-4">Matching Leads</h2>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Website</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leads as $lead): ?>
                            <tr>
                                <td><?= $lead['id'] ?></td>
                                <td><?= htmlspecialchars($lead['name']) ?></td>
                                <td><?= htmlspecialchars($lead['address']) ?></td>
                                <td><a href="<?= htmlspecialchars($lead['website']) ?>" target="_blank"><?= htmlspecialchars($lead['website']) ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif (isset($searched_name)): ?>
            <p class="mt-4 text-danger">No leads found with the name "<?= htmlspecialchars($searched_name) ?>". Please try a different name.</p>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
