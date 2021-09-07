<?php
    $titre="";
    if(isset($url_en_cours) && $url_en_cours!=""){
        $titre=$url_en_cours;
    }else{
        $titre="Gestion ETS Thibaud";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre?></title>
    <meta name="description" content="Gestion Client ETS Thibaud">
    <link rel="stylesheet" href="./design/default.css">
    <link rel="stylesheet" href="./tailwind.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="./src/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="./src/math.js" type="text/javascript"></script>  

</head>
<body>
    
