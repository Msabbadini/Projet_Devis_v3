
<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Ajout Client</h3>
        <p class="mt-1 text-sm text-gray-600">
          Veuillez indiquer les diverses informations pour l'ajout du client dans la base de données.
        </p>
        <div id="msg"></div>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form id='ajout_client'>
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-gray-200 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Civilité</label>
                <span id="genre-error" class="error text-indigo-500"></span>

                <select  name="genre" autocomplete="civilité" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
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
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Ajouter
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<script>

$(document).ready(function () {
                
$("form").submit(function(e){
		e.preventDefault();
    	$.ajax({
			url: "ajax.php", // script à solliciter pour le traitement du formulaire
			data: $("form").serialize(), // renvoi toutes les données du formulaire
			type: "POST", // type de requête. On utilise le POST car + sécurisé
			dataType: "JSON", // format des données qu'on va récupérer grâce à la requête ajax
			success: function(data){ // fonction de callback en cas de succès de la requête ajax
                console.log(data);
                $(".error").html(''); //on vide tous les span ayant la class error au cas où il y avait des messages d'erreurs lors d'une requête précédente
				if(data.status === "error"){ //notre objet json contient une variable status qu'on a définit dans notre script et on vérifie si sa valeur est à "error", si c'est le cas on sait qu'il y a une ou plusieurs erreurs
					if(data.error){ // on vérifie qu'on trouve bien les messages d'erreurs pour pouvoir les parcourir
						for(var prop in data.error){ //on parcours tous les messages d'erreurs
							$("#"+prop+"-error").html(data.error[prop]); // on injecte nos messages d'erreur dans nos span prévus à cet effet (#prenom-error, #age-error, #option-error)
						}
					}
				}
				$("#msg").html(data.msg); // on injecte notre message dans la div #msg
				// if(data.status === 'ok'){
				// 	$('form').fadeOut();
                document.getElementById("ajout_client").reset();
					
				// }
			}
		}).fail(function(xhr){
			alert("une erreur est survenue "+xhr);
            console.log(xhr);
		});
    });
	

	
});
</script>