<!-- Fichier pour update les informations -->
<?php
require('./src/function.php');
// Ajout Client Start
$id=htmlspecialchars($_POST['id']);
$nom=htmlspecialchars($_POST['nom']);
$prenom=htmlspecialchars($_POST['prenom']);
$genre=htmlspecialchars($_POST['genre']);
$mail=htmlspecialchars($_POST['email']);
$info=htmlspecialchars($_POST['info_complementaire']);
$telPortalble=htmlspecialchars($_POST['telephone_portable']);
$telFixe=htmlspecialchars($_POST['telephone_fixe']);
$adresse=htmlspecialchars($_POST['adresse_postal']);
$code_postal=htmlspecialchars($_POST['code_postal']);
$ville=htmlspecialchars($_POST['ville']);
$verifClientNom=verifClientNom($nom);
$verifClientPrenom=verifClientPrenom($prenom);

$ret = array(); // on définit un tableau qui contiendra toutes nos valeurs retour
$ret['status'] = 'ok'; // on définit une valeur de retour qui nous permettra de savoir si tout s'est bien passé

if(!isset($genre) || empty($genre)){
    $ret['error']['genre'] = "Veuillez indiquer une civilité"; // on enregistre notre message d'erreur
    $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur

}
if(!isset($prenom) || empty($prenom)){
$ret['error']['prenom'] = "Votre prénom est obligatoire"; // on enregistre notre message d'erreur
$ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
}
if(!isset($nom) || empty($nom)){
$ret['error']['nom'] = "Le nom du client est obligatoire"; // on enregistre notre message d'erreur
$ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
}


if(!isset($mail) || empty($mail)){
$ret['error']['email'] = 'Votre adresse mail n\' est pas valide ';
$ret['status'] = 'error';
}
if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
$ret['error']['email'] = 'Votre adresse mail n\' est pas valide ';
$ret['status'] = 'error';	
}

if(!isset($adresse) || empty($adresse)){
$ret['error']['adresse'] = 'Veuillez indiquer une adresse ';
$ret['status'] = 'error';
}
if(!isset($code_postal) || empty($code_postal)){
$ret['error']['code_postal'] = 'Veuillez indiquer un code postal ';
$ret['status'] = 'error';
}
if(!isset($ville) || empty($ville)){
$ret['error']['ville'] = 'Veuillez indiquer une ville ';
$ret['status'] = 'error';
}

if(!empty($telFixe)){
    if(!is_numeric($telFixe)){
$ret['error']['tel'] = 'Votre numéro de téléphone fixe n\'est pas valide';
$ret['status'] = 'error';
}
}

if(!empty($telPortalble)){
   if(!is_numeric($telPortalble)){
$ret['error']['telephone_portable'] = 'Votre numéro de téléphone portable n\'est pas valide';
$ret['status'] = 'error';
} 
}

if($verifClientNom !=0 && $verifClientPrenom !=0){
    $ret['error']['nom'] = "Le Client existe déjà"; // on enregistre notre message d'erreur

    $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
}

if($ret['status'] == 'ok'){
$ret['msg'] = "<span style='color:green'>Votre Modification client est bien prise en compte</span>";
} else {
$ret['msg'] = "<span style='color:red'>Corriger les erreurs pour pouvoir continuer</span>";
}
echo json_encode($ret);// on converti le tableau au format JSON et on le renvoie

// Ajout Client Start
if($ret['status'] == 'ok'){

    if($verifClientNom==0 && $verifClientPrenom==0){
        updateClient($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id);
    }
    else if($verifClientNom==0 && $verifClientPrenom==1){
        updateClient($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id);
    
    }
    else if($verifClientNom!=0 && $verifClientPrenom==0){
        updateClient($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id);
    };
}


// Ajout Client End

die; // par sécurité afin d'éviter l'éxécution d'autres scripts à la suite qui pourrait ajouter des caractères, espaces, etc... ce qui compromettrait les données au format JSON
?>