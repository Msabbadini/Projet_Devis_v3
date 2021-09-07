<?php 
require_once '../modeles/devis.class.php';
global $Devis;
?>
<div class="-my-2 py-2 overflow-x-auto ">
      <div id='details_client_devis' class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
      <button class="modification_devis px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-500 hover:text-white focus:outline-none" type='button'>Modification </button>

      </div>
    </div>
<div class="-my-2 py-2 overflow-x-auto ">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">N° Ligne</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Détails</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Quantités</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Montant Ligne</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white" id='details_devis'>
                        <?php
                            $data=$Devis->Details();
                                if($data){
                                    foreach($data as $d){
                            ?>
                            <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $d['detail_num'] ?></td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $d['article_designation'] ?></td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $d['details_qte'] ?>€</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $d['details_qte']*$d['article_prix'] ?>€</td>
                            </tr>
                        <?php
                                    }
                                }
                        ?>
                        </tbody>
                    </table>
                  <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">


    </div>
                </div>
            </div>
