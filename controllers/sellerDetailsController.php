<?php
require '../database/connection.php';
include_once '../models/Seller.php';
include_once '../models/Item.php';

try {
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sellerId = $_GET['id'];

    $seller = Seller::getSellerById($sellerId);

    if ($seller) {
        $items = $seller->getItems();
                $submittedItems = array_filter($items, function($item) {
                return $item->getSold() == 0;
                });

                $numberOfSubmittedItems = count($submittedItems);

        $soldItems = array_filter($items, function($item) {
            return $item->getSold() == 1;
        });

        $numberOfSoldItems = count($soldItems);

        $totalItems = $numberOfSubmittedItems + $numberOfSoldItems;

        $totalSales = 0;
        foreach ($soldItems as $item) {
            $totalSales += $item->getPrice();
        }

        $itemsFromItem = Item::getAllItems();

    } else {
        echo "Säljaren kunde inte hittas.";
    }
} else {
    echo "Ogiltigt säljar-ID.";
}
} catch (Exception $e) {
    echo "Ett fel uppstod: " . $e->getMessage();
}