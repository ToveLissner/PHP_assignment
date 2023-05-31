<?php
require '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['firstname'],$_POST['lastname'],$_POST['phone'])){
        $firstname=filter_var($_POST['firstname'],FILTER_SANITIZE_SPECIAL_CHARS); 
        $lastname=filter_var($_POST['lastname'],FILTER_SANITIZE_SPECIAL_CHARS); 
        $phone=filter_var($_POST['phone'],FILTER_SANITIZE_SPECIAL_CHARS); 
    
        $sql="INSERT INTO sellers (firstname, lastname, phone) VALUES (?,?,?)"; 
        $statement=$pdo->prepare($sql);
        $statement->execute([$firstname,$lastname,$phone]);  
    }

    header('Location: ../index.php');
    exit;
}
?>