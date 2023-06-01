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

// om jag ska använda den där config-filen 

// require_once '../config.php';

// $dsn = "mysql:host={$db_config['host']};dbname={$db_config['db']};charset=UTF8";

// try {
//     $pdo = new PDO($dsn, $db_config['user'], $db_config['password']);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $pdo->exec("SET time_zone = '{$db_config['timezone']}'");
// } catch (PDOException $e) {
//     echo "Anslutningen misslyckades. Vänligen kontakta administratören för support.";
//     // header("Location: error_page.php"); // Omdirigera till en generisk felmeddelandesida
//     exit();
// }

// ?>








