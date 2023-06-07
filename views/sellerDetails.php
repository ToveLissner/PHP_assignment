<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../controllers/sellerDetailsController.php';
include '../partials/header.php';
?>

<h2>Detaljerad information: <?php echo $seller->getFirstname() . ' ' . $seller->getLastname() . " (" . $seller->getSellerId() . ")" ;   ?></h2>


<h3>Om säljaren</h3>

<div class="smallContainer">
<?php if (isset($seller)) : ?>
    <p>Säljare: <?php echo $seller->getFirstname() . ' ' . $seller->getLastname(); ?></p>
    <p>Telefon: <?php echo $seller->getPhoneNumber(); ?></p>
</div>

    <h3>Sammanfattning av försäljning</h3>
    <div class="smallContainer">

    <?php if ($items) : ?>
        <p>Antal objekt till försäljning: <?php echo $numberOfSubmittedItems; ?> st</p>
        <p>Antal sålda objekt: <?php echo $numberOfSoldItems; ?> st</p>
        <p>Totalt antal inlämnade objekt: <?php echo $totalItems; ?> st</p>
        <p>Total försäljningssumma: <?php echo $totalSales; ?> kr</p>
    <?php else : ?>
        <p>Inga objekt tillgängliga.</p>
    <?php endif; ?>
</div>

    <h3>Lägg till nytt objekt</h3>

    <form class="container" action="../controllers/createItemController.php?id=<?php echo $sellerId; ?>" method="POST">
        <label for="description">Beskrivning:</label>
        <input type="text" name="description" id="description" required><br>

        <label for="price">Pris:</label>
        <input type="text" name="price" id="price" required><br>

        <input type="hidden" name="seller_id" value="<?php echo $sellerId; ?>">

        <button type="submit">Lägg till</button>
    </form>

    <h3>Redigera säljare</h3>

    <?php if ($seller): ?>
        <form class="container" action="../controllers/updateSellerController.php" method="POST">
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

    

    <h3>Alla objekt som <?php echo $seller->getFirstname() . ' ' . $seller->getLastname(); ?> lämnat in </h3>
    <ul class="container ulContainerSmall">
        <?php foreach ($itemsFromItem as $item) : ?>
            <?php if ($item->getSellerIdFromItem() === $seller->getSellerId()) : ?>
            <li class="liContainerSmall">
                <strong>ID:</strong> <?php echo $item->getItemId(); ?><br>
                <strong>Beskrivning:</strong> <?php echo $item->getDescription(); ?><br>
                <strong>Pris:</strong> <?php echo $item->getPrice(); ?> kr<br>
                <strong>Inkom:</strong> <?php echo date('Y-m-d', strtotime($item->getdate())); ?><br>
                <strong>Status:</strong> <?php echo $item->getSold() ? 'Såld' : 'Ej såld'; ?><br>
                <?php if ($item->getDateSold() !== null): ?>
            <strong>Försäljningsdatum:</strong> <?php echo $item->getDateSold(); ?><br>
            <?php endif; ?>
                <strong>FörsäljarId:</strong> <?php echo $item->getSellerIdFromItem(); ?><br>
                <button class="smallButtonPink"><a href="editItem.php?id=<?php echo $item->getItemId(); ?>">Redigera</a></button>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

<?php else : ?>
    <p>Säljaren kunde inte hittas.</p>
<?php endif; ?>

<?php include '../partials/footer.php'; ?>
