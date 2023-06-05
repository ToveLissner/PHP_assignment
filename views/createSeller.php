<?php
include '../partials/header.php';
?>

<h2>Lägg till ny säljare</h2>

<form class="container" action="../controllers/createSellerController.php" method="POST" >
    <label for="firstname">Förnamn:</label>
    <input type="text" name="firstname" id="firstname" required><br>

    <label for="lastname">Efternamn:</label>
    <input type="text" name="lastname" id="lastname" required><br>

    <label for="phone">Telefon:</label>
    <input type="text" name="phone" id="phone" required><br>

    <button type="submit">Lägg till</button>
</form>

<?php include '../partials/footer.php'; ?>









