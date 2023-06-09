<?php
require '../database/connection.php';
include '../models/Item.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {            
        if (isset($_POST['id'])) {
            $itemId = $_POST['id'];

            $item = Item::getItemById($itemId);

            if ($item) {
                $item->setDescription($_POST['description']);
                $item->setPrice($_POST['price']);
                $item->setDate($_POST['date']);
                $item->setSoldStatus(isset($_POST['sold']));
                $item->setSellerIdFromItem($_POST['seller_id']);

                if (!$item->getSold()) {
                    $item->setDateSold(null);
                }

                $item->updateItem();

                $seller_id = $item->getSellerIdFromItem();

                header('Location: ../views/sellerDetails.php?id=' . $seller_id);    
                exit;
            } else {
                echo "Hittades inte.";        
            }
        } else {
            echo "ID saknas.";
        }
    } else {
        echo "Otillåtet anrop.";
    }
} catch (Exception $e) {
    echo "Ett fel uppstod: " . $e->getMessage();
}
