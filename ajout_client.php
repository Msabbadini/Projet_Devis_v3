
<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Ajout Client</h3>
        <p class="mt-1 text-sm text-gray-600">
          Veuillez indiquer les diverses informations pour l'ajout du client dans la base de données.
        </p>
        <div id="html"></div>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
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
              <div class="col-span-6 sm:col-span-3 lg:col-span-6">
                <label  class="block text-sm font-medium text-gray-700">Informations Complémentaires</label>
                <span id="info_complementaire-error" class="error text-indigo-500"></span>

                <textarea  name="info_complementaire" rows="3" class="shadow-sm focus:ring-red-500 focus:border-red-500 mt-1 block w-full sm:text-sm border-gray-500 rounded-md" placeholder="Informations complémentaires"></textarea>
              </div>
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <input type="text" class="hidden" name='action' value='ajout'>
            <input type="text" class="hidden" name='categorie' value='clients'>
            <button type="submit" id='ajout_client_btn' class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Ajouter
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


