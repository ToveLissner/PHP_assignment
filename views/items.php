<?php
require '../database/connection.php';
include '../partials/header.php';
include '../models/Item.php';
?>

<h2>Objekt</h2>

<?php
$items = Item::getAllItems();
?>

<ul class="ulContainer">
    <?php foreach ($items as $item): ?>
        <li class="liContainer">
            <strong>ProduktId:</strong> <?php echo $item->getItemId(); ?><br>
            <strong>Beskrivning:</strong> <?php echo $item->getDescription(); ?><br>
            <strong>Pris:</strong> <?php echo $item->getPrice(); ?> kr<br>
            <strong>Inkom:</strong> <?php echo $item->getdate(); ?><br>
            <strong>Status:</strong> <?php echo $item->getSold(); ?><br>
            <strong>Försäljningsdatum:</strong> <?php echo $item->getDateSold(); ?><br>
            <strong>FörsäljarId:</strong> <?php echo $item->getSellerIdFromItem(); ?><br>
            <button class="smallButton"> <a href="editItem.php?id=<?php echo $item->getItemId(); ?>">Redigera</a> </button>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../partials/footer.php'; ?>





