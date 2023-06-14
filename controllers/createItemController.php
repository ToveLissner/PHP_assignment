<?php
require '../database/connection.php';
include '../models/Seller.php';

if (isset($_GET['id'])) {
    $sellerId = $_GET['id'];
    $seller = Seller::getSellerById($sellerId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['description'], $_POST['price'])) {
            $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
            $price = number_format((float) str_replace(',', '.', filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND)), 2, '.', '');

            if ($price == 0) {
                echo "Vänligen ange ett giltigt pris";
            } else {

            try {
            $sql = "INSERT INTO items (description, price, seller_id) VALUES (?,?,?)";
            $statement = $pdo->prepare($sql);
            $statement->execute([$description, $price, $sellerId]);

            header('Location: ../views/sellerDetails.php?id=' . $sellerId);
            exit;
            } catch (PDOException $e){
                echo "Ett fel uppstod vid skapandet av detta objekt" . $e->getMessage();
            }}
        } else {
            echo "Beskrivning och pris saknas.";
        }
    }
} else {
    echo "Säljar-ID saknas.";
}