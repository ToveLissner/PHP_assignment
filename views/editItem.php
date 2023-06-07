<?php
require '../database/connection.php';
include '../partials/header.php';
include '../models/Item.php';

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $item = Item::getItemById($itemId);
}

?>

<h2>Redigera objekt: <?php echo $item->getItemId();?></h2>

<?php if ($item) {?>
    <form class="container" action="../controllers/updateItemController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $item->getItemId(); ?>">
        <label for="description">Beskrivning:</label>
        <input type="text" name="description" id="description" value="<?php echo $item->getDescription(); ?>" required><br>

        <label for="price">Pris:</label>
        <input type="text" name="price" id="price" value="<?php echo $item->getPrice(); ?>" required><br>

        <label for="date">Inkom:</label>
        <input type="text" name="date" id="date" value="<?php echo date('Y-m-d', strtotime($item->getdate())); ?>" ><br>  

        <label for="sold">Såld:</label>
        <input type="checkbox" name="sold" id="sold" <?php if ($item->getSold()) echo "checked"; ?>>

        <label for="seller_id">FörsäljarId:</label>
        <input type="text" name="seller_id" id="seller_id" value="<?php echo $item->getSellerIdFromItem(); ?>" required><br>

        <button type="submit">Spara ändringar</button>
    </form>
<?php } else {?>
    <p>Kunde inte hitta objektet.</p>
<?php } ?>

<?php include '../partials/footer.php'; ?>