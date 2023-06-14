<?php
require '../database/connection.php';
include '../models/Item.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {            
        if (isset($_POST['id'])) {
            $itemId = $_POST['id'];

            $item = Item::getItemById($itemId);

            if ($item) {
                $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
                $price = number_format((float) str_replace(',', '.', filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND)), 2, '.', '');

                $item->setDescription($description);    
                $item->setPrice($price); 

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
