<?php
include '../src/connexion.php';
if(isset($_POST['clientId'])){
    $id = htmlspecialchars($_POST['clientId']);
}
$req=$db->prepare('SELECT * FROM clients WHERE id_client= ?');
$req->execute([$id]);
$req->setFetchMode(PDO::FETCH_ASSOC);
$data = $req->Fetch();
$genre= $data['civilite_client'];
$nom_client= $data['nom_client'];
$prenom_client = $data['prenom_client'];
$ville_client = $data['ville_client'];
$email_client = $data['email_client'];
$tel_fixe_client = $data['telephone_fixe_client'];
$tel_portable_client = $data['telephone_portable_client'];
$infos_complementaires = $data['infos_complementaire'];
$adresse_client = $data['adresse_postal'];
$zip_client = $data['code_postal'];

if(isset($_POST['submit'])){
  $id=htmlspecialchars($_POST['id']);
$nom=htmlspecialchars($_POST['nom']);
$prenom=htmlspecialchars($_POST['prenom']);
$genre=htmlspecialchars($_POST['genre']);
$mail=htmlspecialchars($_POST['email']);
$info=htmlspecialchars($_POST['info_complementaire']);
$telPortalble=htmlspecialchars($_POST['telephone_portable']);
$telFixe=htmlspecialchars($_POST['telephone_fixe']);
$adresse=htmlspecialchars($_POST['adresse_postal']);
$code_postal=htmlspecialchars($_POST['code_postal']);
$ville=htmlspecialchars($_POST['ville']);
$verifClientNom=verifClientNom($nom);
$verifClientPrenom=verifClientPrenom($prenom);

if($verifClientNom==0 && $verifClientPrenom==0){
  updateClient($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id);
}
else if($verifClientNom==0 && $verifClientPrenom==1){
  updateClient($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id);

}
else if($verifClientNom!=0 && $verifClientPrenom==0){
  updateClient($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id);
};
}



{ ?>
      <div  class="mt-5 md:mt-0 md:col-span-2 " >
    
 
<form>
      <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-gray-200 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">Numéro Client</label>
            <input type="text" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?= $id ?>' readonly>
          </div>
          <div class='col-span-4'></div>
          <div class="col-span-6 sm:col-span-3">
              <label class="block text-sm font-medium text-gray-700">Civilité</label>
              <span id="genre-error" class="error text-indigo-500"></span>

              <select  name="genre" autocomplete="civilité" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Choisir Civilité</option>
                <option value="Monsieur" <?php if( $genre =="Monsieur") echo"selected";?> >Monsieur</option>
                <option value='Madame' <?php if( $genre =="Madame") echo"selected";?>>Madame</option>

              </select>
            </div>
            <div class="col-span-6"></div>
            <div class="col-span-6 sm:col-span-3">
              <label class="block text-sm font-medium text-gray-700">Nom Client</label>
              <span id="nom-error" class="error text-indigo-500"></span>
              <input type="text" name="nom"  autocomplete="Nom du client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?=$nom_client?>'>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="last_name" class="block text-sm font-medium text-gray-700">Prenom client</label>
              <span id="prenom-error" class="error text-indigo-500"></span>
              <input type="text" name="prenom" autocomplete="Prénom du client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?=$prenom_client ?>'>
            </div>

            <div class="col-span-6 sm:col-span-4">
              <label  class="block text-sm font-medium text-gray-700">Adresse Email</label>
              <span id="email-error" class="error text-indigo-500"></span>
              <input type="mail" name="email"  autocomplete="email client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?= $email_client ?>'>
            </div>

            <div class="col-span-6">
              <label  class="block text-sm font-medium text-gray-700">Adresse Postal</label>
              <span id="adresse-error" class="error text-indigo-500"></span>
              <input type="text" name="adresse_postal"  autocomplete="Adresse postal client" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?= $adresse_client ?>'>
            </div>

            <div class="col-span-3">
              <label  class="block text-sm font-medium text-gray-700">Code Postal</label>
              <span id="code_postal-error" class="error text-indigo-500"></span>
              <input type="number" name="code_postal"  autocomplete="Code postal" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?= $zip_client ?>'>
            </div>

            <div class="col-span-3">
              <label  class="block text-sm font-medium text-gray-700">Ville</label>
                <span id="ville-error" class="error text-indigo-500"></span>
              <input type="text" name="ville" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?= $ville_client ?>'>
            </div>

            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
              <label class="block text-sm font-medium text-gray-700">Téléphone Fixe</label>
              <span id="tel-error" class="error text-indigo-500"></span>
              <input type="text" name="telephone_fixe" class="mt-1 pl-2 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?= $tel_fixe_client?>'>
            </div>

            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
              <label for="postal_code" class="block text-sm font-medium text-gray-700">Téléphone Portable</label>
              <span id="telephone_portable-error" class="error text-indigo-500"></span>

              <input type="text" name="telephone_portable"  autocomplete="Téléphone Portable" class="mt-1 pl-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value='<?= $tel_portable_client ?>'>
            </div>
            <div class="col-span-6 sm:col-span-3 lg:col-span-6">
              <label  class="block text-sm font-medium text-gray-700">Informations Complémentaires</label>
              <span id="info_complementaire-error" class="error text-indigo-500"></span>

              <textarea  name="info_complementaire" rows="3" class="shadow-sm pl-2 focus:ring-red-500 focus:border-red-500 mt-1 block w-full sm:text-sm border-gray-500 rounded-md" placeholder="Informations complémentaires"><?= $infos_complementaires ?></textarea>
            </div>
          </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <input type="submit" name='submit' id='modif_client' class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" value='Modifier'>
          </div>
      </div>
    </form>
</div>
<?php }

?>
