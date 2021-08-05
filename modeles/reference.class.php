<?php
 require_once 'connexion.class.php';
class Reference extends DB{
    function __construct(){
        parent::__construct();
    }

    function Liste(){
            $req= $this->getDatabase()->prepare('SELECT * FROM '.$this->table_reference.' ORDER BY article_code');
            $req->execute();
            $data= $req->fetchAll();
            // var_dump($data);
            // echo $this->table_reference;
            return $data;
    }    
}
$References= new Reference();


?>


