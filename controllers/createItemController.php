<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['description'],$_POST['price'])){
        $description=filter_var($_POST['description'],FILTER_SANITIZE_SPECIAL_CHARS); 
        $price=filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_FLOAT); 

        if(isset($_GET['id'])) {
            $seller_id = $_GET['id'];
            $sql = "INSERT INTO items (description, price, seller_id) VALUES (?,?,?)"; 
            $statement = $pdo->prepare($sql);
            $statement->execute([$description, $price, $seller_id]);
            
            header('Location: ../views/sellerDetails.php?id=' . $seller_id);
            exit;

        }   else {
            echo "Säljar-ID saknas.";
        }
    }

}




