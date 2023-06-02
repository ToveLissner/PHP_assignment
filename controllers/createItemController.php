<?php
require '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['description'],$_POST['price'],$_POST['seller_id'])){
        $description=filter_var($_POST['description'],FILTER_SANITIZE_SPECIAL_CHARS); 
        $price=filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_FLOAT); 
        // $seller_id=filter_var($_POST['seller_id'],FILTER_SANITIZE_NUMBER_INT); 

        $seller_id = $_GET['id'];
    
        $sql="INSERT INTO items (description, price, seller_id) VALUES (?,?,?)"; 
        $statement=$pdo->prepare($sql);
        $statement->execute([$description,$price,$seller_id]);  
    }

    header('Location: ../views/sellerDetails.php?id=' . $seller_id);
    exit;
}
?>



