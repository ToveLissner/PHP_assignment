<?php
require '../database/connection.php';
include '../partials/header.php';
include '../models/Item.php';
?>

<h2>Objekt</h2>

<button><a href="createItem.php">Lägg till objekt</a></button>

<?php
$items = Item::getAllItems();
?>

<ul>
    <?php foreach ($items as $item): ?>
        <li>
            <strong>ID:</strong> <?php echo $item->getItemId(); ?><br>
            <strong>Beskrivning:</strong> <?php echo $item->getDescription(); ?><br>
            <strong>Pris:</strong> <?php echo $item->getPrice(); ?><br>
            <a href="editItem.php?id=<?php echo $item->getItemId(); ?>">Redigera</a>
            <a href="deleteItem.php?id=<?php echo $item->getItemId(); ?>">Ta bort</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../partials/footer.php'; ?>





