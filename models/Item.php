<?php

class Item {
    private $id;
    private $description;     
    private $price;
    private $date;          
    private $sold;          // datatyp?
    private $date_sold;     // datatyp?
    private $seller_id;
 
    public function __construct(?int $id, string $description, float $price, $date, $sold, $date_sold, int $seller_id){   
        $this->id=$id;
        $this->description=$description;
        $this->price=$price;
        $this->date=$date;
        $this->sold=$sold;
        $this->date_sold=$date_sold;
        $this->seller_id=$seller_id;
    }

    public function getItemId():int {
        return $this->id;
    }
 
    public function getDescription():string{
        return $this->description; 
    }

    public function getPrice():float{
        return $this->price; 
    }

    public function getDate(){
        return $this->date; 
    }

    public function getSold(){
        return $this->sold; 
    }

    public function getDateSold(){
        return $this->date_sold; 
    }

    public function getSellerIdFromItem():int{
        return $this->seller_id; 
    }

    public function setItemid(int $id): void{
        $this->id=$id;
    }

    public function setDescription($description){
        $this->description = $description;  
    }

    public function setPrice($price){
        $this->price = $price;  
    }

    public function setDate($date){
        $this->date = $date;  
    }

    public function setSoldStatus($sold){
        $this->sold = $sold;  
    }

    public function setSoldDate($date_sold){
        $this->date_sold =  $date_sold;  
    }

    public function setSellerIdFromItem($seller_id){
        $this->seller_id =  $seller_id;  
    }
    
        // Metoder för att hantera CRUD

        public function saveItem() {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "INSERT INTO items (description, price, date, sold, date_sold, seller_id) VALUES (?, ?, ?, ?, ?, ?)";
                $statement = $pdo->prepare($sql);
                $statement->execute([$this->description, $this->price, $this->date, $this->sold, $this->date_sold, $this->seller_id]);
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid sparande av item: " . $e->getMessage();
            }
        }
    
        public function updateItem() {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "UPDATE items SET description = ?, price = ?, date = ?, sold = ?, date_sold = ?, seller_id = ? WHERE id = ?";
                $statement = $pdo->prepare($sql);
                $statement->execute([$this->description, $this->price, $this->date, $this->sold, $this->date_sold, $this->seller_id, $this->id]);
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid uppdatering av item: " . $e->getMessage();
            }
        }
    
        public function deleteItem() {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "DELETE FROM items WHERE id = ?";
                $statement = $pdo->prepare($sql);
                $statement->execute([$this->id]);
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid borttagning av item: " . $e->getMessage();
            }
        }
    
        public static function getItemById($id) {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "SELECT * FROM items WHERE id = ?";
                $statement = $pdo->prepare($sql);
                $statement->execute([$id]);
                $itemData = $statement->fetch(PDO::FETCH_ASSOC);
    
                if ($itemData) {
                    // Skapa en instans av Item-klassen med hämtade data
                    $item = new Item(
                        $itemData['id'],
                        $itemData['description'],
                        $itemData['price'],
                        $itemData['date'],
                        $itemData['sold'],
                        $itemData['date_sold'],
                        $itemData['seller_id']
                    );
                    return $item;
                }
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid hämtning av item: " . $e->getMessage();
            }
    
            return null; // Returnera null om item inte hittades
        }

        public static function getAllItems() {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "SELECT * FROM items";
                $statement = $pdo->prepare($sql);
                $statement->execute();

                $itemsData = $statement->fetchAll(PDO::FETCH_ASSOC);
                $items = [];

                foreach ($itemsData as $itemData) {
                    // Skapa en instans av Item-klassen för varje item
                    $item = new Item(
                        $itemData['id'],
                        $itemData['description'],
                        $itemData['price'],
                        $itemData['date'],
                        $itemData['sold'],
                        $itemData['date_sold'],
                        $itemData['seller_id']
                    );
                    $item->setItemId($itemData['id']);
                    $items[] = $item;
                }

                var_dump($items);
    
                return $items;
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid hämtning av items: " . $e->getMessage();
            }

            var_dump($items);
    
            return NULL; // Returnera en tom array om inga items hittades
        }
        
    }
    