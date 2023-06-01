<?php
require '../database/connection.php';
include '../models/Seller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
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

            // Vidare till en annan sida - kan jag använda samma för alla? - fråga om det 
            header('Location: ../views/updateSuccess.php');
            exit();
        } else {
            echo "Säljaren hittades inte.";         // fråga lite kring felhantering 
        }
    } else {
        echo "Säljar-ID saknas.";
    }
} else {
    echo "Otillåtet anrop.";
}

header('Location: ../index.php');
exit;

?>

