<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - CRM Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/about.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center page-title">🔥 About Our CRM Project 🔥</h1>

        <section class="card shadow-lg p-4 mb-5">
            <h3 class="section-title">🚀 Project Overview</h3>
            <p>Our CRM (Customer Relationship Management) system is designed to help businesses efficiently manage their leads, contacts, and customer interactions. It simplifies workflows and enhances customer engagement.</p>
        </section>

        <section class="card shadow-lg p-4 mb-5">
            <h3 class="section-title">🛠 Project Process</h3>
            <ol class="custom-list">
                <li><strong>Lead Collection:</strong> Capture leads from multiple sources.</li>
                <li><strong>Data Management:</strong> Store, update, and manage customer details.</li>
                <li><strong>Communication Tracking:</strong> Monitor interactions with customers.</li>
                <li><strong>Task Management:</strong> Assign and track tasks.</li>
                <li><strong>Analytics & Reporting:</strong> Generate insights.</li>
            </ol>
        </section>

        <section class="card shadow-lg p-4 mb-5">
            <h3 class="section-title">✨ Key Features</h3>
            <div class="row">
                <div class="col-md-4 feature-box">✅ Lead & Contact Management</div>
                <div class="col-md-4 feature-box">✅ Advanced Search & Filters</div>
                <div class="col-md-4 feature-box">✅ Automated Follow-ups</div>
                <div class="col-md-4 feature-box">✅ Multi-user Role Management</div>
                <div class="col-md-4 feature-box">✅ Reports & Analytics</div>
                <div class="col-md-4 feature-box">✅ Secure Authentication</div>
            </div>
        </section>

        <section class="card shadow-lg p-4 mb-5">
            <h3 class="section-title">💻 Technologies Used</h3>
            <ul class="custom-list">
                <li><strong>Backend:</strong> PHP & MySQL</li>
                <li><strong>Frontend:</strong> HTML, CSS, Bootstrap, JavaScript</li>
                <li><strong>Database:</strong> MySQL (MySQL Workbench)</li>
                <li><strong>Environment:</strong> VS Code on Ubuntu</li>
            </ul>
        </section>

        <section class="card shadow-lg p-4 mb-5">
            <h3 class="section-title">📩 Contact Us</h3>
            <p>If you have any queries or want to collaborate, reach out to us:</p>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control form-custom" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control form-custom" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control form-custom" id="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>Connect with us:</p>
            <a href="https://www.facebook.com/tushar.sarkar.7186896" target="_blank" class="social-icon">🌍 Facebook</a> |
            <a href="https://github.com/TusharCSE35" target="_blank" class="social-icon">💻 GitHub</a> |
            <a href="https://www.linkedin.com/in/tushar-sarkar-433726195/" target="_blank" class="social-icon">🔗 LinkedIn</a>
            <p class="mt-2">Developed by <strong>Tushar Sarkar</strong></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
