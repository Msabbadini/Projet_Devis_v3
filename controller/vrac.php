<?php
session_start();
header('Content-Type: application/json');
require_once '../modeles/login.class.php';
require_once '../modeles/client.class.php';
require_once '../modeles/devis.class.php';
require_once '../modeles/reference.class.php';
require_once '../modeles/jwt.class.php';
$obj2 =new JWT();
$obj3 = new Login();

if(isset($_SESSION['connect']) && $obj3->VerifTokenValidity() == 'true'){

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
        elseif($_POST['action'] == 'liste') $ret =  $obj->Liste(true);
        elseif($_POST['action'] == 'liste') $ret =  $obj->ListeInfo(true);
        elseif($_POST['action'] == 'chercher') $ret = $obj->Chercher();
        elseif($_POST['action'] == 'details') $ret = $obj->Details();
           
        if(isset($_POST['pagination']) && $_POST['pagination'] == 'on' && is_array($ret)){
            $nombre=$obj->Nombre();
            if(isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page']>1) $page=$_POST['page']; else $page=1;
            $ret['pagination']=Pagination($nombre,$_POST['categorie'],$page);
        }
    }
    if($ret !=''){
        $verif=$obj3->verifSession();
        if($verif){
                $payload =['login'=>$_SESSION["pseudo"],'key'=>$_SESSION["key"]];
                $token = $obj2->generate($payload);
                $_SESSION['Owl'] = $token;
                setcookie('bear',$token);
                if(is_array($ret)){
                    // var_dump($ret);
                    if(isset($ret[0])){
                        $ret=$ret[0];
                    }
                    echo json_encode([$ret,'token'=>$token]); 
                }
            }
    }else echo $ret;
   die;
}  
?>