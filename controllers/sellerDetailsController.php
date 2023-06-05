<?php
require_once '../models/Seller.php';
require_once '../models/Item.php';

// Hämta säljaren från databasen baserat på ID
$seller = Seller::getSellerById($sellerId);

if ($seller) {
    $items = $seller->getItems();

    $submittedItems = array_filter($items, function ($item) {
        return $item->getSold() == 0;
    });
    $numberOfSubmittedItems = count($submittedItems);

    $soldItems = array_filter($items, function ($item) {
        return $item->getSold() == 1;
    });
    $numberOfSoldItems = count($soldItems);

    $totalItems = $numberOfSubmittedItems + $numberOfSoldItems;

    $totalSales = 0;
    foreach ($soldItems as $item) {
        $totalSales += $item->getPrice();
    }
}

include '../views/sellerDetails.php';
?>
