<?php
 require_once 'connexion.class.php';

 class Devis extends DB{
     
    function __construct(){
        parent::__construct();
    } 
    private function element($devis_num){
        $req = $this->getDatabase()->prepare('SELECT * FROM '.$this->table_devis.' WHERE devis_num=?');
        $req->execute([$devis_num]);
        $data = $req->fetch();
        return $data;
    }

    public function Ajouter(){
        if(isset($_POST['montant']) && !empty($_POST['montant']) && isset($_POST['client']) && !empty($_POST['client']) && isset($_POST['details']) && !empty($_POST['details'])){
            $devis_date = date('d/m/Y');
            $req=$this->getDatabase()->prepare('INSERT INTO '.$this->table_devis.' (client_num,devis_date,devis_montant,type_devis,statut_devis) VALUES(?,?,?,?,?)'); 
            $statut = $req->execute([$_POST['client'],$devis_date,$_POST['montant'],'Devis','En attente']);

            if($statut){
                $num_devis = $this->getDatabase()->lastInsertId();
                $tab = $_POST['details'];
                for($i=0;$i<sizeof($_POST['details']);$i++){
                        if($tab[$i] != ''){
                            $id_article = $tab[$i]['id_article'];
                            $qte_article =  $tab[$i]['qte'];
                            
                        $req = $this->getDatabase()->prepare('INSERT INTO '.$this->table_details.' (detail_devis, details_ref, details_qte) VALUES (?,?,?)');
                        $req->execute([$num_devis,$id_article,$qte_article]);
                        }
                    }
                    if($req){
                        return 'Le devis n°'.$num_devis.' est bien crée';
                        }
                }
            }
        }
    
    // function calcul de prix selon l'id ref faire la verif du montant devis
    public function CalcPrix(){
        $id_ref= $_POST['id_ref'];
        $metrage_toiture = $_POST['metrage_toiture'];
        $req=$this->getDatabase()->prepare('SELECT * FROM '. $this->table_reference.' WHERE article_code = ?');
        $req->execute([$id_ref]);
        $data=$req->fetchAll();

        // calcul data
        
    }

    public function Liste($html=false){
        $endSql='';
        if(isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page'] > 1){
            // calcul de l'offset numéro de page -1
            $offset = ($_POST['page']-1)*LIMIT;
            $endSql='OFFSET '.$offset;
        }
        $result= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_devis.' INNER JOIN '.$this->table_client .' on client_num = id_client LIMIT '.LIMIT.' '.$endSql );
        $result->execute();
        $data =$result->fetchAll();
        if($data && is_array($data)){
            $tab=[];
            if($html){
                ob_start();
                include_once '../views/view_liste_devis.php';
                $tab['html']=ob_get_contents();
                ob_end_clean();
                return $tab;
            }
            return $data;
        }
        return false;
    }

    function Nombre(){
        $result= $this->getDatabase()->prepare('SELECT count(*) AS nb FROM '.$this->table_devis);
        $result->execute();
        $data =$result->fetch();
        if($data && isset($data['nb']) && is_numeric($data['nb'])){
            return $data['nb'];
        }
        return 0;
    }

    public function ListeInfo($html=false){
        $endSql='';
        if(isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page'] > 1){
            // calcul de l'offset numéro de page -1
            $offset = ($_POST['page']-1)*LIMIT;
            $endSql='OFFSET '.$offset;
        }
        $result= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_devis.' INNER JOIN '.$this->table_client .' on client_num = id_client WHERE client_num =? LIMIT '.LIMIT.' '.$endSql );
        $result->execute();
        $data =$result->fetchAll();
        if($data && is_array($data)){
            $tab=[];
            if($html){
                ob_start();
                include_once '../views/view_liste_devis.php';
                $tab['html']=ob_get_contents();
                ob_end_clean();
                return $tab;
            }
            return $data;
        }
        return false;

    }
    public function Chercher(){
        if(isset($_POST['id_ref'])){
            $id_ref=$_POST['id_ref'];
            $ref=[];
            $req= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_reference.' WHERE article_code= ?');
            $req ->execute([$id_ref]);
            $data= $req->fetch();
                $ref['ref']['id_ref']=$data['article_code'];
                $ref['ref']['designation']=$data['article_designation'];
                $ref['ref']['qte'] = $data['article_qt'];
                $ref['ref']['prix_fournisseur'] = $data['article_prix'];
                $ref['ref']['metrage'] = $data['quantite_m2'];
                $ref['ref']['prix_m2'] = $data['prix_metrage_unit'];
                $ref['ref']['quantite_m2'] = $data['quantite_m2'];
                $ref['ref']['ref_fournisseur'] = $data['id_fournisseur'];
                $ref['ref']['calcul_qte'] = $data['calcul_ref'];
            echo json_encode($ref);
        }
        if(isset($_POST['info_client'])){
            $idClient=$_POST['info_client'];
            $req = $this->getDatabase()->prepare('SELECT * FROM '.$this->table_devis.' WHERE client_num=?');
            $req->execute([$idClient]);
            $data = $req->fetchAll();
            return $data;
        }
        return false;
    }

    public function Details(){
        if(isset($_POST['devis_num'])){
            $devis=$_POST['devis_num'];
            $req= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_details.' INNER JOIN articles on details_ref = article_code WHERE detail_devis = ?');
            $req->execute([$devis]);
            $data=$req->fetchAll();
            return $data;
        }
        return false;
    }

    public function ModifierStatut(){
        if(isset($_POST['devis_num']) && is_numeric($_POST['devis_num']) && $_POST['devis_num'] > 0 && isset($_POST['statut'])){
            $devis=$_POST['devis_num'];
            $data =array("statut"=>0);
            $statut =$_POST['statut'];
            $type=$this->element($devis);
            // var_dump($type);
            if($type && is_array($type) && isset($type['type_devis']) && strtolower($type['type_devis'])=='devis' ){
                // echo 'ok';
                if($statut =='Valider'){
                    $newType='Facture';
                    $req= $this->getDatabase()->prepare('UPDATE '.$this->table_devis.' SET statut_devis = ?,type_devis=? WHERE devis_num= ?');
                    $d=$req->execute([$statut,'Facture',$devis]);
                }else{
                    $newType='Devis';
                    $req= $this->getDatabase()->prepare('UPDATE '.$this->table_devis.' SET statut_devis = ? WHERE devis_num= ?');
                    $d=$req->execute([$statut,$devis]);
                }
                ob_start();
                $r['type_devis']='Devis';
                $r['statut_devis']=$statut;
                $data['statut']=$d;
                $r['devis_num']=$devis;
                include ('../views/statut_devis.php');    
                $data['html']=ob_get_contents();
                ob_end_clean();
                $data['type']=$newType;
                return $data;
            }
        }
    }
 }
 $Devis = new Devis();
?>