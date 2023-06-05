<?php

$host="localhost";
$db="php_slutprojekt_secondhand";
$user="php_slutprojekt_secondhand";
$password="123456";

$dsn="mysql:host=$host;dbname=$db;charset=UTF8"; 

try {
    $pdo=new PDO ($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
echo "Anslutningen misslyckades: " . $e->getMessage();
}

// 'timezone' => 'Europe/Stockholm' // ska jag ha med timezone?

?>










