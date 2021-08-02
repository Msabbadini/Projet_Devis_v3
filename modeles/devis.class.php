<?php
 require_once 'connexion.class.php';

 class Devis extends DB{
     
    // function calcul de prix selon l'id ref
    public function CalcPrix(){
        $id_ref= $_POST['id_ref'];
        $metrage_toiture = $_POST['metrage_toiture'];
        $req=$this->getDatabase()->prepare('SELECT * FROM '. $this->table_reference.' WHERE article_code = ?');
        $req->excute([$id_ref]);
        $data=$req->fetchAll();

        // calcul data
        
    }

    public function Liste(){
        if($_POST['select'] =='all'){
        $req= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_reference.' ORDER BY article_code');
        $req->execute();
        $data= $req->fetchAll();
        ?>
        <option value="">Choisir référence</option>
        <?php
        foreach($data as $d){?>
           <option value="<?=$d['article_code']?>"><?=$d['article_designation']?></option>
       <?php }
        }

    }

    public function Chercher(){
        if(isset($_POST['id_ref'])){
            $id_ref=$_POST['id_ref'];
        $ref=[];
        $req= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_reference.' WHERE article_code= ?');
        $req ->execute([$id_ref]);
        $data= $req->fetchAll();
        foreach($data as $d){
            $ref['ref']['id_ref']=$d['article_code'];
            $ref['ref']['designation']=$d['article_designation'];
            $ref['ref']['qte'] = $d['article_qt'];
            $ref['ref']['prix_fournisseur'] = $d['article_prix'];
            $ref['ref']['metrage'] = $d['quantite_m2'];
            $ref['ref']['prix_m2'] = $d['prix_metrage_unit'];
            $ref['ref']['quantite_m2'] = $d['quantite_m2'];
            $ref['ref']['fournisseur'] = $d['fournisseur'];
            $ref['ref']['ref_fournisseur'] = $d['ref_fournisseur'];
        }
        echo json_encode($ref);
        }
    }
 }
?>