<?php

require '../database/connection.php';
require_once '../models/Seller.php';

class BaseEditSellerView {
    protected $seller;

    public function __construct($sellerId) {
        $this->seller = Seller::getSellerById($sellerId);
    }

    public function render() {
        if ($this->seller) {
            ?>
            <form class="container" action="../controllers/updateSellerController.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $this->seller->getSellerId(); ?>">
                <label for="firstname">Förnamn:</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $this->seller->getFirstname(); ?>" required><br>

                <label for="lastname">Efternamn:</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $this->seller->getLastname(); ?>" required><br>

                <label for="phone">Telefon:</label>
                <input type="text" name="phone" id="phone" value="<?php echo $this->seller->getPhoneNumber(); ?>" required><br>

                <button type="submit">Spara ändringar</button>
            </form>
            <?php
        } else {
            echo "<p>Kunde inte hitta säljaren.</p>";
        }
    }
}

