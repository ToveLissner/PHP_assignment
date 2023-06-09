<?php
require '../models/Item.php';

try {
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

            $item->updateItem();

            $sellerId = $item->getSellerIdFromItem();

            header("Location: ../views/sellerDetails.php?id=" . $sellerId);
            exit();
        }
    }
}

header("Location: ../index.php");
exit();
} catch (Exception $e) {
    echo "Ett fel uppstod: " . $e->getMessage();
}
