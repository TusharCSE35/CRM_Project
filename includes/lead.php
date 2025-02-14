<?php
require_once 'db.php';

class Lead {
    // Add a new lead
    public function addLead($name, $address, $website) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO leads (name, address, website) VALUES (?, ?, ?)");
        $stmt->execute([$name, $address, $website]);
    }

    // Get all leads
    public function getLeads() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM leads");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a specific lead by ID
    public function getLeadById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM leads WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a lead's information
    public function updateLead($id, $name, $address, $website) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE leads SET name = ?, address = ?, website = ? WHERE id = ?");
        $stmt->execute([$name, $address, $website, $id]);
    }

    // Search leads by name
    public function searchLeadsByName($name) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM leads WHERE name LIKE ?");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete a lead by ID
    public function deleteLead($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM leads WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
