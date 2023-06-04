<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../database/connection.php';
include '../partials/header.php';
include '../models/Item.php';

// Kontrollera om det finns en säljar-ID i URL:en
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $item = Item::getItemById($itemId);
}

var_dump($item)
?>

<h2>Redigera objekt</h2>

<?php if ($item): ?>
    <form action="../controllers/updateItemController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $item->getItemId(); ?>">
        <label for="description">Beskrivning:</label>
        <input type="text" name="description" id="description" value="<?php echo $item->getDescription(); ?>" required><br>

        <label for="price">Pris:</label>
        <input type="text" name="price" id="price" value="<?php echo $item->getPrice(); ?>" required><br>

        <label for="date">Inkom:</label>
        <input type="text" name="date" id="date" value="<?php echo $item->getDate(); ?>" required><br>

        <label for="sold">Såld:</label>
        <input type="text" name="sold" id="sold" value="<?php echo $item->getSold(); ?>" required><br>

        <label for="seller_id">FörsäljarId:</label>
        <input type="text" name="seller_id" id="seller_id" value="<?php echo $item->getSellerIdFromItem(); ?>" required><br>

        <button type="submit">Spara ändringar</button>
    </form>
<?php else: ?>
    <p>Kunde inte hitta objektet.</p>
<?php endif; ?>

<?php include '../partials/footer.php'; ?>
