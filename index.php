<?php
    include('src/connexion.php');
    include('src/entete.php');
    include("src/header.php")
?>
<section class='page-content'>
<div id="msg"></div>
</section>


<script>
        $(document).ready(function () {
                $('.menu').click(function(){
                    var page = $(this).data('menu');
                    $('.page-content').load(page+'.php');
                });            
});
</script>
<?php include('src/pied_page.php')?>