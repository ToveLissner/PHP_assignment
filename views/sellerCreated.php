<?php
require_once '../models/Seller.php';
include '../partials/header.php';

if (isset($_GET['id'])) {
    $sellerId = $_GET['id'];

    $seller = Seller::getSellerById($sellerId);

    if ($seller) {
        echo "<h2>Säljare skapad</h2>";
        echo "<div class='smallContainer'>";
        echo "<p>ID: " . $seller->getSellerId() . "</p>";
        echo "<p>Förnamn: " . $seller->getFirstname() . "</p>";
        echo "<p>Efternamn: " . $seller->getLastname() . "</p>";
        echo "<p>Telefon: " . $seller->getPhoneNumber() . "</p>";

        echo "<button>"; 
        echo "<a href='sellerDetails.php?id=" . $seller->getSellerId() . "'>Till säljaren</a>";
        echo "</button>"; 

        echo "</div>";

    } else {
        echo "Kunde inte hitta säljaren.";
    }
} else {
    echo "ID saknas.";
}

include '../partials/footer.php';

?>

