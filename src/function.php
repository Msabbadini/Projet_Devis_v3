<?php

function VerifEmpty($var){
  if($var != ''){
     return $var;
  }else{
    return ' Aucun Renseignement';
  }
}

function verifClientNom($nom){
    include('./src/connexion.php');

    if($nom != " "){
        // $req =$db->select('SELECT count(*) as numberNomClient FROm clients WHERE nom_client=?',$nom);
        $req=$db->prepare('SELECT count(*) as numberNomClient FROm clients WHERE nom_client=?');
        $req->execute(array($nom));
        $nbNom=0;
        while($nom_verif=$req->fetch()){
            $nbNom=$nom_verif['numberNomClient'];
        }
        return $nom=$nbNom;

    }
}

function verifClientPrenom($prenom){
    include('./src/connexion.php');


    // $req2=$db->select('SELECT count(*) as numberNomClient FROm clients WHERE prenom_client=?',$prenom);
    if($prenom != ''){
        $req2=$db->prepare('SELECT count(*) as numberPrenomClient FROM clients WHERE prenom_client=?');
        $req2->execute(array($prenom));
        $nbPrenom=0;
        while($prenom_verif=$req2->fetch()){
            $nbPrenom=$prenom_verif['numberPrenomClient'];
        }

        return $prenom=$nbPrenom;
    }

}

function requestDb($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info){
    include('./src/connexion.php');

    // $req = $db->insert('INSERT INTO clients(civilite_client,nom_client,prenom_client,adresse_postal,code_postal,ville_client,email_client,telephone_fixe_client,telephone_portable_client,infos_complementaire) VALUES (?,?,?,?,?,?,?,?,?,?)',$data =[$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);
	$req=$db->prepare('INSERT INTO clients(civilite_client,nom_client,prenom_client,adresse_postal,code_postal,ville_client,email_client,telephone_fixe_client,telephone_portable_client,infos_complementaire) VALUES (?,?,?,?,?,?,?,?,?,?)');
	$req->execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);
}

function updateClient($genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info,$id){
  include('./src/connexion.php');

  $sql='UPDATE clients SET civilite_client=?,nom_client=?,prenom_client=?,adresse_postal=?,code_postal=?,ville_client=?,email_client=?,telephone_fixe_client=?,telephone_portable_client=?,infos_complementaire=? WHERE id_client= '.$id.'';
  $req=$db->prepare($sql);
  $req->execute([$genre,$nom,$prenom,$adresse,$code_postal,$ville,$mail,$telFixe,$telPortalble,$info]);

}

function requestClient(){
    include('./src/connexion.php');

//   $req= $db->select('SELECT * FROM clients ORDER BY date_creation',null);
    $req=$db->prepare('SELECT * FROM clients ORDER BY date_creation ');
    $req->execute();
    $result =$req->fetchAll();
    foreach($result as $r){
        ?>
        <tr id='<?= $r['id_client'] ?>'>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
        <div class="flex items-center">
            <div>
                <div class="text-sm leading-5 text-gray-800"><?= $r['id_client'] ?></div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
        <div data-client='<?= $r['nom_client']." ".$r['prenom_client'] ?>' class="text-sm leading-5 text-blue-900"><?= $r['civilite_client'].' '.$r['nom_client'].' '.$r['prenom_client'] ?></div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?= $r['email_client']; ?></td>
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"><?=$r['telephone_fixe_client'].' / '.$r['telephone_portable_client']; ?></td>
    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
        <span id='fiche_client' class="relative text-xs">Impression</span>
    </span>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?= $r['date_creation'] ;?></td>
    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
        <button data-id='<?= $r['id_client'] ;?>' class="info px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-indigo-700 hover:text-white focus:outline-none">Fiche Client</button>
        <button class="update px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-green-500 hover:text-white focus:outline-none ease-liner " data-modal='modal_id' data-id='<?= $r['id_client']; ?>' type='button' >Modification</button>
        <button id='<?= $r['id_client'];?>' class="delete px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-red-600 hover:text-white focus:outline-none">Suppression</button>
    </td>
    </tr>
        <?php
    } 
}



function modificationClient(){
// $req=$db->prepare('SELECT * FROM clients WHERE id_client= ?');
// $req->execute($id_client);
// $req->FetchAll
?>
<div class="mt-5 md:mt-0 md:col-span-2">
    <form id='ajout_client'>
      <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-gray-200 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-3">
              <label class="block text-sm font-medium text-gray-700">Civilité</label>
              <span id="genre-error" class="error text-indigo-500"></span>

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

      </div>
    </form>
  </div>
<?php
}
?>