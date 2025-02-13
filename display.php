<?php
require_once 'includes/crm.php';
$crm = new CRM();

$leads = $crm->displayLeads();

foreach ($leads as $lead) {
    echo "<h2>" . $lead['name'] . "</h2>";
    echo "<p>" . $lead['address'] . "</p>";
    echo "<p>" . $lead['website'] . "</p>";

    $contacts = $crm->displayContacts($lead['id']);
    echo "<h3>Contacts:</h3>";
    foreach ($contacts as $contact) {
        echo "<p>" . $contact['name'] . " - " . $contact['email'] . "</p>";
    }
}
?>
