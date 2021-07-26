<?php

$url_en_cours=$_SERVER['REQUEST_URI'];
$url_en_cours=substr($url_en_cours,strripos($url_en_cours,"/")+1);
$url_en_cours = str_replace(".php","",str_replace("-"," ",$url_en_cours));
$url_en_cours = strtoupper(substr($url_en_cours,0,1)).substr($url_en_cours,1);	

try{
    $db= new PDO('mysql:host=localhost;dbname=lionel;charset=utf8','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die($e->getMessage());
}

// class connexionDB{
//     private $host='localhost';
//     private $charset='utf8';
//     private $name='lionel';
//     private $user= 'root';
//     private $pass= '';
//     private $connexion;
// // Function qui construit notre connexion
//     function __construct($host=null,$name=null,$user=null,$pass=null,$charset=null){
//         if($host != null){
//             $this->host = $host;
//             $this->name = $name;
//             $this->user = $user;
//             $this->pass = $pass;
//             $this->charset = $charset;
//         }
//         try{
//             $this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->name.';charset='.$this->charset,$this->user,$this->pass);
//             $this->connexion -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//         }catch(PDOExecption $e){
//             die($e->getMessage());
//         }
//     }
//     // Function qui sert a la selection 
//     public function select($sql){
//         $req = $this->connexion->prepare($sql);
//         $req->execute();
//         // $req->fetchAll();
//         return $req;
//     }
// // Function qui sert a Insert update delete
//     public function insert($sql,$data=array()){
//         $req=$this->connexion->prepare($sql);
//         $req->execute($data);
//     }
// }

// $db= new connexionDB();

?>