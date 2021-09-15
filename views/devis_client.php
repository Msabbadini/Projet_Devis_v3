<?php
require_once '../modeles/client.class.php';
global $Clients;
$d = $Clients->Chercher();
if($d){
        // foreach($data as $d){ ?>
              <div class="col-span-6 ">

                <label class="block text-sm font-medium text-gray-700">Client</label>
                <span id="nom-error" class="error text-indigo-500"></span>
                <input type="text" name="nom" data-client_id='<?=$d['id_client']?>' autocomplete="Nom du client" value="<?= $d['civilite_client'].' '.$d['nom_client'].' '.$d['prenom_client']?>" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              </div>


              <div class="col-span-6">
                <label  class="block text-sm font-medium text-gray-700">Adresse Email</label>
                <span id="email-error" class="error text-indigo-500"></span>
                <input type="mail" name="email"  autocomplete="email client" value='<?=$d['email_client']?>' class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              </div>

              <div class="col-span-6">
                <label  class="block text-sm font-medium text-gray-700">Adresse Client</label>
                <span id="adresse-error" class="error text-indigo-500"></span>
                <input type="text" name="adresse_postal" value='<?=$d['adresse_postal'].' , '.$d['code_postal'].' '.$d['ville_client']?>'  autocomplete="Adresse postal client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              </div>

              <div class="col-span-3">
                <label class="block text-sm font-medium text-gray-700">Téléphone Fixe</label>
                <span id="tel-error" class="error text-indigo-500"></span>
                <input type="text" name="telephone_fixe" value='<?=$d['telephone_fixe_client']?>' class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              </div>

              <div class="col-span-3 ">
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Téléphone Portable</label>
                <span id="telephone_portable-error" class="error text-indigo-500"></span>

                <input type="text" name="telephone_portable" value='<?=$d['telephone_portable_client']?>' autocomplete="Téléphone Portable" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              </div>
<?php        
        // }
    }
?>