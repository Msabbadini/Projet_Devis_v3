<?php
 require_once 'connexion.class.php';
 require_once 'pagination.class.php';
// require 'Helpers/helper.php';
 class Client extends DB{
     // *********** FUNCTION POUR LES VERIFS START ***********
     private function verifClientNom($nom){
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
    
    private function verifClientPrenom($prenom){
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
         echo json_encode($ret) ;// on converti le tableau au format JSON et on le renvoie
        
        // Ajout Client Start
        if($ret['status'] == 'ok'){

            if($verifClientNom==0 && $verifClientPrenom==0){
                $req = $this->getDatabase()->prepare('INSERT INTO '.$this->table_client.' (civilite_client,nom_client,prenom_client,adresse_postal,code_postal,ville_client,email_client,telephone_fixe_client,telephone_portable_client,infos_complementaire) VALUES (?,?,?,?,?,?,?,?,?,?)');
                $req-> execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);
        }
            else if($verifClientNom==0 && $verifClientPrenom==1){
                $req = $this->getDatabase()->prepare('INSERT INTO '.$this->table_client.' (civilite_client,nom_client,prenom_client,adresse_postal,code_postal,ville_client,email_client,telephone_fixe_client,telephone_portable_client,infos_complementaire) VALUES (?,?,?,?,?,?,?,?,?,?)');
                $req-> execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);
        
            }
            else if($verifClientNom!=0 && $verifClientPrenom==0){
                $req = $this->getDatabase()->prepare('INSERT INTO '.$this->table_client.' (civilite_client,nom_client,prenom_client,adresse_postal,code_postal,ville_client,email_client,telephone_fixe_client,telephone_portable_client,infos_complementaire) VALUES (?,?,?,?,?,?,?,?,?,?)');
                $req-> execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);
        };
        };
        
        // return json_encode ($ret);
    }
    //*************************  FUNCTION AJOUT CLIENT END   **************************

    //*************************  FUNCTION LISTE CLIENT START **************************
    function Liste(){
      
        $tab =array();
        // if(isset($_POST['page']) && is_numeric($_POST['page']));
        // // calcul de l'offset numéro de page -1
        // $offset = ($_POST['page']-1)*$limit;
        $result= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_client );
        $result->execute();
        $result =$result->fetchAll();
        // ob_start(); // démarrage le zone tampon
        // include 'src/liste.php';    // echo via include de mon tableau liste client php
        // $tab['html'] = ob_get_contents();  // j'insere le contenu dans une variable
        // ob_end_flush(); // et je libere la mémoire
        foreach($result as $r){
            // print_r($r);
            ?>
            <tr id='<?= $r['id_client'] ?>'>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
            <div class="flex items-center">
                <div>
                    <div class="text-sm leading-5 text-gray-800"><?= $r['id_client'] ?></div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
            <div  class="text-sm leading-5 text-blue-900"><?= $r['civilite_client'].' '.$r['nom_client'].' '.$r['prenom_client'] ?></div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $r['email_client']; ?></td>
        <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?php
        if(empty($r['telephone_fixe_client'])){
            echo $r['telephone_portable_client'];
        }elseif(empty($r['telephone_portable_client'])){
            echo $r['telephone_fixe_client'];
        }else{
            echo $r['telephone_fixe_client'].' / '.$r['telephone_portable_client'];
        }
        ?></td>
        <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5 cursor-pointer">
            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
            <span id='fiche_client' class="relative text-xs" data-client='<?= $r['id_client']?>'>Impression</span>
        </span>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?= $r['date_creation'] ;?></td>
        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
            <button data-id='<?= $r['id_client'] ;?>' class="info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-700 hover:text-white focus:outline-none">Fiche Client</button>
            <button class="update px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-green-500 hover:text-white focus:outline-none ease-liner " data-modal='modal_id' data-id='<?= $r['id_client']; ?>' type='button' >Modification</button>
            <button id='<?= $r['id_client'];?>' data-client='<?= $r['nom_client']." ".$r['prenom_client'] ?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-red-600 hover:text-white focus:outline-none">Suppression</button>
        </td>
        </tr>
            <?php
        } 
    
        // echo json_encode($result);
    }
    //*************************  FUNCTION LISTE CLIENT END      **************************

    //*************************  FUNCTION LISTE CLIENT UNITAIRE START      **************************
        function ListeClient(){
            $id=$_POST['clientId'];
            $tab_result=[];
            // Requete Client Info

            // Requete Devis liée au client
            $req=$this->getDatabase()->prepare('SELECT * FROM '.$this->table_devis.' INNER JOIN '.$this->table_client.' AS c ON client_num = id_client WHERE client_num = ? ORDER BY devis_num');
            $req->execute([$id]);
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $data = $req->fetchAll();
            ob_start();
            foreach($data as $r){
                ?>
                <tr id='<?= $r['id_client'] ?>'>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                    <div class="flex items-center">
                        <div>
                            <div class="text-sm leading-5 text-gray-800"><?= $r['devis_num'] ?></div>
                        </div>
                    </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $r['type_devis'] ?></td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?php 
                    if($r['type_devis']=='Devis'){
                    if($r['statut_devis']=='En attente'){
                    ?>
                    <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                    <span aria-hidden class="absolute inset-0 bg-yellow-500 opacity-50 rounded-full"></span>
                    <span id='fiche_client' class="relative text-xs"><?= $r['statut_devis'] ?></span>
                    <?php
                    }elseif($r['statut_devis']=='Valider'){
                        ?>
                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                    <span aria-hidden class="absolute inset-0 bg-green-500 opacity-50 rounded-full"></span>
                    <span id='fiche_client' class="relative text-xs"><?= $r['statut_devis'] ?></span>

                        <?php
                    }elseif($r['statut_devis']=='Refus'){
                        ?>
                    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                    <span aria-hidden class="absolute inset-0 bg-red-500 opacity-50 rounded-full"></span>
                    <span id='fiche_client' class="relative text-xs"><?= $r['statut_devis'] ?></span>

                        <?php
                    }?></td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                    <?= $r['devis_montant'] ?>€
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                    <?= $r['date_devis_modification']==''? 'Aucune Modification':$r['date_devis_modification'] ?>
                    </td>

                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?= $r['date_creation'] ?></td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                    <button data-id='<?= $r['id_client'] ?>' class="info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-500 hover:text-white focus:outline-none">Details </button>
                    <button data-id='<?= $r['id_client'] ?>' data-id_devis='<?= $r['devis_num']?>' class="print px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-yellow-500 hover:text-white focus:outline-none" Type='button'>Impression </button>
                    <button class="update px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-green-500 hover:text-white focus:outline-none ease-liner " data-role='update' data-id='<?= $r['devis_num'] ?>' type='button' >Modification </button>
                    <button id='<?= $r['id_client']?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-red-600 hover:text-white focus:outline-none">Suppression </button>
                    </td>
                    </tr>
                <?php
                    };
                    $tab_result['devis']= ob_get_contents();
                    ob_end_flush();
                // return $tab_result;
                }
            }
    //*************************  FUNCTION LISTE CLIENT UNITAIRE END        **************************

    //*************************  FUNCTION MODIFIER CLIENT START **************************

    //*************************  FUNCTION MODIFIER CLIENT END   **************************
    
    //*************************  FUNCTION DELETE CLIENT START   **************************
        function Delete(){         
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
        }
    //*************************  FUNCTION DELETE CLIENT END     **************************

};
// ************************************************************ FUNCTION CRUD END ***********************************************************

?>