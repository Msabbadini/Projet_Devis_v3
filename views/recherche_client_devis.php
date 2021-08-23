<?php
require_once '../modeles/client.class.php';
global $Clients;
    $data = $Clients->Chercher();
        if($data){
            foreach($data as $r){
                ?>
                <div class='mt-2 ml-2 border border-indigo-500 result_client'  data-client='<?=$r['id_client']?>' >
                    <p class='text-center font-bold text-indigo-400 text-xl ' ><?= $r['nom_client']." ".$r['prenom_client']."--".$r['ville_client']?></p> 
                 </div>
       <?php
            }
        }

?>