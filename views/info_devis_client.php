<?php
require_once '../modeles/devis.class.php';
global $Devis;

    $data=$Devis->Chercher();
    if($data){
        
        foreach($data as $r){
            ?>
         <tr id='<?= $r['id_client'] ?>'>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                <div class="flex items-center">
                    <div>
                        <div class="text-sm leading-5 text-gray-800"><?= $r['devis_num'] ?></div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $r['type_devis'] ?></td>
            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?php 
            if($r['type_devis']=='Devis'){
            if($r['statut_devis']=='En attente'){
            ?>
                <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                <span aria-hidden class="absolute inset-0 bg-yellow-500 opacity-50 rounded-full"></span>
                <span id='statut_devis' class="relative text-xs"><?= $r['statut_devis'] ?></span>
            <?php
            }elseif($r['statut_devis']=='Valider'){
            ?>
                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                <span aria-hidden class="absolute inset-0 bg-green-500 opacity-50 rounded-full"></span>
                <span id='statut_devis' class="relative text-xs"><?= $r['statut_devis'] ?></span>

            <?php
            }elseif($r['statut_devis']=='Refus'){
            ?>
                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                <span aria-hidden class="absolute inset-0 bg-red-500 opacity-50 rounded-full"></span>
                <span id='statut_devis' class="relative text-xs"><?= $r['statut_devis'] ?></span>

            <?php
            }
            }


            ?></td>
            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
            <?= $r['devis_montant'] ?>€
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
            <?= $r['date_devis_modification']==''? 'Aucune Modification':$r['date_devis_modification'] ?>
            </td>

            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?= $r['devis_date'] ?></td>
            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                <button data-id_devis='<?= $r['devis_num'] ?>' data-id_client='<?=$r['client_num']?>' class="details_info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-500 hover:text-white focus:outline-none">Details </button>
                <button data-id='<?= $r['client_num'] ?>' data-id_devis='<?= $r['devis_num']?>' class="print px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-yellow-500 hover:text-white focus:outline-none" Type='button'>Impression </button>
                <button class="update px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-green-500 hover:text-white focus:outline-none ease-liner " data-role='update' data-id='<?= $r['devis_num'] ?>' type='button' >Modification </button>
                <button id='<?= $r['client_num']?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-red-600 hover:text-white focus:outline-none">Suppression </button>
            </td>
        </tr>
         <?php
             }
        

    }
?>                         