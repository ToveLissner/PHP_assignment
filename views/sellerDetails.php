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

        <h4>Plagg kopplade till säljaren:</h4>
        <?php if (count($items) > 0) : 
            echo "<ul>";
                foreach ($items as $item) {
                    echo "<li>{$item->getDescription()} ({$item->getPrice()}kr)</li>";
                }
                echo"</ul>";
            else :
            echo "<p>Inga plagg tillgängliga.</p>";
        endif; ?>

    <?php } else {
        echo "<p>Säljaren hittades inte.</p>";
    }
} else {
    echo "<p>Ogiltigt säljar-ID.</p>";
} 

if (isset($_GET['id'])) {
    $sellerId = $_GET['id'];
    $seller = Seller::getSellerById($sellerId);
}

?>

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

        <button type="submit">Spara ändringar och lämna sidan</button>
    </form>
<?php else: ?>
    <p>Kunde inte hitta säljaren.</p>
<?php endif; ?>

<?php include '../partials/footer.php'; ?>
