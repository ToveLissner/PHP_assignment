<?php
include '../partials/header.php';
?>

<h2>Lägg till nytt objekt</h2>

<form action="../controllers/createItemController.php" method="POST" >
    <label for="description">Beskrivning:</label>
    <input type="text" name="description" id="description" required><br>

    <label for="price">Pris:</label>
    <input type="text" name="price" id="price" required><br>

    <label for="seller_id">Säljare:</label>
    <input type="text" name="seller_id" id="seller_id" required><br>

    <button type="submit">Lägg till</button>
</form>

<?php include '../partials/footer.php'; ?>

