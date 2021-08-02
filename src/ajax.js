
// ******* Modal Start   *******
      function toggleModal(modalID){
        $('#'+modalID).toggleClass("hidden");
        $('#'+modalID + "_backdrop").toggleClass("hidden");
        $('#'+modalID).toggleClass("flex");
        $('#'+modalID + "_backdrop").toggleClass("flex");
      };
      

// ******* Modal End     *******
$(document).ready(function(){
    // ecoute le document au niveau du dom si MAJ ('evenement''element id ou class''callback') 
//  ******************  Index ******************
    // ******* Menu Start *******
        $(document).on('click','.menu',function(){
            var page = $(this).data('menu')
            $('.page-content').load(page+'.php',function(){
                if(page =='liste_client'){
                    let action = 'liste'
                    let cat = 'clients'
                    $.ajax({
                        type: 'POST',
                        url: './vrac.php',
                        data: {
                            action:action,
                            categorie:cat
                        },
                        datatype: 'html',
                        success: function(data){
                            console.log(data)
                            $('#client').html(data);
                        }
                    })
                }
                // elseif(page =='liste_devis'){
                //     let action ='liste'
                //     let cat = 'devis'

                //     $.ajax({
                //         type: 'POST',
                //         url: 
                //     })
                // }
            });   
        });
    // ******* Menu End   *******
    // ******* Modal Close Start Test     *******
    $(document).on('click', '.close', function(){
            var id= $(this).data('modal');
            toggleModal(id);
       });
//  ******************  Client ******************
    // ******* Pagination tableau CLient Start *******
 
    // ******* Pagination tableau Client End   *******
    // ******* Barre de recherche *******
    $(document).on('keyup','#search',function(){
        $('#result_recherche').html('')

        var client = $(this).val()
        if(client != ''){
            $.ajax({
                type: 'GET',
                url: 'fonctions/recherche_client.php',
                data: 'client='+encodeURIComponent(client),
                success:function(data){
                    if(data !=''){
                        $('#result_recherche').append(data)
                        console.log(client)
                    }else{
                        $('#result_recherche').innerHTML += "<div class='text-red-600 text-center font-medium mt-10'> Aucun Client ne correspondant a votre recherche </div> "
                    }
                }
            })
        }
    });
    // ******* Barre de recherche END   *******
    // ******* Function Delete Start    *******
        $(document).on('click','.delete',function(){
            var idClient = $(this).attr('id')
            var info_client = $(this).data('client')
            $.ajax({
                type: 'POST',
                url: './vrac.php',
                data: {clientId:idClient,action:'supprimer',categorie:'clients'},
                success: function(data){
                    if(confirm('Êtes-vous sur de vouloir supprimer '+info_client+' ?')){
                        $('#'+idClient).remove();
                    }
                }
            })
        });
    // ******* Function Delete End      *******
    // ******* Function Update Start    *******
        $(document).on('click','.update',function(){
            var idClient= $(this).data('id'),
                id = $(this).data("modal");
            $.ajax({
                type: 'POST',
                url: 'fonctions/modif.php',
                data: {clientId:idClient},
                success: function(data){
                    $('#modal_content').html(data);
                    toggleModal(id);
                }
            })
        });
    // ******* Function Update End      *******
    // ******* Function Info Start      *******
        $(document).on('click','.info',function(){
            var idClient = $(this).data('id')
            $.ajax({
                type: 'POST',
                url: './vrac.php',
                data: {clientId:idClient,action:'listeClient',categorie:'clients'},
                success:function(data){
                $('#client').html(data.devis),
                $('#info_client').html(data.client)
                }
            })
        })
    // ******* Function Info End        *******
    // ******* Function Ajout Start     *******
        $(document).on('click','#ajout_client_btn',function(e){
        // $('#ajout_client_btn').submit(function(e){            
            e.preventDefault();
            $.ajax({
                url: "./vrac.php",
                data: $('#ajout_client').serialize(),
                type: 'POST',
                datatype: 'JSON',
                success: function(data){
                    $('.error').html('')
                 data = jQuery.parseJSON(data)
                console.log(data)
                if(data.status === 'error'){
                    console.log('ok')
                    if(data.error){
                        for(var prop in data.error){
                            $('#'+prop+'-error').html(data.error[prop]);
                        }
                    }
                }
                    $('#html').html(data.msg);
                    console.log(data.status)
                    // if(data.status === 'ok'){
                    //     $('#ajout_client').reset()
                    // }
                },
                complete: function(){
                    console.log('c\'est fini')
                    $('form')[0].reset()
                }
                // .fail(function(xhr){
                    //     alert('une erreur est survenue '+xhr);
                    //     console.log(xhr)
                    // });
                });
            });
    // ******* Function Ajout End            *******
    // ******* Function Modifier Start       *******
    
    // ******* Function Modifier End         *******
    // ******* Function Impression Fiche Client Start       *******
        $(document).on('click','.print_client',function(){
            var client = $(this).data('id_client')
            window.open('http://localhost/testV4/src/fiche_client.php?client='+client)
        });
        $(document).on('click','#fiche_client',function(){
            var client= $(this).data('client')
            window.open('http://localhost/testV4/src/fiche_client.php?client='+client)

        });
    // ******* Function Impression Fiche Client End         *******
    // ******* Function Impression Fiche Devis Start       *******
        $(document).on('click','.print',function(){
            var info= $(this).data('id')+'-'+$(this).data('id_devis')
            window.open('http://localhost/testV4/src/edition.php?info='+info)
        });
    // ******* Function Impression Fiche Devis End         *******
//  ***************************************************  Devis ***************************************************
        // ******** Function Recherche Client Devis Toiture *******
        // """[Recherche Client Devis Toiture]

        // Arguments:
        //     Keyup ([evenement]): Pour chaque touche taper dans la zone prédéfini
        //     '#search_devis_client' (id input): On indique le lieu ou il y aura l'évènement Keyup
    
        // Détails:
        //     TypeError: [description]
    
        // Retours:
        //     [type]: [description]
        // // 
        $(document).on('keyup','#search_devis_client',function(){
            $('#result_recherche_devis').html('')
    
            var client = $(this).val()
            if(client != ''){
                $.ajax({
                    type: 'GET',
                    url: 'fonctions/recherche_client_devis.php',
                    data: 'client='+encodeURIComponent(client),
                    success:function(data){
                        if(data !=''){
                            $('#result_recherche_devis').append(data)
                            console.log(client)
                        }else{
                            $('#result_recherche_devis').innerHTML += "<div class='text-red-600 text-center font-medium mt-10'> Aucun Client ne correspondant a votre recherche </div> "
                        }
                    }
                })
            }
        });
     // ******** Function Insert Client Devis Toiture *******
        // """[Insert Client Devis Toiture]

        // Arguments:
        //     click ([evenement]): Pour chaque click dans la zone prédéfini
        //     '.result_client' (class div): On indique que sur les id avec cette class on peut récuperer la valeur du data défini dans notre div
                
    
        // Détails:
        //     TypeError: [description]
    
        // Retours:
        //     [type]: [description]
        // 
        $(document).on('click','.result_client',function(){
            var id_client = $(this).data('client')
            $.ajax({
                type: 'POST',
                url: 'fonctions/devis_client.php',
                data:{id_client:id_client},
                success: function(data){
                    $('#result_search').html(data)
                    $('#result_recherche_devis').html('')
                }
            });
        });

//  ************************************  Devis ************************************
             // ******** Function Insert Tableau Devis Toiture Start *******
                   // """[Insert Client Devis Toiture]

        // Arguments:
        //     click ([evenement]): Pour chaque click dans la zone prédéfini
        //     '#ajout_devis' (class div): on indique sur quelle élément avec cette id on doit faire l'évènement
        //      data:
        //          info-> Récupération de la désignation de référence 
        //          quantite-> récupération de la quantite
        //          mesure-> recuperation de l'unite de mesure lié a la référence
        //          puht-> recuperation du prix ht
                
    
        // Détails:
        //     TypeError: [description]
    
        // Retours:
        //     [type]: [description]
             $(document).on('click','#ajout_ref_btn',function(){
                var id_client = $(this).data('client_id')
                var id_article = $('#ref_id_ref').val()
                var ref_qte_commande = $('#ref_qte_commande').val()
                var ref_designation = $('#ref_designation').val()
                var ref_prix_commande = $('#ref_prix_commande').val()
                $('#contenu_devis').append("<tr data-id_client='"+id_client+"'><td>"+id_article+"</td> <td>"+ref_designation+"</td><td class='text-indigo-600 font-bold'>"+ref_qte_commande+"</td><td class='text-indigo-600 font-bold'>"+ref_prix_commande+"</td><td><button type='button' id='remove_row' class='bg-indigo-500 text-white w-16 rounded-md'>X</button></td></tr>")
                // $('#id_client').val(id_client)
             });
             // ******** Function Insert Tableau Devis Toiture End   *******
             // ******** Function Remove Ligne Tableau Devis Toiture Start   *******
             $(document).on('click','#remove_row',function(){
                $(this).closest('tr').remove()
             });
             // ******** Function Remove Ligne Tableau Devis Toiture End     *******
             // ******** Function Select Tableau Devis Toiture Start  *******
             $(document).on('click','#select_ref',function(){
                 $('#select_ref').prop('selectIndex',0)
                $.ajax({
                    type: 'POST',
                    url: './vrac.php',
                    data: {action:'liste',categorie:'devis',select:'all'},
                    success: function(data){
                        // console.log(data)
                        $('#select_ref').html(data)
                    }
                });
             });
             // ******** Function Select Tableau Devis Toiture End  *******
             // ******** Function Select choix Tableau Devis Toiture Start  *******
             $(document).on('change','#select_ref',function(){
                var choix =$(this).val()
                var met_toiture= $('#metrage_toiture').val()
                $.ajax({
                    type: 'POST',
                    url: './vrac.php',
                    data:{action:'chercher',categorie:'devis',id_ref:choix},
                    datatype: 'JSON',
                    success: function(data){
                        data = jQuery.parseJSON(data)
                        console.log(data)
                        for(var prop in data.ref){
                            $('#ref_'+prop).val(data.ref[prop]);
                        }
                        // voir pour un switch case avec les ids ou faire une colonne dans BDD pour différencier
                        var quantite_commande = parseInt(data.ref['quantite_m2'])*met_toiture/data.ref['qte']
                        var quantite_commande = Math.round(quantite_commande)
                        var prix_commande = quantite_commande * data.ref['prix_fournisseur']
                        console.log(data.ref['quantite_m2'])
                        console.log(data.ref['prix_fournisseur'])
                        console.log(quantite_commande)
                        $('#ref_qte_commande').val(quantite_commande)
                        $('#ref_prix_commande').val(prix_commande)
                    }
                })
             });
             // ******** Function Select choix Tableau Devis Toiture End    *******
             


})