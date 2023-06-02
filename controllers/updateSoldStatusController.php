<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../models/Item.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['itemId'])) {
        $itemId = $_POST['itemId'];

        // Hämta plagget från databasen baserat på ID
        $item = Item::getItemById($itemId);

        if ($item) {
            // Uppdatera sold-statusen för plagget
            if ($item->getSold()) {
                $item->setSoldStatus(false);
            } else {
                $item->setSoldStatus(true);
            }

            // Spara ändringarna i databasen
            $item->updateItem();

            // Hämta säljar-ID från plagget
            $sellerId = $item->getSellerIdFromItem();

            // Skicka användaren tillbaka till säljardetaljerna
            header("Location: ../views/sellerDetails.php?id=" . $sellerId);
            exit();
        }
    }
}

// Om något går fel eller om det saknas POST-data, skicka användaren tillbaka till startsidan
header("Location: ../index.php");
exit();


// require '../database/connection.php';
// include '../models/Item.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Kontrollera om itemId och sold-postvariabler är satta
//     if (isset($_POST['itemId']) && isset($_POST['sold'])) {
//         // Hämta itemId och sold-värdet från POST-data
//         $itemId = $_POST['itemId'];
//         $sold = isset($_POST['sold']) && $_POST['sold'] == 'on' ? 1 : 0;
//         $sold = !$sold;
//         // $sold = $_POST['sold'] == '1' ? 1 : 0; 

//         // Hämta objektet med hjälp av itemId
//         $item = Item::getItemById($itemId);

//         if ($item) {
//             // Uppdatera sold-statusen för objektet
//             $item->setSoldStatus($sold);
//             $item->updateItem();

//             // Redirect tillbaka till säljardetaljvyn
//             header('Location: ../views/sellerDetails.php?id=' . $item->getSellerIdFromItem());
//             exit();
//         }
//     }
// }

// // Om något gick fel, redirecta tillbaka till föregående sida
// header('Location: ' . $_SERVER['HTTP_REFERER']);
// exit();
// ?> 





