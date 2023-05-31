<?php
require '../database/connection.php';
include '../partials/header.php';
include '../models/Seller.php';
?>

<h2>Säljare</h2>

<a href="createSeller.php">Lägg till ny säljare</a>

<?php
$sellers = Seller::getAllSellers();
?>

<ul>
    <?php foreach ($sellers as $seller): ?>
        <li>
            <strong>ID:</strong> <?php echo $seller->getSellerId(); ?><br>
            <strong>Förnamn:</strong> <?php echo $seller->getFirstname(); ?><br>
            <strong>Efternamn:</strong> <?php echo $seller->getLastname(); ?><br>
            <strong>Telefon:</strong> <?php echo $seller->getPhoneNumber(); ?><br>
            <a href="editSeller.php?id=<?php echo $seller->getSellerId(); ?>">Redigera</a>
            <a href="deleteSeller.php?id=<?php echo $seller->getSellerId(); ?>">Ta bort</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../partials/footer.php'; ?>





