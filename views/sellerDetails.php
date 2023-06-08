<?php 
include '../partials/header.php';
require 'baseEditSellerView.php'; 

class SellerDetailsView extends BaseEditSellerView { 
    public function render() { 
        require_once '../controllers/sellerDetailsController.php';
        ?>
    
        <h2>Detaljerad information: <?php echo $seller->getFirstname() . ' ' . $seller->getLastname() . " (" . $seller->getSellerId() . ")" ;   ?></h2>

        <h3>Om säljaren</h3>
        
        <div class="smallContainer">
        <?php if (isset($seller)) { ?>
            <p>Säljare: <?php echo $seller->getFirstname() . ' ' . $seller->getLastname(); ?></p>
            <p>Telefon: <?php echo $seller->getPhoneNumber(); ?></p>
        </div>
        
            <h3>Sammanfattning av försäljning</h3>
            <div class="smallContainer">
        
            <?php if ($items) { ?>
                <p>Antal objekt till försäljning: <?php echo $numberOfSubmittedItems; ?> st</p>
                <p>Antal sålda objekt: <?php echo $numberOfSoldItems; ?> st</p>
                <p>Totalt antal inlämnade objekt: <?php echo $totalItems; ?> st</p>
                <p>Total försäljningssumma: <?php echo $totalSales; ?> kr</p>
            <?php } else { ?>
                <p>Inga objekt tillgängliga.</p>
            <?php } ?>
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
        <?php parent::render(); ?>

        <h3>Alla objekt som <?php echo $seller->getFirstname() . ' ' . $seller->getLastname(); ?> lämnat in </h3>
    <ul class="container ulContainerSmall">
        <?php foreach ($itemsFromItem as $item) { ?>
            <?php if ($item->getSellerIdFromItem() === $seller->getSellerId()) { ?>
            <li class="liContainerSmall">
                <strong>ID:</strong> <?php echo $item->getItemId(); ?><br>
                <strong>Beskrivning:</strong> <?php echo $item->getDescription(); ?><br>
                <strong>Pris:</strong> <?php echo $item->getPrice(); ?> kr<br>
                <strong>Inkom:</strong> <?php echo date('Y-m-d', strtotime($item->getdate())); ?><br>
                <strong>Status:</strong> <?php echo $item->getSold() ? 'Såld' : 'Ej såld'; ?><br>
                <?php if ($item->getDateSold() !== null) { ?>
            <strong>Försäljningsdatum:</strong> <?php echo $item->getDateSold(); ?><br>
            <?php } ?>
                <button class="smallButtonPink"><a href="editItem.php?id=<?php echo $item->getItemId(); ?>">Redigera</a></button>
            </li>
            <?php } ?>
        <?php }  ?>
    </ul>

<?php } else { ?>
    <p>Säljaren kunde inte hittas.</p>
<?php } ?>

    <?php } 
} 

$view = new SellerDetailsView($_GET['id']);
$view->render();

include '../partials/footer.php';
?>









