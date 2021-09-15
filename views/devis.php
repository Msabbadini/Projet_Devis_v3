<?php
require_once '../modeles/reference.class.php';
global $References;
?>
<div>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-2 sm:px-0">
        <form id='ajout_client'>
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-2 py-5 bg-gray-200 sm:p-6">
              <h1 class='text-indigo-500 text-center font-bold'>Informations Client</h1>
            <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 mt-3">
            <div class="align-middle rounded-full  inline-block w-full  overflow-hidden bg-white shadow-lg ">
                    <div class="flex justify-between">
                        <div class="inline-flex border rounded-full w-full px-2 bg-transparent">
                            <div class="flex flex-wrap items-stretch w-full   relative">
                                <div class="flex">
                                    <span class="flex items-center leading-normal bg-transparent rounded rounded-r-none border border-r-0 border-none lg:px-3 py-2 whitespace-no-wrap text-grey-dark text-sm">
                                        <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" class="flex-shrink flex-grow flex-auto leading-normal tracking-wide w-px  border border-none border-l-0 rounded rounded-l-none px-3 relative focus:outline-none text-xxs  lg:text-base text-gray-500 font-thin" placeholder="Recherche Client" id='search_devis'>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- <div>
                      <div id="result_recherche_devis" class='flex justify-center flex-wrap'></div>
                  </div> -->
              </div>
              <div class="col-span-6" id="result_recherche_devis"></div>
              <div class='col-span-6'id="result_search">

              </div>
              
            </div>
            <div class=" mt-4 border-t-4 border-indigo-500 col-span-12"></div>
            <h1 class=' m-3 text-indigo-500 text-center font-bold'>Informations Références Devis</h1>

            <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
            <select id='select_ref'   class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            <option value="">Choisir référence</option>
            <?php
            $data=$References->Liste();
            if($data){
                foreach($data as $d){?>
                  <option value="<?=htmlentities($d['article_code']);?>"><?= htmlentities($d['article_designation']);?></option>
            <?php } 
            }?>
            </select>
              </div>
              <div class="col-span-6">
                <span class='error_metrage text-indigo-600 text-xl'></span>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700"> M² Toiture</label>
                <input type="number" id='metrage_toiture_M2' name="metrage_toiture"  autocomplete="Metrage toiture client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700"> ML Toiture</label>
                <input type="number" id='metrage_toiture_Ml' name="metrage_toiture"  autocomplete="Metrage toiture client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

              </div>
              <div class="col-span-6 sm:col-span-6">
                <input type="hidden" name="id_ref" id='ref_id_ref'>
                <label class="block text-sm font-medium text-gray-700">Désignation référence</label>
                <textarea name="designation_ref" id="ref_designation" cols='60' rows="3" readonly class='resize-none mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md '></textarea>
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label for="last_name" class="block text-sm font-medium text-gray-700">QTE Fournisseur</label>
                <input type="text" id='ref_qte' name="quantite_ref" autocomplete="Quantite" class="mt-1 pl-2 bg-indigo-500 text-white font-bold focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label  class="block text-sm font-medium text-gray-700"> HT Fournisseur</label>
                <input type="text" id='ref_prix_fournisseur' name="prix_fournisseur"  autocomplete="" class="mt-1 pl-2 bg-indigo-500 text-white font-bold focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                
              </div>
              <div class="col-span-6 sm:col-span-2">
                <label  class="block text-sm font-medium text-gray-700">Ref Fournisseur</label>
                <input type="text" id='ref_ref_fournisseur' name="ref_fournisseur"  autocomplete="" class="mt-1 pl-2 bg-indigo-500 text-white font-bold focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">         
              </div>

              <div class="col-span-2">
                <label  class="block text-sm font-medium text-gray-700">QTE/m²</label>
                <input type="text" id='ref_metrage' name="ref_prix_fournisseur"  autocomplete="Adresse postal client" class="mt-1 pl-2 bg-purple-500 text-white font-bold focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-3">
                <label  class="block text-sm font-medium text-gray-700">Prix HT/M²</label>
                <input type="text" id='ref_prix_m2' name="ref_prix_m2"  autocomplete="Adresse postal client" class="mt-1 pl-2 bg-purple-500 text-white font-bold focus:ring-red-500 focus:border-red-500 block w-full  shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-3">
                <label  class="block text-sm font-medium text-indigo-700">Quantité Commandée</label>
                <input type="number" id='ref_qte_commande' name="quantite_commande"  autocomplete="Adresse postal client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              <div class="col-span-3">
                <label  class="block text-sm font-medium text-indigo-700">Prix HT Commande</label>
                <input type="number" id='ref_prix_commande' name="quantite_commande"  autocomplete="Adresse postal client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <input type="hidden" name="id_article" id='ref_id'>
            <button type="button" id='ajout_ref_btn' data-calcul_qte='' class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Ajouter
            </button>
            <!-- <button type="submit" id='valide_ref_btn' class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Validation Devis
            </button> -->
          </div>
        </div>
      </form>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form id='tab_devis'>
        <div class="shadow overflow-hidden sm:rounded-md">
          <div  class="px-4 py-3 bg-gray-50 text-left sm:px-6">
            <input type="hidden" name="id_client" value='' id='id_client'>
            <label class="total_commande text-indigo-500 text-lg font-semibold col-span-2">Total Commande : </label>
            <input type='number' id="total_commande" name='total_commande' class='bg-indigo-500 text-white font-bold rounded-md pl-3' value='0' readonly>
            <button type="button" id='valide_devis_btn' class="inline-flex justify-end py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Validation Devis
            </button>          
          </div>
          <div class="px-4 py-5 bg-gray-200 sm:p-6">
            <div class=" grid grid-cols-6 gap-6">
            <table class='table-auto col-span-6 text-left'>
              <thead>
                <tr>
                  <th>N° Référence</th>
                  <th>Designation Ref</th>
                  <th>Qte devis</th>
                  <th>Prix Total Ht </th>
                </tr>
              </thead>
              <tbody id='contenu_devis' >

              </tbody>
            </table>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include '../src/Js/template.js'?>
