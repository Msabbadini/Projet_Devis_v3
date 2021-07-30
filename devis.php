
<div>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <form id='ajout_client'>
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-gray-200 sm:p-6">
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
                                <input type="text" class="flex-shrink flex-grow flex-auto leading-normal tracking-wide w-px  border border-none border-l-0 rounded rounded-l-none px-3 relative focus:outline-none text-xxs  lg:text-base text-gray-500 font-thin" placeholder="Recherche Client" id='search_devis_client'>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- <div>
                      <div id="result_recherche_devis" class='flex justify-center flex-wrap'></div>
                  </div> -->
              </div>
              <div class="col-span-6" id="result_recherche_devis"></div>
              <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Nom Client</label>
                <span id="nom-error" class="error text-indigo-500"></span>
                <input type="text" name="nom"  autocomplete="Nom du client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Prenom client</label>
                <span id="prenom-error" class="error text-indigo-500"></span>
                <input type="text" name="prenom" autocomplete="Prénom du client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label  class="block text-sm font-medium text-gray-700">Adresse Email</label>
                <span id="email-error" class="error text-indigo-500"></span>
                <input type="mail" name="email"  autocomplete="email client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6">
                <label  class="block text-sm font-medium text-gray-700">Adresse Postal</label>
                <span id="adresse-error" class="error text-indigo-500"></span>
                <input type="text" name="adresse_postal"  autocomplete="Adresse postal client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-3">
                <label  class="block text-sm font-medium text-gray-700">Code Postal</label>
                <span id="code_postal-error" class="error text-indigo-500"></span>
                <input type="number" name="code_postal"  autocomplete="Code postal" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-3">
                <label  class="block text-sm font-medium text-gray-700">Ville</label>
        <span id="ville-error" class="error text-indigo-500"></span>
                <input type="text" name="ville" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Téléphone Fixe</label>
                <span id="tel-error" class="error text-indigo-500"></span>
                <input type="text" name="telephone_fixe" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Téléphone Portable</label>
                <span id="telephone_portable-error" class="error text-indigo-500"></span>

                <input type="text" name="telephone_portable"  autocomplete="Téléphone Portable" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
            </div>
            <div class=" mt-4 border-t-4 border-indigo-500 col-span-12"></div>
            <h1 class=' m-3 text-indigo-500 text-center font-bold'>Informations Références Devis</h1>

            <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
            <select  name="genre" autocomplete="civilité" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                  <option value="">Choisir référence</option>
                  <option value="Monsieur">Monsieur</option>
                  <option value='Madame'>Madame</option>

                </select>
              </div>
              <div class="col-span-2">
                                  <label class="block text-sm font-medium text-gray-700"> m² Toiture</label>
                <span id="nom-error" class="error text-indigo-500"></span>
                <input type="text" name="nom"  autocomplete="Nom du client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

              </div>
              <div class="col-span-6 sm:col-span-6">
                <label class="block text-sm font-medium text-gray-700">Désignation référence</label>
                <span id="nom-error" class="error text-indigo-500"></span>
                <input type="text" name="nom"  autocomplete="Nom du client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Quantité</label>
                <span id="prenom-error" class="error text-indigo-500"></span>
                <input type="text" name="prenom" autocomplete="Prénom du client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label  class="block text-sm font-medium text-gray-700">Metrage</label>
                <span id="email-error" class="error text-indigo-500"></span>
                <input type="mail" name="email"  autocomplete="email client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-2">
                <label  class="block text-sm font-medium text-gray-700">Prix HT</label>
                <span id="adresse-error" class="error text-indigo-500"></span>
                <input type="text" name="adresse_postal"  autocomplete="Adresse postal client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-3">
                <label  class="block text-sm font-medium text-indigo-700">Quantité Commandée</label>
                <span id="adresse-error" class="error text-indigo-500"></span>
                <input type="text" name="adresse_postal"  autocomplete="Adresse postal client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button type="submit" id='ajout_client_btn' class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Ajouter
            </button>
            <button type="submit" id='ajout_client_btn' class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Validation Devis
            </button>
          </div>
        </div>
      </form>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form id='ajout_client'>
        <div class="shadow overflow-hidden sm:rounded-md">
          <div  class="px-4 py-3 bg-gray-50 text-left sm:px-6">
            <h4 class="total_commande text-indigo-500 text-lg font-semibold">Total Commande : </h4>
          </div>
          <div class="px-4 py-5 bg-gray-200 sm:p-6">
            <div class="contenu_devis grid grid-cols-6 gap-6">

        </div>
      </form>
    </div>
  </div>
</div>


