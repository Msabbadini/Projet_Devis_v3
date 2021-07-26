<?php
    include('./src/connexion.php');
    include('./src/function.php');
    include('./src/entete.php');
    include("src/header.php");
?>
<section class='page-content'>
<div id="msg"></div>
</section>


<script>
$(document).ready(function () {
    // Menu START
    $('.menu').click(function(){
        var page = $(this).data('menu');
        $('.page-content').load(page+'.php');
     });
    // MENU END
            
});
</script>
<?php include('src/pied_page.php')?>