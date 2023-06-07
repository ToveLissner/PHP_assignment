<?php
require '../database/connection.php';
include '../partials/header.php';
include '../models/Item.php';
?>

<h2>Objekt</h2>

<?php
$items = Item::getAllItems();
?>

<ul class="ulContainerLarge">
    <?php foreach ($items as $item) { ?>
        <li class="liContainerLarge">
            <strong>ProduktId:</strong> <?php echo $item->getItemId(); ?><br>
            <strong>Beskrivning:</strong> <?php echo $item->getDescription(); ?><br>
            <strong>Pris:</strong> <?php echo $item->getPrice(); ?> kr<br>
            <strong>Inkom:</strong> <?php echo date('Y-m-d', strtotime($item->getdate())); ?><br>
            <strong>Status:</strong> <?php echo $item->getSold()? 'Såld' : 'Ej såld'; ?><br>
            <?php if ($item->getDateSold() !== null): ?>
            <strong>Försäljningsdatum:</strong> <?php echo $item->getDateSold(); ?><br>
            <?php endif; ?>
            <strong>FörsäljarId:</strong> <?php echo $item->getSellerIdFromItem(); ?><br>
            <button class="smallButton"> <a href="editItem.php?id=<?php echo $item->getItemId(); ?>">Redigera</a> </button>
        </li>
    <?php } ?>
</ul>

<?php include '../partials/footer.php'; ?>







