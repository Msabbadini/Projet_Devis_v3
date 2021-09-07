<?php            
            if($data){
            foreach( $data as $r){
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
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?php
    if(empty($r['telephone_fixe_client'])){
        echo $r['telephone_portable_client'];
    }elseif(empty($r['telephone_portable_client'])){
        echo $r['telephone_fixe_client'];
    }else{
        echo $r['telephone_fixe_client'].' / '.$r['telephone_portable_client'];
    }
    ?></td>
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5 cursor-pointer">
        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
        <span id='fiche_client' class="relative text-xs" data-client='<?= $r['id_client']?>'>Impression</span>
    </span>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?= $r['date_creation'] ;?></td>
    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
        <button data-id='<?= $r['id_client'] ;?>' class="info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-700 hover:text-white focus:outline-none">Fiche Client</button>
        <button class="update px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-green-500 hover:text-white focus:outline-none ease-liner " data-categorie='clients' data-id='<?= $r['id_client']; ?>'  @click='isDialogOpen=true' type='button' >Modification</button>
        <button data-id='<?= $r['id_client'];?>' data-client='<?= $r['nom_client']." ".$r['prenom_client'] ?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-red-600 hover:text-white focus:outline-none">Suppression</button>
    </td>
    </tr>
        <?php } }
?>