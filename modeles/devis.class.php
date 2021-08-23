<?php
 require_once 'connexion.class.php';

 class Devis extends DB{
     
    function __construct(){
        parent::__construct();
    } 

    // function calcul de prix selon l'id ref faire la verif du montant devis
    public function CalcPrix(){
        $id_ref= $_POST['id_ref'];
        $metrage_toiture = $_POST['metrage_toiture'];
        $req=$this->getDatabase()->prepare('SELECT * FROM '. $this->table_reference.' WHERE article_code = ?');
        $req->excute([$id_ref]);
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
        $result= $this->getDatabase()->prepare('SELECT count(*) FROM '.$this->table_devis);
        $result->execute();
        $data =$result->fetch();
        if($data && isset($data[0]) && is_numeric($data[0])){
            return $data[0];
        }
        return 0;
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
 }
 $Devis = new Devis();
?>