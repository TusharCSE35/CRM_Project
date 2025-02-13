<?php
require_once 'db.php';

class Contact {
    public function addContact($lead_id, $name, $email, $address) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO contacts (lead_id, name, email, address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$lead_id, $name, $email, $address]);
    }

    public function getContactsByLeadId($lead_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE lead_id = ?");
        $stmt->execute([$lead_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContactById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateContact($id, $name, $email, $address) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE contacts SET name = ?, email = ?, address = ? WHERE id = ?");
        $stmt->execute([$name, $email, $address, $id]);
    }

    public function searchContactsByName($name) {
        global $pdo;
        // Use a LIKE query for partial matches
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE name LIKE ?");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
