<?php
session_start();
header('Content-Type: application/json');
require_once '../modeles/login.class.php';
require_once '../modeles/jwt.class.php';
$error='';
$obj2 = new JWT();
$obj = new Login();

    if(isset($_POST['log']) && isset($_POST['mp']) && !empty($_POST['log']) && !empty($_POST['mp'])){
        $pseudoPHP = htmlspecialchars($_POST['log']);
        $mpPHP = htmlspecialchars($_POST['mp']);
        $obj = new Login();
        $ip = $obj->getIp();
        $incIp=$obj->setIp($ip,$pseudoPHP);

        if($incIp ==='true'){
            $testLog = $obj->verifLogin($pseudoPHP,$mpPHP);
            // var_dump($testLog);
            if($testLog['status']){
                $_SESSION['connect'] = 1;
                $_SESSION['pseudo']=$pseudoPHP;
                $_SESSION['key']=$testLog['key'];
                $_SESSION['Owl']=$testLog['token'];
                setcookie('log',$testLog['key'],time()+ 365*24*3600);
                setcookie('bear',$testLog['token'],time()+ 365*24*3600);
                // echo $_SESSION['Owl'];
                $error= 'true';
            }else{
                $error= 'false';
            }
        }
        echo $error;
    }

    if(isset($_POST['deco']) && !empty($_POST['deco']) && $obj->VerifTokenValidity() == 'true'){

            $obj->decoLog();
            echo 1;
    }

    if(isset($_POST['validToken']) && !empty($_POST['validToken'])){
        if($obj->VerifTokenValidity()){
            if(isset($_COOKIE['bear']) && !empty($_COOKIE['bear'])){
                // On vérifie la validité
                if(!$obj2->isValid($_COOKIE['bear'])){
                    http_response_code(400);
                    echo json_encode(['message' => 'Token invalide']);
                    exit;
                }

                // On vérifie la signature
                if(!$obj2->check($_COOKIE['bear'])){
                    http_response_code(403);
                    echo json_encode(['message' => 'Le token est invalide']);
                    exit;
                }

                // On vérifie l'expiration
                if($obj2->isExpired($_COOKIE['bear'])){
                    http_response_code(403);
                    echo json_encode(['message' => 'Le token a expiré']);
                    exit;
                }
            }

        }
    }


?>