<?php
 require_once 'connexion.class.php';
// require 'Helpers/helper.php';
 class Client extends DB{
    function __construct(){
        parent::__construct();
    }
     // *********** FUNCTION POUR LES VERIFS START ***********
     private function verifClientNom($nom){
        if(!empty($nom) && $nom != " "){
            $req=$this->getDatabase()->prepare('SELECT count(*) as numberNomClient FROM clients WHERE nom_client=?');
            $req->execute(array($nom));
            $nom_verif=$req->fetch();
            if($nom_verif && isset($nom_verif['numberNomClient'])) return $nom_verif['numberNomClient']; 
        }
    }
    
    private function verifClientPrenom($prenom){
        // $req2=$db->select('SELECT count(*) as numberNomClient FROm clients WHERE prenom_client=?',$prenom);
        if(!empty($prenom) && $prenom != ''){
            $req2=$this->getDatabase()->prepare('SELECT count(*) as numberPrenomClient FROM clients WHERE prenom_client=?');
            $req2->execute(array($prenom));
            $prenom_verif = $req2->fetch();
            if($prenom_verif && isset($prenom_verif['numberPrenomClient'])) return $prenom_verif['numberPrenomClient']; 

        }
    }
    
     // *********** FUNCTION POUR LES VERIFS END   ***********
// ***************************************** FUNCTION CRUD START   ***********************************************************************
     
     //*************************  FUNCTION AJOUT CLIENT START **************************
//  is_numeric pour vérifier qu'il a que des chiffres  ou l'inverse
    public function Ajouter(){
        // Zone tampon
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
        $verifClientNom=$this->verifClientNom($nom);
        $verifClientPrenom=$this->verifClientPrenom($prenom);
        $ret = array(); // on définit un tableau qui contiendra toutes nos valeurs retour
        $ret['status'] = 'ok'; // on définit une valeur de retour qui nous permettra de savoir si tout s'est bien passé
        
        if(!isset($genre) || empty($genre)){
            $ret['error']['genre'] = "Veuillez indiquer une civilité"; // on enregistre notre message d'erreur
            $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
        
        };
        if(!isset($prenom) || empty($prenom)){
            $ret['error']['prenom'] = "Votre prénom est obligatoire"; // on enregistre notre message d'erreur
            $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
        };

        if(!isset($nom) || empty($nom)){
            $ret['error']['nom'] = "Le nom du client est obligatoire"; // on enregistre notre message d'erreur
            $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
        };
        
        
        if(!isset($mail) || empty($mail)){
            $ret['error']['email'] = 'Votre adresse mail n\' est pas valide ';
            $ret['status'] = 'error';
        };
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
            $ret['error']['email'] = 'Votre adresse mail n\' est pas valide ';
            $ret['status'] = 'error';	
        };
        
        if(!isset($adresse) || empty($adresse)){
            $ret['error']['adresse'] = 'Veuillez indiquer une adresse ';
            $ret['status'] = 'error';
        };
        if(!isset($code_postal) || empty($code_postal)){
            $ret['error']['code_postal'] = 'Veuillez indiquer un code postal ';
            $ret['status'] = 'error';
        };
        if(!isset($ville) || empty($ville)){
            $ret['error']['ville'] = 'Veuillez indiquer une ville ';
            $ret['status'] = 'error';
        };
        
        if(!empty($telFixe)){
            if(!is_numeric($telFixe)){
            $ret['error']['tel'] = 'Votre numéro de téléphone fixe n\'est pas valide';
            $ret['status'] = 'error';
            };
        };
        
        if(!empty($telPortalble)){
           if(!is_numeric($telPortalble)){
            $ret['error']['telephone_portable'] = 'Votre numéro de téléphone portable n\'est pas valide';
            $ret['status'] = 'error';
            };
        };
        
        if($verifClientNom !=0 && $verifClientPrenom !=0){
            $ret['error']['nom'] = "Le Client existe déjà"; // on enregistre notre message d'erreur     
            $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
        };
        
        if($ret['status'] == 'ok'){
        $ret['msg'] = "<span style='color:green'>Votre ajout client est bien pris en compte</span>";
        } else {
        $ret['msg'] = "<span style='color:red'>Corriger les erreurs pour pouvoir continuer</span>";
        };
        
        // Ajout Client Start
        if($ret['status'] == 'ok'){
            
            if($verifClientNom==0 && $verifClientPrenom==0 || $verifClientNom==0 && $verifClientPrenom==1 || $verifClientNom!=0 && $verifClientPrenom==0 ){
                $req = $this->getDatabase()->prepare('INSERT INTO '.$this->table_client.' (civilite_client,nom_client,prenom_client,adresse_postal,code_postal,ville_client,email_client,telephone_fixe_client,telephone_portable_client,infos_complementaire) VALUES (?,?,?,?,?,?,?,?,?,?)');
                $req-> execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);
            }
        };
        
        return $ret ;// on converti le tableau au format JSON et on le renvoie
        // return json_encode ($ret);
    }
    //*************************  FUNCTION AJOUT CLIENT END   **************************

    //*************************  FUNCTION LISTE CLIENT START **************************
    function Liste($html=false){
        $endSql='';
        
        if(isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page'] > 1){
            
            // calcul de l'offset numéro de page -1
            $offset = ($_POST['page']-1)*LIMIT;
            $endSql='OFFSET '.$offset;
        }
        $result= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_client.' LIMIT '.LIMIT.' '.$endSql );
        $result->execute();
        $data =$result->fetchAll();
        if($data && is_array($data)){
            $tab=[];
            if($html){
                ob_start();
                include_once '../views/view_liste_client.php';
                $tab['html']=ob_get_contents();
                ob_end_clean();
                return $tab;
            }
            return $data;
        }
        return false;
    }
    function Nombre(){
        $result= $this->getDatabase()->prepare('SELECT count(*) FROM '.$this->table_client);
        $result->execute();
        $data =$result->fetch();
        if($data && isset($data[0]) && is_numeric($data[0])){
            return $data[0];
        }
        return 0;
    }
    //*************************  FUNCTION LISTE CLIENT END      **************************

    //*************************  FUNCTION MODIFIER CLIENT START **************************

    //*************************  FUNCTION MODIFIER CLIENT END   **************************
    
    //*************************  FUNCTION DELETE CLIENT START   **************************
        function Supprimer(){         
            if(isset($_POST['client'])){
                $clientId = $_POST['client'];
                $req = $this->getDatabase()->prepare('DELETE FROM '.$this->table_client.' WHERE id_client= ?');
                $req->execute([$clientId]);
        
                if($req){
                    return 'success';
                }else{
                    return 'error';
                }
            }
        }
    //*************************  FUNCTION DELETE CLIENT END     **************************
    //*************************  FUNCTION CHERCHER CLIENT START     **************************
    function Chercher(){
        if(isset($_POST['client'])){
        $client = trim($_POST['client']);
        // $req =$db -> select('SELECT * from clients where nom_client LIKE ? LIMIT 10', array("$client%"));
        $req = $this->getDatabase()->prepare('SELECT * FROM '.$this->table_client.' WHERE nom_client LIKE ? LIMIT 10');
        $req -> execute(array($client."%"));
        $data = $req->fetchAll();
        return  $data;
        }
        elseif(isset($_POST['info_client'])){
            $id=$_POST['info_client'];
            $req2 = $this->getDatabase()-> prepare('SELECT * FROM clients WHERE id_client= ?');
            // $req2->setFetchMode(PDO::FETCH_ASSOC);
            $req2 -> execute([$id]);
            $data= $req2-> fetchAll();
            return $data;
        }
        return false;
    }
    //*************************  FUNCTION CHERCHER CLIENT END       **************************
    //*************************  FUNCTION MODIFIER CLIENT START       **************************
    function Modifier(){

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
            $id=htmlspecialchars($_POST['id_client']);
            $ret = array(); // on définit un tableau qui contiendra toutes nos valeurs retour
            $ret['status'] = 'ok'; // on définit une valeur de retour qui nous permettra de savoir si tout s'est bien passé

            if(!isset($genre) || empty($genre)){
                $ret['error']['genre'] = "Veuillez indiquer une civilité"; // on enregistre notre message d'erreur
                $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
            
            };
            if(!isset($prenom) || empty($prenom)){
                $ret['error']['prenom'] = "Votre prénom est obligatoire"; // on enregistre notre message d'erreur
                $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
            };
    
            if(!isset($nom) || empty($nom)){
                $ret['error']['nom'] = "Le nom du client est obligatoire"; // on enregistre notre message d'erreur
                $ret['status'] = 'error'; // on met la valeur de retour à 'error' comme ça on sait qu'il y a une erreur
            };
            
            
            if(!isset($mail) || empty($mail)){
                $ret['error']['email'] = 'Votre adresse mail n\' est pas valide ';
                $ret['status'] = 'error';
            };
            if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $ret['error']['email'] = 'Votre adresse mail n\' est pas valide ';
                $ret['status'] = 'error';	
            };
            
            if(!isset($adresse) || empty($adresse)){
                $ret['error']['adresse'] = 'Veuillez indiquer une adresse ';
                $ret['status'] = 'error';
            };
            if(!isset($code_postal) || empty($code_postal)){
                $ret['error']['code_postal'] = 'Veuillez indiquer un code postal ';
                $ret['status'] = 'error';
            };
            if(!isset($ville) || empty($ville)){
                $ret['error']['ville'] = 'Veuillez indiquer une ville ';
                $ret['status'] = 'error';
            };
            
            if(!empty($telFixe)){
                if(!is_numeric($telFixe)){
                $ret['error']['tel'] = 'Votre numéro de téléphone fixe n\'est pas valide';
                $ret['status'] = 'error';
                };
            };
            
            if(!empty($telPortalble)){
               if(!is_numeric($telPortalble)){
                $ret['error']['telephone_portable'] = 'Votre numéro de téléphone portable n\'est pas valide';
                $ret['status'] = 'error';
                };
            };
                        
            if($ret['status'] == 'ok'){
            $ret['msg'] = "<span style='color:green'>Votre ajout client est bien pris en compte</span>";
            } else {
            $ret['msg'] = "<span style='color:red'>Corriger les erreurs pour pouvoir continuer</span>";
            };
            
            if($ret['status'] == 'ok'){
                $req = $this->getDatabase()->prepare('UPDATE '.$this->table_client.' SET civilite_client=?,nom_client=?,prenom_client=?,adresse_postal=?,code_postal=?,ville_client=?,email_client=?,telephone_fixe_client=?,telephone_portable_client=?,infos_complementaire=? WHERE id_client=? ');
                $req-> execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id]);
                
            }
            return $ret ;

    }
    //*************************  FUNCTION MODIFIER CLIENT END         **************************

};
// ************************************************************ FUNCTION CRUD END ***********************************************************
$Clients = new Client();
?>