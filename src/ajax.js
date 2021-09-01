var adresse = 'http://localhost/testV4/src/fiche_client.php?client='
var ajax = 'controller/vrac.php'
// ******* Modal Start   *******
      function toggleModal(modalID){
        $('#'+modalID).toggleClass("hidden");
        $('#'+modalID + "_backdrop").toggleClass("hidden");
        $('#'+modalID).toggleClass("flex");
        $('#'+modalID + "_backdrop").toggleClass("flex");
      };
      
      function displayRecords(numRecords, pageNum ) {
        $.ajax({
            type: "POST",
            url: "./vrac.php",
            data: {action:'liste',categorie:'devis',show:numRecords,pageNum:pageNum},
            cache: false,
            beforeSend: function () { 
                $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" >');
            },
            success: function(html) {    
                $("#results").html( html );
                $('.loader').html('');
                console.log(html.ref)
            }
        });
    }

// tableau devis
var data=[];


// ******* Modal End     *******
$(document).ready(function(){


    // ecoute le document au niveau du dom si MAJ ('evenement''element id ou class''callback') 
//  ******************  Index ******************
    // ******* Menu Start *******
        $(document).on('click','.menu',function(){
            var page = $(this).data('menu')
            $('.page-content').load('views/'+page+'.php',function(){
                switch (page) {
                    case 'liste_client':
                        let action = 'liste'
                        let cat = 'clients'
                        $.ajax({
                            type: 'POST',
                            url: ajax,
                            data: {
                                action:action,
                                categorie:cat
                            },
                            datatype: 'html',
                            success: function(data){
                                // console.log(data)
                                // $('#client').html(data);
                            }
                        });
                        break;
                    case 'liste_devis':
                        displayRecords(10, 1);
                        break;
                    case 'devis':
                        data.splice(0,data.length);
                    default:
                        break;
                }

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
    $(document).on('click', '.displayRecords',function(){
        var pageNum = $(this).data('pagenum');
        var categorie =$(this).data('categorie');
        console.log(pageNum)
        $.ajax({
            type: "POST",
            url: ajax,
            data: {action:'liste',categorie:categorie,page:pageNum,pagination:'on'},
            dataType:'JSON',
            cache: false,
            beforeSend: function () { 
                $('.loader').html('<img src="src/Infinity-loading.gif" alt="" width="24" height="24" >');
            },
            success: function(data) { 
                if(data.html){
                    $("#client").html(data.html);
                }   
                if(data.pagination){
                    $("#pagination").html(data.pagination);
                }   
                $('.loader').html('');
            }
        })
    });
    // ******* Pagination tableau Client End   *******
    // ******* Barre de recherche *******
    $(document).on('keyup','#search',function(){
        $('#result_recherche').html('')
        var client = $(this).val()
        if(client != ''){
            $.ajax({
                type: 'POST',
                url: 'views/recherche_client.php',
                data: {action:'chercher',categorie:'clients',client:client},
                success:function(data){
                    if(data !=''){
                        $('#result_recherche').html(data);
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
            var idClient = $(this).data('id')
            var info_client = $(this).data('client')
            if(confirm('Êtes-vous sur de vouloir supprimer '+info_client+' ?')){
                $.ajax({
                    type: 'POST',
                    url: ajax,
                    data: {action:'Supprimer',categorie:'clients',client:idClient},
                    success: function(data){
                        console.log(data)
                        $('#'+idClient).remove();
                    }
                })
            }
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
            $('.page-content').load('views/info.php')
            console.log(idClient)
            $.ajax({
                type: 'POST',
                url: 'views/info_client.php',
                data: {action:'chercher',categorie:'clients',info_client:idClient},
                success:function(data){
                    // console.log(data);
                    $('#info_client').html(data);
                }
            });
            $.ajax({
                type: 'POST',
                url: 'views/info_devis_client.php',
                data:{action:'chercher',categorie:'devis',info_client:idClient},
                success: function(data){
                    console.log('ok info');
                    $('#client_devis').html(data);
                }
            });
        })
    // ******* Function Info End        *******
    // ******* Function Ajout Start     *******
        $(document).on('click','#ajout_client_btn',function(e){
        // $('#ajout_client_btn').submit(function(e){            
            e.preventDefault();
            $.ajax({
                url: ajax,
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
            window.open(adresse+client)
        });
        
        $(document).on('click','#fiche_client',function(){
            var client= $(this).data('client')
            window.open(adresse+client)
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
            var id_client = $(this).data('client_devis')
            // alert(id_client)
            // console.log(id_client);
            $.ajax({
                type: 'POST',
                url: 'views/devis_client.php',
                data:{info_client:id_client,categorie:'clients',action:'chercher'},
                success: function(data){
                    console.log(data)
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
                var ref_prix_commande = parseFloat($('#ref_prix_commande').val())
                $('#contenu_devis').append("<tr data-id_client='"+id_client+"'><td>"+id_article+"</td> <td>"+ref_designation+"</td><td class='text-indigo-600 font-bold'>"+ref_qte_commande+"</td><td class=' ref_prix_commande text-indigo-600 font-bold'>"+ref_prix_commande+"</td><td><button type='button' data-refcommande="+ref_prix_commande+"   class='bg-indigo-500 text-white w-16 rounded-md remove_row'>X</button></td></tr>")
                // $('#id_client').val(id_client)
                var total = parseFloat($('#total_commande').val())
                total += ref_prix_commande
                $('#total_commande').val(total.toFixed(2))
                console.log(total)
                var ligne ={id_article:id_article,qte:ref_qte_commande,ref_prix:ref_prix_commande};
                data.push(ligne)
                console.log(data)
             });
             // ******** Function Insert Tableau Devis Toiture End   *******
             // ******** Function Remove Ligne Tableau Devis Toiture Start   *******
             $(document).on('click','.remove_row',function(){
                var montant = $(this).data('refcommande')
                var total = parseFloat($('#total_commande').val())
                total -= montant
                // console.log('prix'+$(this).data('refcommande'))
                // console.log(typeof montant +' ref_commande')
                // console.log(typeof total +' '+total)
                $('#total_commande').val(total.toFixed(2))
                $(this).closest('tr').remove()
             });
             // ******** Function Remove Ligne Tableau Devis Toiture End     *******
             // ******** Function Select choix Tableau Devis Toiture Start  *******
             $(document).on('change','#select_ref',function(){
                var choix =$(this).val()
                var met_toiture= $('#metrage_toiture_M2').val()
                var met_toit = $('#metrage_toiture_Ml').val()
                if(met_toiture !='' || met_toit != '' && $.isNumeric(met_toit) || $.isNumeric(met_toiture)){
                    $('.error').remove();
                $.ajax({
                    type: 'POST',
                    url: ajax,
                    data:{action:'chercher',categorie:'devis',id_ref:choix},
                    datatype: 'JSON',
                    success: function(data){
                        data = jQuery.parseJSON(data)
                        console.log(data)
                        for(var prop in data.ref){
                            $('#ref_'+prop).val(data.ref[prop]);
                        }
                        // quantite_m2*met_toiture/qte_fournisseur
                        var mapObj={
                            'quantite_m2':data.ref['quantite_m2'],
                            'met_toiture':met_toiture,
                            'met_toit':met_toit,
                            'qte_fournisseur':data.ref['qte']
                        }
                        var test = data.ref['calcul_qte']
                        if(test !=''){
                        console.log(test)
                        test =data.ref['calcul_qte'].replace(/quantite_m2|met_toiture|met_toit|qte_fournisseur/gi,function(matched){return mapObj[matched]})
                        result = math.evaluate(test)
                        console.log('test de la fonction :'+result)
                        var quantite_commande = Math.ceil(result)
                        var prix_commande =( result * data.ref['prix_fournisseur']).toFixed(2)
                        console.log(data.ref['quantite_m2'])
                        console.log(data.ref['prix_fournisseur'])
                        console.log(quantite_commande)
                        $('#ref_qte_commande').val(quantite_commande)
                        $('#ref_prix_commande').val(prix_commande)
                        }else{
                            var quantite_commande=1;
                            var prix_commande=0
                            $('#ref_qte_commande').val(quantite_commande)
                            $('#ref_prix_commande').val(prix_commande)    
                        }
                    }
                })
            }else{
                $('.error_metrage').text('Veuillez mettre un metrage')
            }
             });
             // ******** Function Select choix Tableau Devis Toiture End    *******
             // ******** Function Validation Tableau Devis Toiture Start    *******
             $(document).on('click','#valide_devis_btn',function(){
                var tab = $(this).data('client')
                console.log(tab)
             });
             // ******** Function Validation Tableau Devis Toiture End      *******
             // ******** Function Pagination Liste Devis Start    *******

             // ******** Function Pagination Liste Devis End      *******

             // ******** Function Details Info Devis Start    *******
             $(document).on('click','.details_info',function(){
                var devis_num= $(this).data('id_devis');
                var client_num = $(this).data('id_client');
                $.ajax({
                    type: 'POST',
                    url:'views/details_devis.php',
                    data:{action:'details',categorie:'devis',devis_num:devis_num},
                    success: function(data){
                        $('.page-content').html(data)
                    }
                });
             });
             // ******** Function Details Info Devis End      *******
                 // ******* Barre de recherche *******
    $(document).on('keyup','#search_devis',function(){
        $('#result_recherche').html('')
        var client = $(this).val()
        if(client != ''){
            $.ajax({
                type: 'POST',
                url: 'views/recherche_client_devis.php',
                data: {action:'chercher',categorie:'clients',client:client},
                success:function(data){
                    if(data !=''){
                        $('#result_recherche_devis').html(data);
                    }else{
                        $('#result_recherche_devis').innerHTML += "<div class='text-red-600 text-center font-medium mt-10'> Aucun Client ne correspondant a votre recherche </div> "
                    }
                }
            })
        }
    });
    // ******* Barre de recherche END   *******
    
//  ************************************  References ************************************
            //  Modal modification

})