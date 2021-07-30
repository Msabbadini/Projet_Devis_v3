<?php
// require_once 'src/connexion.php';
// $req=$db->prepare('SELECT * FROM clients ORDER BY date_creation ');
// $req->execute();
// $tab =$req->fetchAll();

    foreach($tab as $r){
        // print_r($r);
        ?>
        <tr id='<?= $r['id_client'] ?>'>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
        <div class="flex items-center">
            <div>
                <div class="text-sm leading-5 text-gray-800"><?= $r['id_client'] ?></div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
        <div  class="text-sm leading-5 text-blue-900"><?= $r['civilite_client'].' '.$r['nom_client'].' '.$r['prenom_client'] ?></div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $r['email_client']; ?></td>
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?=$r['telephone_fixe_client'].' / '.$r['telephone_portable_client']; ?></td>
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
        <span id='fiche_client' class="relative text-xs">Impression</span>
    </span>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?= $r['date_creation'] ;?></td>
    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
        <button data-id='<?= $r['id_client'] ;?>' class="info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-700 hover:text-white focus:outline-none">Fiche Client</button>
        <button class="update px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-green-500 hover:text-white focus:outline-none ease-liner " data-modal='modal_id' data-id='<?= $r['id_client']; ?>' type='button' >Modification</button>
        <button id='<?= $r['id_client'];?>' data-client='<?= $r['nom_client']." ".$r['prenom_client'] ?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-red-600 hover:text-white focus:outline-none">Suppression</button>
    </td>
    </tr>
        <?php
    } 
?>