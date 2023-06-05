<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../models/Item.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['itemId'])) {
        $itemId = $_POST['itemId'];

        $item = Item::getItemById($itemId);

        if ($item) {
            if ($item->getSold()) {
                $item->setSoldStatus(false);
            } else {
                $item->setSoldStatus(true);
            }

            // Spara ändringarna i databasen
            $item->updateItem();

            // Hämta säljar-ID från plagget
            $sellerId = $item->getSellerIdFromItem();

            header("Location: ../views/sellerDetails.php?id=" . $sellerId);
            exit();
        }
    }
}

header("Location: ../index.php");
exit();
?> 





