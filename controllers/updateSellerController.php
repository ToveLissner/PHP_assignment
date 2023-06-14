<?php
require '../database/connection.php';
include '../models/Seller.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
        if (isset($_POST['id'])) {
            $sellerId = $_POST['id'];

            $seller = Seller::getSellerById($sellerId);

            if ($seller) {
                $firstname=filter_var($_POST['firstname'],FILTER_SANITIZE_SPECIAL_CHARS); 
                $lastname=filter_var($_POST['lastname'],FILTER_SANITIZE_SPECIAL_CHARS); 
                $phone=filter_var($_POST['phone'],FILTER_SANITIZE_SPECIAL_CHARS); 

                $seller->setFirstname($firstname);
                $seller->setLastname($lastname);
                $seller->setPhone($phone);

                $seller->updateSeller();

                header('Location: ../views/sellerDetails.php?id=' . $sellerId);
                exit;
            } else {
                echo "Säljaren hittades inte.";         
            }
        } else {
            echo "Säljar-ID saknas.";
        }
    } else {
        echo "Otillåtet anrop.";
    }
} catch (Exception $e) {
    echo "Ett fel uppstod: " . $e->getMessage();
}






