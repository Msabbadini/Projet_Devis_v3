<?php
require_once '../modeles/client.class.php';
global $Clients;
            $data = $Clients->Chercher();
                if($data){
                    foreach($data as $r){ ?>
                    <div class='mt-6 ml-2 border border-indigo-500 w-3/12' >
                        <h4 class='text-center font-bold text-indigo-400 text-xl '><?= $r['nom_client']." ".$r['prenom_client']."--".$r['ville_client']?></h4> 
                            <div class='flex justify-center'>
                                <button Type='button' class='info px-5 py-2 my-3 ml-5 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-500 hover:text-white focus:outline-none' data-id='<?= $r['id_client']?>'>Fiche Client</button>
                                <button data-id_client="<?= $r['id_client']?>" class="print_client px-5 py-2 my-3 ml-5 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-yellow-500 hover:text-white focus:outline-none" type='button'>Impression Fiche Client </button>
                            </div>
                    </div>
                        <?php }
                        }
                        ?>