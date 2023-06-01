<?php
require '../database/connection.php';
include '../models/Seller.php';

// Kontrollera om POST-data har skickats 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {             // ska det vara 3 stycken "="?????
    // Kontrollera om säljar-ID har skickats
    if (isset($_POST['id'])) {
        // Hämta säljar-ID från POST-data
        $sellerId = $_POST['id'];

        // Hämta säljare från databasen baserat på säljar-ID
        $seller = Seller::getSellerById($sellerId);

        // Kontrollera om säljaren hittades
        if ($seller) {
            // Uppdatera säljarens information baserat på POST-data
            $seller->setFirstname($_POST['firstname']);
            $seller->setLastname($_POST['lastname']);
            $seller->setPhone($_POST['phone']);

            // Uppdatera säljaren i databasen
            $seller->updateSeller();

            // Vidarebefordra till en bekräftelsesida eller annan önskad destination
            header('Location: ../views/updateSuccess.php');
            exit();
        } else {
            // Säljaren hittades inte, hantera felet på lämpligt sätt
            echo "Säljaren hittades inte.";
        }
    } else {
        // Säljar-ID saknas i POST-data, hantera felet på lämpligt sätt
        echo "Säljar-ID saknas.";
    }
} else {
    // HTTP GET-anrop används, hantera det på lämpligt sätt
    echo "Otillåtet anrop.";
}

header('Location: ../index.php');
exit;

?>

