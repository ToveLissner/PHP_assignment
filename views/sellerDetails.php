<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../database/connection.php';
include '../partials/header.php';
include '../models/Seller.php';

?>

<h2>Detaljerad information</h2>

<?php
// Kontrollera att det finns en giltig säljar-ID i URL:en
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sellerId = $_GET['id'];

    // Hämta säljaren från databasen baserat på ID
    $seller = Seller::getSellerById($sellerId);

    if ($seller) {
        $items = $seller->getItems();

        ?>
        <h3>Säljare: <?php echo $seller->getFirstname() . ' ' . $seller->getLastname(); ?></h3>
        <p>Telefon: <?php echo $seller->getPhoneNumber(); ?></p>

        <?php         // Antal inlämnade plagg
        $submittedItems = array_filter($items, function($item) {
            return !$item->getSold();
        });

        $numberOfSubmittedItems = count($submittedItems);

        echo "<p>Antal inlämnade plagg: $numberOfSubmittedItems</p>";

        // Antal sålda plagg
        $soldItems = array_filter($items, function($item) {
            return $item->getSold();
        });

        $numberOfSoldItems = count($soldItems);

        echo "<p>Antal sålda plagg: $numberOfSoldItems</p>";

        // Total försäljningssumma
        $totalSales = 0;
        foreach ($soldItems as $item) {
            $totalSales += $item->getPrice();
        }

        echo "<p>Total försäljningssumma: $totalSales kr</p>";

        ?>

<h4>Alla plagg som säljaren lämnat in:</h4>
<?php if (count($items) > 0) : ?>
    <ul>
        <?php foreach ($items as $item) : ?>
            <li>
                <?php echo $item->getDescription() . ' (' . $item->getPrice() . ' kr)'; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Inga plagg tillgängliga.</p>
<?php endif; ?>

    <?php } else { ?>
        <p>Säljaren kunde inte hittas.</p>
    <?php }
} else { ?>
    <p>Ogiltigt säljar-ID.</p>
<?php } 

if (isset($_GET['id'])) {
    $sellerId = $_GET['id'];
    $seller = Seller::getSellerById($sellerId);
}

?>

<h2>Lägg till nytt objekt</h2>

<form action="../controllers/createItemController.php" method="POST" >
    <label for="description">Beskrivning:</label>
    <input type="text" name="description" id="description" required><br>

    <label for="price">Pris:</label>
    <input type="text" name="price" id="price" required><br>

    <!-- <label for="seller_id">Säljare:</label>
    <input type="text" name="seller_id" id="seller_id" required><br> -->

    <input type="hidden" name="seller_id" value="<?php echo $sellerId; ?>">

    <button type="submit">Lägg till</button>
</form>

<h2>Redigera säljare</h2>

<?php if ($seller): ?>
    <form action="../controllers/updateSellerController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $seller->getSellerId(); ?>">
        <label for="firstname">Förnamn:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $seller->getFirstname(); ?>" required><br>

        <label for="lastname">Efternamn:</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $seller->getLastname(); ?>" required><br>

        <label for="phone">Telefon:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $seller->getPhoneNumber(); ?>" required><br>

        <button type="submit">Spara ändringar</button>
    </form>
<?php else: ?>
    <p>Kunde inte hitta säljaren.</p>
<?php endif; ?>

<?php include '../partials/footer.php'; ?>
