<?php

require_once 'classes/crm.php';
$crm = new CRM();

$leads = $crm->displayLeads();  

foreach ($leads as $lead) {
    echo "<h2>" . htmlspecialchars($lead['name']) . "</h2>";
    echo "<p>" . htmlspecialchars($lead['address']) . "</p>";
    echo "<p>" . htmlspecialchars($lead['website']) . "</p>";

    $contacts = $crm->getContactsByLeadId($lead['id']);  
    echo "<h3>Contacts:</h3>";

    if ($contacts) {
        foreach ($contacts as $contact) {
            echo "<p>" . htmlspecialchars($contact['name']) . " - " . htmlspecialchars($contact['email']) . "</p>";
        }
    } else {
        echo "<p>No contacts found for this lead.</p>";
    }
}
?>
