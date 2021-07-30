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
        <div class='mt-2 ml-2 border border-indigo-500 result_client'  data-client='<?=$r['id_client']?>' >
           <p class='text-center font-bold text-indigo-400 text-xl ' ><?= $r['nom_client']." ".$r['prenom_client']."--".$r['ville_client']?></p> 
        </div>
    <?php
    }
    
}


?>

