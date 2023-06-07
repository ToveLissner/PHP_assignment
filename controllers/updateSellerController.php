<?php
require '../database/connection.php';
include '../models/Seller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
    if (isset($_POST['id'])) {
        $sellerId = $_POST['id'];

        $seller = Seller::getSellerById($sellerId);

        if ($seller) {
            $seller->setFirstname($_POST['firstname']);
            $seller->setLastname($_POST['lastname']);
            $seller->setPhone($_POST['phone']);

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

?>




