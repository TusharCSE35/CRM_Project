<?php
require_once __DIR__ .'/../classes/crm.php';

class ContactController {
    public $leads = null;
    public $searched_name = null;
    public $contact_added = false;
    public $lead_id = null;

    private $crm;

    public function __construct() {
        $this->crm = new CRM();
    }

    public function addContact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['lead_name']) && !empty($_POST['lead_name'])) {
                $this->searched_name = $_POST['lead_name'];
                $this->leads = $this->crm->searchLeadsByName($this->searched_name);
            }

            if (isset($_POST['selected_lead_id']) && isset($_POST['contact_name']) && isset($_POST['contact_email']) && isset($_POST['contact_address'])) {
                $this->crm->addContact($_POST['selected_lead_id'], $_POST['contact_name'], $_POST['contact_email'], $_POST['contact_address']);
                $this->contact_added = true;  
                $this->lead_id = $_POST['selected_lead_id'];  
            }
        }
    }

    public function handleRequest() {
        if (isset($_GET['delete'])) {
            $contactId = $_GET['delete'];
            $this->crm->deleteContact($contactId);  
            header("Location: display_contact.php?deleteSuccess=true");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_id'])) {
            $contactId = $_POST['contact_id'];
            $name      = $_POST['name'];
            $email     = $_POST['email'];
            $address   = $_POST['address'];
    
            $this->crm->updateContact($contactId, $name, $email, $address); 
    
            header("Location: display_contact.php?editSuccess=true");
            exit();
        }
    }

    public function displayContacts() {
        return $this->crm->displayContacts();
    }
}
?>
