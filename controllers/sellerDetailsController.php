<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../database/connection.php';
include '../models/Seller.php';
include_once '../models/Item.php';

// Kontrollera att det finns en giltig säljar-ID i URL:en
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sellerId = $_GET['id'];

    // Hämta säljaren från databasen baserat på ID
    $seller = Seller::getSellerById($sellerId);

    if ($seller) {
        $items = $seller->getItems();

        // Gör de beräkningar och datalogik som behövs
            // Antal objekt som är ute till försäljning 
                $submittedItems = array_filter($items, function($item) {
                return $item->getSold() == 0;
                });

                $numberOfSubmittedItems = count($submittedItems);

                        // Antal sålda objekt
        $soldItems = array_filter($items, function($item) {
            return $item->getSold() == 1;
        });

        $numberOfSoldItems = count($soldItems);

        // Totalt antal inlämnade objekt
        $totalItems = $numberOfSubmittedItems + $numberOfSoldItems;

        // Total försäljningssumma
        $totalSales = 0;
        foreach ($soldItems as $item) {
            $totalSales += $item->getPrice();
        }

        // hämtar alla items från items-tabellen
        $itemsFromItem = Item::getAllItems();

    } else {
        echo "Säljaren kunde inte hittas.";
    }
} else {
    echo "Ogiltigt säljar-ID.";
}
?>



        





