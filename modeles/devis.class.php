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

    public function Liste(){

        // Pagination Liste Devis Start
        if(!(isset($_POST['pageNum']))){
            $ref=[];
            $html=[];
            $numero_de_page=1;
        }else{
            $numero_de_page=intval($_POST['pageNum']);
        }

        $page_limite = ($_POST['show'] <> '' && is_numeric($_POST['show']))? intval($_POST['show']) :10;
        $req= 'SELECT count(*) as count FROM devis';
        try{
            $requete = $this->getDatabase()->prepare($req);
            $requete -> execute();
            $tResult = $requete ->fetchAll();
        } catch(Exception $e){
            echo ($e->getMessage());
        }
        $cnt = $tResult[0]['count'];
        $last_page = ceil($cnt/$page_limite);
        //
        $lower_limit=($numero_de_page -1)*$page_limite;
        $requete2= 'SELECT * FROM devis  INNER JOIN clients AS c ON client_num = id_client ORDER BY devis_num LIMIT '.($lower_limit).', '.($page_limite).' ';
        try {
            $req2= $this->getDatabase()->prepare($requete2);
            $req2->execute();
            $resultats= $req2->fetchAll();
            foreach($resultats as $r){
                $ref[$r['devis_num']]['id_devis']=$r['devis_num'];
                $ref[$r['devis_num']]['nom']=$r['nom_client'];
            }
        } catch (Exception $e) {
            echo ($e->getMessage());
        }
        for($i=1;$i<=$last_page;$i++){
            if($i==$numero_de_page){?>
                <a href="#"  class=" -ml-px relative inline-flex items-center px-4 py-2 border border-indigo-500 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"><?php echo $i ?></a>

            <?php }else{ ?>
                <a href="#" data-pagenum='<?= $i ?>' data-pagelimit='<?= $page_limite ?>' class="displayRecords -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"><?php echo $i ?></a>
            <?php    
            }
        }
        echo json_encode($ref);
        // Pagination Liste Devis End

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
                $ref['ref']['ref_fournisseur'] = $data['ref_fournisseur'];
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