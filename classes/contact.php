<?php
require_once __DIR__ .'/../config/db.php';

class Contact {
    private $db;

    public function __construct() {
        $database = new Database(); 
        $this->db = $database->getConnection();
    }

    public function addContact($lead_id, $name, $email, $address) {
        $stmt = $this->db->prepare("INSERT INTO contacts (lead_id, name, email, address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$lead_id, $name, $email, $address]);
    }
    
    public function getContacts() {
        $stmt = $this->db->query("
            SELECT c.id, c.name, c.email, c.address, 
                   l.id AS lead_id, l.name AS lead_name, 
                   l.website AS lead_website, l.address AS lead_address
            FROM contacts c
            LEFT JOIN leads l ON c.lead_id = l.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContactsByLeadId($leadId) {
        $stmt = $this->db->prepare("SELECT * FROM contacts WHERE lead_id = ?");
        $stmt->execute([$leadId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContactById($id) {
        $stmt = $this->db->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateContact($id, $name, $email, $address) {
        $stmt = $this->db->prepare("UPDATE contacts SET name = ?, email = ?, address = ? WHERE id = ?");
        $stmt->execute([$name, $email, $address, $id]);
    }

    public function searchContactsByName($name) {
        $stmt = $this->db->prepare("
            SELECT c.id, c.name, c.email, c.address, 
                l.id AS lead_id, l.name AS lead_name, l.website AS lead_website, l.address AS lead_address
            FROM contacts c
            LEFT JOIN leads l ON c.lead_id = l.id
            WHERE c.name LIKE ?
        ");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteContact($id) {
        $stmt = $this->db->prepare("DELETE FROM contacts WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
}
?>
