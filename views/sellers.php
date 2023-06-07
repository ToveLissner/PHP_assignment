<?php
require '../database/connection.php';
include '../partials/header.php';
include '../models/Seller.php';
?>

<h2>Säljare</h2>

<button class="container largeButton"><a href="createSeller.php">Lägg till ny säljare</a></button>
<button class="largeButton"><a href="sellers.php?sort=alphabetical">Sortera på förnamn</a></button>

<?php
$sellers = Seller::getAllSellers();
?>

<?php
$sellers = null;

if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
    $sellers = Seller::getAllSellersAlphabetical();
} else {
    $sellers = Seller::getAllSellers();
}
?>

<ul class="ulContainerLarge">
    <?php foreach ($sellers as $seller) { ?>
        <li class="liContainerSeller">
            <strong>FörsäljarId:</strong> <?php echo $seller->getSellerId(); ?><br>
            <strong>Namn:</strong> <?php echo $seller->getFirstname() . ' ' . $seller->getLastname(); ?><br>
            <strong>Telefon:</strong> <?php echo $seller->getPhoneNumber(); ?><br>
            <button class="smallButton"><a href="sellerDetails.php?id=<?php echo $seller->getSellerId(); ?>">Mer information</a></button>
            <button class="smallButton"><a href="editSeller.php?id=<?php echo $seller->getSellerId(); ?>">Redigera</a></button>
        </li>
    <?php } ?>
</ul>

<?php include '../partials/footer.php'; ?>





