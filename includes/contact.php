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
        // global $pdo;
        
        // $stmt = $pdo->prepare("SELECT * FROM contacts WHERE name LIKE ?");
        // $stmt->execute(['%' . $name . '%']);
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT c.id, c.name, c.email, c.address, 
                l.id AS lead_id, l.name AS lead_name, l.website AS lead_website, l.address AS lead_address
            FROM contacts c
            LEFT JOIN leads l ON c.lead_id = l.id
            WHERE c.name LIKE ?
        ");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
