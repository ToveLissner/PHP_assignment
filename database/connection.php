<?php

$host="localhost";
$db="php_slutprojekt_secondhand";
$user="php_slutprojekt_secondhand";
$password="123456";

$dsn="mysql:host=$host;dbname=$db;charset=UTF8"; 

try {
    $pdo=new PDO ($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // if($pdo){
    //     echo "connected";
    // }
} catch (PDOException $e){
echo "Anslutningen misslyckades: " . $e->getMessage();
}



// require_once '../config.php';

// $dsn = "mysql:host={$db_config['host']};dbname={$db_config['db']};charset=UTF8";

// try {
//     $pdo = new PDO($dsn, $db_config['user'], $db_config['password']);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $pdo->exec("SET time_zone = '{$db_config['timezone']}'");
//     // if($pdo){
//     //     echo "connected";
//     // }
// } catch (PDOException $e) {
//     // Logga detaljerat felmeddelande i en loggfil eller liknande
//     echo "Anslutningen misslyckades. Vänligen kontakta administratören för support.";
//     // Visa generisk felmeddelandesida för användaren
//     // header("Location: error_page.php"); // Omdirigera till en generisk felmeddelandesida
//     exit();
// }

// ?>








