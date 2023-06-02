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
            $item->setSoldStatus($_POST['sold']);
            // $item->setDateSold($_POST['date_sold']);
            $item->setSellerIdFromItem($_POST['seller_id']);

            $item->updateItem();

            header('Location: ../views/editItem.php?id=' . $itemId);    
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

?>