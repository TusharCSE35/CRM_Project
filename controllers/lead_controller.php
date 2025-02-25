<?php
require_once __DIR__ .'/../classes/crm.php';

class LeadController {
    private $crm;

    public function __construct() {
        $this->crm = new CRM();
    }

    public function addLead() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = $_POST['name'];
            $address = $_POST['address'];
            $website = $_POST['website'];
            $this->crm->addLead($name, $address, $website);
        }
    }

    public function handleRequest() {
        if (isset($_GET['confirm_delete'])) {
            $delete_id = $_GET['confirm_delete'];
            $this->crm->deleteLead($delete_id);
            header("Location: display_lead.php?deleted=1");
            exit();
        }
        if (isset($_POST['update_lead'])) {
            $id      = $_POST['id'];
            $name    = $_POST['name'];
            $address = $_POST['address'];
            $website = $_POST['website'];
            $this->crm->updateLead($id, $name, $address, $website);
            header("Location: display_lead.php?updated=1");
            exit();
        }
    }

    public function displayLeads() {
        return $this->crm->displayLeads();
    }

    public function searchLeads() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lead_name'])) {
            $lead_name = trim($_POST['lead_name']);
            $leads = $this->crm->searchLeadsByName($lead_name);
            return [
                'leads' => !empty($leads) ? $leads : null,
                'searched_name' => $lead_name
            ];
        }
        return null;
    }
}
?>
