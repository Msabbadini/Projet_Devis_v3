<div class="flex  justify-center w-full">
<div id="msg"></div>
<form id='ajout_client'>
    <div >
        <label class='mr-4 bg-red-400 rounded'>Civilité</label>
        <select name="genre" id="">
            <option value="Monsieur">Monsieur</option>
            <option value="Madame">Madame</option>
        </select>
    <span id="genre-error" class="error"></span>

    </div>
    <div>
        <label for="">Nom client</label>
        <input type="text" name='nom' value=''>
        <span id="nom-error" class="error"></span>
    </div>
    <div>
        <label for="">Prenom client</label>
        <input type="text" name='prenom'>
        <span id="prenom-error" class="error"></span>
    </div>
    <div>
        <label for="">Adresse Postal</label>
        <input type="text" name='adresse_postal'>
        <span id="adresse-error" class="error"></span>
    </div>
    <div>
        <label for="">Code Postal</label>
        <input type="number" name='code_postal'>
        <span id="code_postal-error" class="error"></span>
    </div>
    <div>
        <label for="">Ville</label>
        <input type="text" name='ville'>
        <span id="ville-error" class="error"></span>
    </div>
    <div>
        <label for="">Adresse Mail</label>
        <input type="mail" name='email'>
        <span id="email-error" class="error"></span>
        <small>Format: adressemail@email.fr</small>
    </div>
    <div>
        <label for="">Téléphone fixe</label>
        <input type="tel" name="telephone_fixe">
        <span id="tel-error" class="error"></span>
        <small>Format: 00-00-00-00-00</small>
    </div>
    <div>
        <label for="">Téléphone Portable</label>
        <input type="tel" name="telephone_portable" id="" >
        <span id="telephone_portable-error" class="error"></span>
        <small>Format: 00-00-00-00-00</small>
    </div>
    <div>
        <legend>Informations Complémentaires</legend>
        <textarea name="info_complementaire" id="" cols="30" rows="10"></textarea>
        <span id="info_complementaire-error" class="error"></span>
    </div>
    <input type="submit" id='ajout_client' value="Envoyer">
    </form>
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