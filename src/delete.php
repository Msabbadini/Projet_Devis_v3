<?php
    include('./src/connexion.php');

    if(isset($_POST['clientId'])){
        $clientId = htmlspecialchars($_POST['clientId']);
        $req = $db->prepare('DELETE FROM clients WHERE id_client= ?');
        $req->execute($clientId);

        if($req){
            echo 'success';
        }else{
            echo 'error';
        }
    }
