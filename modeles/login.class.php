<?php
 require_once 'connexion.class.php';
require_once 'jwt.class.php';
 class Login extends DB{
    
    function __construct(){
        parent::__construct();
    } 


    public function getIp(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip= $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip =$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip =$_SERVER['REMOTE_ADDR'];
        }
        return $ip;   
    }

    // public function verifPassword($mdp){
    //     $majuscule=preg_match('@[A-Z]@',$mdp);
    //     $minuscule=preg_match('@[a-z]@',$mdp);
    //     $chiffre=preg_match('@[0-9]@',$mdp);
        
    //     if (!$majuscule || !$minuscule || !$chiffre || strlen($mdp)<8){
    //         return false;
    //     }else{
    //         return true;
    //     }   
    // }
    
    public function refreshKey($pseudo){
        $hash= crypt($pseudo, rand());
        $hash= crypt($hash, time());
        $req=$this->getDatabase()->prepare("UPDATE ".$this->table_login." set key_user=:key WHERE pseudo=:logUp OR email = :emailUp ");
        $req->execute(array(
            ':key'=>$hash,
            ':logUp'=>$pseudo,
            ':emailUp'=>$pseudo
        ));
        return $hash;
            // refresh End
    }

    public function setIp($ip,$pseudo){
        $req = $this->getDatabase()->prepare('INSERT INTO '.$this->table_tentative.'(adresse_ip,login) VALUES(?,?)' );
        $req->execute([$ip,$pseudo]);
        return 'true';
    }

    public function verifLogin($pseudo,$password){
        $req = $this->getDatabase()->prepare('SELECT * FROM '.$this->table_login.' WHERE email=? OR pseudo = ?');
        $req ->execute([$pseudo,$pseudo]);

        
        while($user = $req -> fetch()){
            if (password_verify($password,$user['password'])){
                
                $key = $this->refreshKey($pseudo);
                $payload =['login'=>$user["pseudo"],'key'=>$key];
                $jwt = new JWT();
                $token= $jwt->generate($payload);
                $ret=['token'=>$token,'login'=>$user['pseudo'],'key'=>$key,'status'=>'true'];
                return $ret;
            }else{
                $ret='false';
                return $ret;
            }
        }
    }

    public function decoLog(){
        session_unset();
        session_destroy();
        setcookie('log','',time()-3444,'/',null,false,true);
        setcookie('bear','',time()-3444,'/',null,false,true);
    }

    public function VerifTokenValidity(){
        $headers = apache_request_headers();
        // echo $_COOKIE['bear'];
        // var_dump($headers);
        if(isset($headers['JWT-Token']) && !empty($headers['JWT-Token'])){
            if( $headers['JWT-Token'] !== $_COOKIE['bear']){
                exit(json_encode(['error'=>'Token invalide']));
            }
            return 'true';
        }else{
            exit(json_encode(['error'=>'Token inexistant']));
        }
    }

    public function verifSession(){
        $error ='true';
        if(!isset($_SESSION['pseudo']) && empty($_SESSION['pseudo'])){
            $error='false';
        }
        if(!isset($_SESSION['key']) && empty($_SESSION['key'])){
            $error='false';
        }
        if(!isset($_SESSION['Owl']) && empty($_SESSION['Owl'])){
            $error='false';
        }
        if(!isset($_COOKIE['log']) && empty($_COOKIE['log'])){
            $error='false';
        }
        if(!isset($_COOKIE['bear']) && empty($_COOKIE['bear'])){
            $error ='false';
        }
        return $error;
    }

 }
?>