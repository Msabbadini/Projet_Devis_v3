<?php

function verifClientNom($nom){
    include('./src/connexion.php');

    $req=$db->prepare('SELECT count(*) as numberNomClient FROm clients WHERE nom_client=?');
    $req->execute(array($nom));
    $nbNom=0;
    while($nom_verif=$req->fetch()){
        $nbNom=$nom_verif['numberNomClient'];
    }
    return $nom=$nbNom;
}

function verifClientPrenom($prenom){
    include('./src/connexion.php');


    $req2=$db->prepare('SELECT count(*) as numberPrenomClient FROM clients WHERE prenom_client=?');
    $req2->execute(array($prenom));
    $nbPrenom=0;
    while($prenom_verif=$req2->fetch()){
        $nbPrenom=$prenom_verif['numberPrenomClient'];
    }

    return $prenom=$nbPrenom;
}

function requestDb($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info){
	include('./src/connexion.php');

	$req=$db->prepare('INSERT INTO clients(civilite_client,nom_client,prenom_client,adresse_postal,code_postal,ville_client,email_client,telephone_fixe_client,telephone_portable_client,infos_complementaire) VALUES (?,?,?,?,?,?,?,?,?,?)');
	$req->execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);
}


?>