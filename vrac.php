<?php
require_once './modeles/client.class.php';
    if(isset($_POST['action']) && !empty($_POST['action']) && isset($_POST['categorie']) && !empty($_POST['categorie'])){
        // Pas d'accolade car j'ai un seul élément  pour la condition 
        if($_POST['categorie'] == 'clients') $obj = new Client();
        elseif($_POST['categorie'] == 'devis') $obj = new Devis();
        elseif($_POST['categorie'] == 'Reference') $obj = new Reference();
        elseif($_POST['categorie'] == 'Fournisseur') $obj = new Fournisseur();
        elseif($_POST['categorie'] == 'Velux') $obj = new Velux();

        if($_POST['action'] == 'ajout') $ret = $obj->Ajouter();
        elseif($_POST['action'] == 'modifier') $ret = $obj->Modifier();
        elseif($_POST['action'] == 'Supprimer') $ret = $obj->Supprimer();
        elseif($_POST['action'] == 'liste') $ret =  $obj->Liste();
        elseif($_POST['action'] == 'listeClient') $ret =$obj->ListeClient();
        elseif($_POST['action'] == 'chercher') $ret = $obj->Chercher();

    }
    // Utilisable si je met du JSON 
   echo $ret ; 
   die;


?>