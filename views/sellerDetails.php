<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../database/connection.php';
include '../partials/header.php';
include '../models/Seller.php';
include_once '../models/Item.php';

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

        <?php
        // Antal plagg som är ute till försäljning 
        $submittedItems = array_filter($items, function($item) {
            return $item->getSold() == 0;
        });

        $numberOfSubmittedItems = count($submittedItems);

        // Antal sålda plagg
        $soldItems = array_filter($items, function($item) {
            return $item->getSold() == 1;
        });

        $numberOfSoldItems = count($soldItems);

        // Totalt antal inlämnade plagg
        $totalItems = $numberOfSubmittedItems + $numberOfSoldItems;

        echo "<p>Antal plagg ute för försäljning: $numberOfSubmittedItems</p>";
        echo "<p>Antal sålda plagg: $numberOfSoldItems</p>";
        echo "<p>Totalt antal inlämnade plagg: $totalItems</p>";


        // Total försäljningssumma
        $totalSales = 0;
        foreach ($soldItems as $item) {
            $totalSales += $item->getPrice();
        }

        echo "<p>Total försäljningssumma: $totalSales kr</p>";

        ?>

        <h4>Alla plagg som säljaren lämnat in:</h4>
        <?php if (count($items) > 0) : var_dump($items);

        $itemsFromItem = Item::getAllItems();
        ?>

        <ul>
            <?php foreach ($itemsFromItem as $item) : ?>
                <?php if ($item->getSellerIdFromItem() == $sellerId) : ?>
                <li>
                    <strong>ID:</strong> <?php echo $item->getItemId(); ?><br>
                    <strong>Beskrivning:</strong> <?php echo $item->getDescription(); ?><br>
                    <strong>Pris:</strong> <?php echo $item->getPrice(); ?><br>
                    <strong>Inkom:</strong> <?php echo $item->getdate(); ?><br>
                    <strong>Status:</strong> <?php echo $item->getSold() ? 'Såld' : 'Ej såld'; ?><br>
                    <strong>Försäljningsdatum:</strong> <?php echo $item->getDateSold(); ?><br>
                    <strong>FörsäljarId:</strong> <?php echo $item->getSellerIdFromItem(); ?><br>
                    <a href="editItem.php?id=<?php echo $item->getItemId(); ?>">Redigera</a>
                </li>
                <?php endif; ?>
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

<form action="../controllers/createItemController.php?id=<?php echo $sellerId; ?>" method="POST">
    <label for="description">Beskrivning:</label>
    <input type="text" name="description" id="description" required><br>

    <label for="price">Pris:</label>
    <input type="text" name="price" id="price" required><br>

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