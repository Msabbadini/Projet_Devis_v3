<form id='ajout_client' method='post'>
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-gray-200 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Civilité</label>
                <span id="genre-error" class=" text-indigo-500"></span>

                <select  name="genre" autocomplete="civilité" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                  <option value="">Choisir Civilité</option>
                  <option value="Monsieur">Monsieur</option>
                  <option value='Madame'>Madame</option>

                </select>
              </div>
              <div class="col-span-6"></div>
              <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Nom Client</label>
                <span id="nom-error" class="error text-indigo-500"></span>
                <input id='modal_form_nom_client' type="text" name="nom"  autocomplete="Nom du client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value=''>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Prenom client</label>
                <span id="prenom-error" class="error text-indigo-500"></span>
                <input id='modal_form_prenom_client' type="text" name="prenom" autocomplete="Prénom du client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label  class="block text-sm font-medium text-gray-700">Adresse Email</label>
                <span id="email-error" class="error text-indigo-500"></span>
                <input id='modal_form_email_client' type="mail" name="email"  autocomplete="email client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6">
                <label  class="block text-sm font-medium text-gray-700">Adresse Postal</label>
                <span id="adresse-error" class="error text-indigo-500"></span>
                <input id='modal_form_adresse_postal' type="text" name="adresse_postal"  autocomplete="Adresse postal client" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-3">
                <label  class="block text-sm font-medium text-gray-700">Code Postal</label>
                <span id="code_postal-error" class="error text-indigo-500"></span>
                <input id='modal_form_code_postal' type="number" name="code_postal"  autocomplete="Code postal" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-3">
                <label  class="block text-sm font-medium text-gray-700">Ville</label>
        <span id="ville-error" class="error text-indigo-500"></span>
                <input id='modal_form_ville_client' type="text" name="ville" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Téléphone Fixe</label>
                <span id="tel-error" class="error text-indigo-500"></span>
                <input id='modal_form_telephone_fixe_client' type="text" name="telephone_fixe" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Téléphone Portable</label>
                <span id="telephone_portable-error" class="error text-indigo-500"></span>

                <input id='modal_form_telephone_portable_client' type="text" name="telephone_portable"  autocomplete="Téléphone Portable" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              <div class="col-span-6 sm:col-span-3 lg:col-span-6">
                <label  class="block text-sm font-medium text-gray-700">Informations Complémentaires</label>
                <span id="info_complementaire-error" class="error text-indigo-500"></span>

                <textarea id='modal_form_infos_complementaire' name="info_complementaire" rows="3" class="shadow-sm focus:ring-red-500 focus:border-red-500 mt-1 block w-full sm:text-sm border-gray-500 rounded-md" placeholder="Informations complémentaires"></textarea>
              </div>
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <input type="text" class="hidden" name='action' value='ajout'>
            <input type="text" class="hidden" name='categorie' value='clients'>
          </div>
        </div>
      </form>
