<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../database/connection.php';
include '../models/Item.php';

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

            // if (!$item->getSold()) {
            //     $sql = "UPDATE items SET date_sold = NULL WHERE id = ?";
            //     $statement = $pdo->prepare($sql);
            //     $statement->execute([$item->getItemId()]);
            // }

            if (!$item->getSold()) {
                $item->setDateSold(null);
            }

            $item->updateItem();

            $seller_id = $item->getSellerIdFromItem();

            header('Location: ../views/sellerDetails.php?id=' . $seller_id);    
            exit;
        } else {
            echo "Hittades hittades inte.";         // fråga lite kring felhantering 
        }
    } else {
        echo "ID saknas.";
    }
} else {
    echo "Otillåtet anrop.";
}
