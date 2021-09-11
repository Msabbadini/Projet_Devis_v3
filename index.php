<?php
    session_start();
    if(!isset($_SESSION['connect'])){
        header('location:login.php');
    };
    include('./src/Php/entete.php');
    include("src/Php/header.php");
 ?>
<section class='page-content' >
<div id="msg"></div>
</section>
<input type="hidden" name="OwlToken" id='OwlToken' value='<?=$_SESSION['Owl']?>'>
<script  src="src/Js/ajax.js"></script>
<?php include('src/Php/pied_page.php')?>