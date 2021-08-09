<?php
require_once '../modeles/client.class.php';
global $Clients;

            $client= $Clients->Chercher();
        if($client){
          foreach($client as $d){
          ?>
        <h1 class="text-lg font-medium leading-6 text-gray-900"><span class='text-indigo-600 font-bold'>Fiche Client :</span>  <?=$d['civilite_client'].' '. $d['nom_client'].' '.$d['prenom_client'] ?></h1>
        <div class="flex flex-wrap">

            <p class="m-5  text-md text-gray-600">
               <span class='text-indigo-600 font-bold'> Email : </span> <?= $d['email_client'] ?>
            </p>
            <p class='m-5 text-md text-gray-600'>
               <span class='text-indigo-600 font-bold'>N° Téléphone : </span>  
                <?php
                if($d['telephone_fixe_client'] != ''){
                    echo $d['telephone_fixe_client'].'/'.$d['telephone_portable_client'];
                }elseif($d['telephone_portable_client'] == ''){
                    echo $d['telephone_fixe_client'];
                }elseif($d['telephone_fixe_client'] == ''){
                    echo $d['telephone_portable_client'];
                }   
                ?>
            </p>
            <p class="m-5 text-md text-gray-600">
                <span class="text-indigo-600 font-bold">Adresse Client : </span>
                <?= $d['adresse_postal'].' , '.$d['code_postal'].' '.$d['ville_client'] ?>
            </p>
            <button data-id_client="<?= $d['id_client']?>" class="print_client px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-500 hover:text-white focus:outline-none" type='button'>Impression Fiche Client </button>
        </div>
        <?php
          }
        }
        ?>