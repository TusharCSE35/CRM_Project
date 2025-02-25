<?php
require_once __DIR__ .'/../config/db.php';

class Lead {
    private $db;

    public function __construct() {
        $database = new Database(); 
        $this->db = $database->getConnection(); 
    }

    public function addLead($name, $address, $website) {
        $stmt = $this->db->prepare("INSERT INTO leads (name, address, website) VALUES (?, ?, ?)");
        $stmt->execute([$name, $address, $website]);
    }

    public function getLeads() {
        $stmt = $this->db->query("SELECT * FROM leads");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLeadById($id) {
        $stmt = $this->db->prepare("SELECT * FROM leads WHERE id = ?");
        $stmt->execute([$id]);
        $lead = $stmt->fetch(PDO::FETCH_ASSOC);
        return $lead ? $lead : null; 
    }

    public function updateLead($id, $name, $address, $website) {
        $stmt = $this->db->prepare("UPDATE leads SET name = ?, address = ?, website = ? WHERE id = ?");
        $stmt->execute([$name, $address, $website, $id]);
    }

    public function searchLeadsByName($name) {
        $stmt = $this->db->prepare("SELECT * FROM leads WHERE name LIKE ?");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteLead($id) {
        $stmt = $this->db->prepare("DELETE FROM leads WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>