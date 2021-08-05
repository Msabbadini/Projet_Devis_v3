<?php
session_start();
require('../src/connexion.php');


if(isset($_GET['client'])){
    $client = htmlspecialchars( trim($_GET['client']));
    // $req =$db -> select('SELECT * from clients where nom_client LIKE ? LIMIT 10', array("$client%"));
    $req = $db ->prepare('SELECT * FROM clients WHERE nom_client LIKE ? LIMIT 10');
    $req -> execute(array("$client%"));
    $req = $req->fetchAll();
    foreach($req as $r){
        ?>

    <?php
    }
    
}


?>

