<?php 
include('src/function.php');
include 'src/connexion.php';

if(isset($_GET['clientId'])){
    $id =htmlspecialchars($_GET['clientId']);
}
// <?php echo $r['type_devis']=='Devis' ? $r['statut_devis'] : $r['statut_facture']; methode tertiare
$req=$db->prepare('SELECT * FROM devis  INNER JOIN clients AS c ON client_num = id_client WHERE client_num = ? ORDER BY devis_num');
$req->execute([$id]);
$req->setFetchMode(PDO::FETCH_ASSOC);
$data = $req->fetchAll();


?>
<div class="-my-2 py-2 overflow-x-auto ">
      <div class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
          <?php
          $req2 = $db -> prepare('SELECT * FROM clients WHERE id_client= ?');
          $req2 -> execute([$id]);
          $client= $req2-> fetchAll();
          foreach($client as $d){
          ?>
        <h3 class="text-lg font-medium leading-6 text-gray-900"><span class='text-indigo-600 font-bold'>Fiche Client :</span>  <?=$d['civilite_client'].' '. $d['nom_client'].' '.$d['prenom_client'] ?></h3>
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
            <button id='<?= $r['id_client']?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-500 hover:text-white focus:outline-none">Impression Fiche Client </button>
        </div>
        <?php
          }
        ?>
        <div id="msg"></div>
      </div>
    </div>
<div class="-my-2 py-2 overflow-x-auto ">
                <div class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
                    <div class="flex justify-between">
                        <div class="inline-flex border rounded w-7/12 px-2 lg:px-6 h-12 bg-transparent">
                            <div class="flex flex-wrap items-stretch w-full h-full mb-6 relative">
                                <div class="flex">
                                    <span class="flex items-center leading-normal bg-transparent rounded rounded-r-none border border-r-0 border-none lg:px-3 py-2 whitespace-no-wrap text-grey-dark text-sm">
                                        <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" class="flex-shrink flex-grow flex-auto leading-normal tracking-wide w-px flex-1 border border-none border-l-0 rounded rounded-l-none px-3 relative focus:outline-none text-xxs lg:text-xs lg:text-base text-gray-500 font-thin" placeholder="Recherche devis" id='search'>
                            </div>
                        </div>
                    </div>
                    <div class='mt-10'>
                        <div id="result_recherche"></div>
                    </div>
                </div>
                <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">N° Devis</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Type</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Statut</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Montant Devis</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Status</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Date Création</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white" id='client'>
                           <?php
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
    <span id='fiche_client' class="relative text-xs"><?= $r['statut_devis'] ?></span>
    <?php
        }elseif($r['statut_devis']=='Valider'){
            ?>
    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
    <span aria-hidden class="absolute inset-0 bg-green-500 opacity-50 rounded-full"></span>
    <span id='fiche_client' class="relative text-xs"><?= $r['statut_devis'] ?></span>

            <?php
        }elseif($r['statut_devis']=='Refus'){
            ?>
    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
    <span aria-hidden class="absolute inset-0 bg-red-500 opacity-50 rounded-full"></span>
    <span id='fiche_client' class="relative text-xs"><?= $r['statut_devis'] ?></span>

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

    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?= $r['date_creation'] ?></td>
    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
        <button data-id='<?= $r['id_client'] ?>' class="info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-500 hover:text-white focus:outline-none">Details </button>
        <button data-id='<?= $r['id_client'] ?>' class="info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-yellow-500 hover:text-white focus:outline-none">Modification </button>
        <button class="update px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-green-500 hover:text-white focus:outline-none ease-liner " data-role='update' data-id='<?= $r['devis_num'] ?>' type='button' >Impression </button>
        <button id='<?= $r['id_client']?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-red-600 hover:text-white focus:outline-none">Suppression </button>
    </td>
    </tr>
                        <?php
                            }
                           ?>
                               
                        </tbody>
                    </table>
                  <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
        <div>
            <p class="text-sm leading-5 text-blue-700">
                test
                <span class="font-medium">1</span>
                to
                <span class="font-medium">200</span>
                of
                <span class="font-medium">2000</span>
                results
            </p>
        </div>
        <div>
            <nav class="relative z-0 inline-flex shadow-sm">
                <div	>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div>
                    <a href="#" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">
                        1
                    </a>
                  <a href="#" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">
                        2
                    </a>
                   <a href="#" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">
                        3
                    </a>
                </div>
                <div v-if="pagination.current_page < pagination.last_page">
                    <a href="#" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </nav>
        </div>
    </div>
                </div>
            </div>
<script>

$(document).ready(function () {
//Barre de recherche Start
    $('#search').keyup(function(){
        $('#result_recherche').html('')

        var client =  $(this).val()

        if(client != ''){
            $.ajax({
                type: 'GET',
                url: 'fonctions/recherche_client.php',
                data: 'client='+ encodeURIComponent(client),
                success:function(data){
                    if(data !=''){
                        $('#result_recherche').append(data)
                        console.log(client)
                    }else{
                        document.getElementById('result_recherche').innerHTML += "<div class='text-red-600 text-center font-medium mt-10'> Aucun Client ne correspondant a votre recherche </div> ";
                    }
                }
            })
        }
    });
// Barre de recherche END
// 

	
});
</script>