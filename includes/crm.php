<?php
require_once 'lead.php';
require_once 'contact.php';

class CRM {
    private $lead;
    private $contact;

    public function __construct() {
        $this->lead = new Lead();
        $this->contact = new Contact();
    }

    public function addLead($name, $address, $website) {
        $this->lead->addLead($name, $address, $website);
    }

    public function addContact($lead_id, $name, $email, $address) {
        $this->contact->addContact($lead_id, $name, $email, $address);
    }

    public function displayLeads() {
        return $this->lead->getLeads();
    }

    public function displayContacts($lead_id) {
        return $this->contact->getContactsByLeadId($lead_id);
    }

    public function modifyLead($id, $name, $address, $website) {
        $this->lead->updateLead($id, $name, $address, $website);
    }

    public function modifyContact($id, $name, $email, $address) {
        $this->contact->updateContact($id, $name, $email, $address);
    }

    public function searchLeadsByName($name) {
        return $this->lead->searchLeadsByName($name);
    }

    public function searchContactsByName($name) {
        return $this->contact->searchContactsByName($name);
    }
}
?>
