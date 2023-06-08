<?php
require '../database/connection.php';
require 'BaseEditSellerView.php';

if (isset($_GET['id'])) {
    $sellerId = $_GET['id'];
    $seller = Seller::getSellerById($sellerId);
}
?>

<?php class EditSellerView extends BaseEditSellerView {
    public function render() {
        include '../partials/header.php';
        echo "<h2>Redigera säljare</h2>";
        parent::render();
        include '../partials/footer.php';
    }
}

$view = new EditSellerView($_GET['id']);
$view->render();

?>
