<?php
 require_once 'modeles/connexion.class.php';

class Helper extends DB{
    
function __construct(){

}

public function verifClientNom($nom){

    if($nom != " "){
        // $req =$db->select('SELECT count(*) as numberNomClient FROm clients WHERE nom_client=?',$nom);
        $req=$this->getDatabase()->prepare('SELECT count(*) as numberNomClient FROM clients WHERE nom_client=?');
        $req->execute(array($nom));
        $nbNom=0;
        while($nom_verif=$req->fetch()){
            $nbNom=$nom_verif['numberNomClient'];
        }
        return $nom=$nbNom;

    }
}

public function verifClientPrenom($prenom){


    // $req2=$db->select('SELECT count(*) as numberNomClient FROm clients WHERE prenom_client=?',$prenom);
    if($prenom != ''){
        $req2=$this->getDatabase()->prepare('SELECT count(*) as numberPrenomClient FROM clients WHERE prenom_client=?');
        $req2->execute(array($prenom));
        $nbPrenom=0;
        while($prenom_verif=$req2->fetch()){
            $nbPrenom=$prenom_verif['numberPrenomClient'];
        }

        return $prenom=$nbPrenom;
    }

}
}





?>