<form action="controllers/form-handler.php" method="POST">
    Firstname: <input type=text name="firstname" id="firstname"> <br>
    Lastname: <input type=text name="lastname" id="lastname"> <br>
    Phone: <input type=text name="phone" id="phone"> <br>
    <button>Submit</button>
    </form>

    <?php
    require 'database/connection.php';
    
    $sql="SELECT * FROM sellers";
    $statement=$pdo->prepare($sql);
    $statement->execute([]);   

    $sellers = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo "<ul>";

    foreach ($sellers as $seller){
    echo 
    "<li>
    Firstname: {$seller['firstname']}
    Lastname: {$seller['lastname']}
    Number: {$seller['phone']}
    </li>";
    }

    echo "</ul>";

    ?>





    
    
    
    