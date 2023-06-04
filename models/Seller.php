<?php

require_once 'Item.php';

class Seller {
    private $id;
    private $firstname;     
    private $lastname;
    private $phone;
 
    public function __construct(?int $id, string $firstname, string $lastname, string $phone){  
        $this->id=$id; 
        $this->firstname=$firstname;
        $this->lastname=$lastname;
        $this->phone=$phone;
    }

    public function getSellerId(): int {
        return $this->id;
    }
 
    public function getFirstname():string{
        return $this->firstname; 
    }

    public function getLastname():string{
        return $this->lastname; 
    }

    public function getPhoneNumber():string{
        return $this->phone; 
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setFirstname($firstname){
        $this->firstname = $firstname; 
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;  
    }

    public function setPhone($phone){
        $this->phone = $phone;  
    }
    
        // Metoder för att hantera CRUD 

        public function saveSeller() {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "INSERT INTO sellers (firstname, lastname, phone) VALUES (?, ?, ?)";
                $statement = $pdo->prepare($sql);
                $statement->execute([$this->firstname, $this->lastname, $this->phone]);
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid sparande av säljare: " . $e->getMessage();
            }
        }
    
        public function updateSeller() {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "UPDATE sellers SET firstname = ?, lastname = ?, phone = ? WHERE id = ?";
                $statement = $pdo->prepare($sql);
                $statement->execute([$this->firstname, $this->lastname, $this->phone, $this->id]);
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid uppdatering av säljare: " . $e->getMessage();
            }
        }
    
        public function deleteSeller() {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "DELETE FROM sellers WHERE id = ?";
                $statement = $pdo->prepare($sql);
                $statement->execute([$this->id]);
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid borttagning av säljare: " . $e->getMessage();
            }
        }
    
        public static function getSellerById($id) {
            require '../database/connection.php'; // Anslut till databasen
    
            try {
                $sql = "SELECT * FROM sellers WHERE id = ?";
                $statement = $pdo->prepare($sql);
                $statement->execute([$id]);
                $sellerData = $statement->fetch(PDO::FETCH_ASSOC);
    
                if ($sellerData) {
                    // Skapa en instans av Seller-klassen med hämtade data
                    $seller = new Seller($sellerData['id'], $sellerData['firstname'], $sellerData['lastname'], $sellerData['phone']);

                    // $seller = new Seller($sellerData['firstname'], $sellerData['lastname'], $sellerData['phone'], $sellerData['id']);
                    return $seller;
                }
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid hämtning av säljare: " . $e->getMessage();
            }
    
            return null; // Returnera null om säljare inte hittades
        }
    
        public static function getAllSellers() {
            require '../database/connection.php'; // Anslut till databasen
        
            try {
                $sql = "SELECT * FROM sellers";
                $statement = $pdo->prepare($sql);
                $statement->execute();
        
                $sellersData = $statement->fetchAll(PDO::FETCH_ASSOC);
                $sellers = [];
        
                foreach ($sellersData as $sellerData) {
                    // Skapa en instans av Seller-klassen med hämtade data och lägg till i listan
                    $seller = new Seller($sellerData['id'], $sellerData['firstname'], $sellerData['lastname'], $sellerData['phone']);
                    $seller->setId($sellerData['id']);
                    $sellers[] = $seller;
                }
        
                return $sellers;
            } catch (PDOException $e) {
                // Hantera fel
                echo "Fel vid hämtning av säljare: " . $e->getMessage();
            }
        
            return null; // Returnera null om säljare inte hittades
        }

        // funktion för att sortera på förnamn // 

        public static function getAllSellersAlphabetical() {
            require '../database/connection.php';
        
            try {
                $sql = "SELECT * FROM sellers ORDER BY firstname ASC";
                $statement = $pdo->prepare($sql);
                $statement->execute();
        
                $sellersData = $statement->fetchAll(PDO::FETCH_ASSOC);
                $sellers = [];
        
                foreach ($sellersData as $sellerData) {
                    $seller = new Seller($sellerData['id'], $sellerData['firstname'], $sellerData['lastname'], $sellerData['phone']);
                    $seller->setId($sellerData['id']);
                    $sellers[] = $seller;
                }
        
                return $sellers;
            } catch (PDOException $e) {
                echo "Fel vid hämtning av säljare: " . $e->getMessage();
            }
        
            return null;
        }

    public function getItems() {
        require '../database/connection.php'; // Anslut till databasen

        try {
            $sql = "SELECT * FROM items
            INNER JOIN sellers ON items.seller_id = sellers.id
            WHERE sellers.id = ?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$this->id]);
            $itemsData = $statement->fetchAll(PDO::FETCH_ASSOC);

            $items = [];

            foreach ($itemsData as $itemData) {
                // Skapa en instans av Item-klassen med hämtade data och lägg till i listan
                $item = new Item(
                    $itemData['id'],
                    $itemData['description'],
                    $itemData['price'],
                    $itemData['date'],
                    $itemData['sold'],
                    $itemData['date_sold'],
                    $itemData['seller_id']
                );
                $items[] = $item;
            }

            return $items;
        } catch (PDOException $e) {
            // Hantera fel
            echo "Fel vid hämtning av plagg: " . $e->getMessage();
        }

        return null; // Returnera null om plagg inte hittades
    }
    

}


