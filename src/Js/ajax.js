
var adresse = 'http://localhost/testV4/src/fiche_client.php?client=';
var ajax = 'controller/vrac.php';
var securite = 'controller/securite.php';
var modal_id= 'modal_id';
// var token = $("#OwlToken").val(newToken);

    function displayRecords(pageNum,categorie ) {
        $('.loader').html('<img src="src/Infinity-loading.gif" alt="" width="24" height="24" >');
            $.ajax({
                type: "POST",
                url: ajax,
                data: {action:'liste',categorie:categorie,page:pageNum,pagination:'on'},
                dataType:'JSON',
                cache: false,
                success: function(data) { 
                    console.log(data)
                    if(data[0].html){
                        $("#resultats").html(data[0].html);
                    }   
                    if(data[0].pagination){
                        $("#pagination").html(data[0].pagination);
                    }   
                    $('.loader').html('');
                    RefreshToken(data.token);
                }
            });  
    }
    function toggleModal(modalID){
        $('#'+modalID).toggleClass("hidden");
        $('#'+modalID + "_backdrop").toggleClass("hidden");
        $('#'+modalID).toggleClass("flex");
        $('#'+modalID + "_backdrop").toggleClass("flex");
      };

function ajoutElem(tab,elem){
    [].push.call(tab,elem)
}
function RefreshToken(newToken){
    if(newToken && typeof newToken !='undefined'){
        $("#OwlToken").val(newToken);
    }
}
// tableau devis ( voir pour le faire en objet)
var data=[];


// ******* Modal End     *******
$(document).ready(function(){
    // setup du token pour les requetes ajax
    $.ajaxPrefilter(function (options, originalOptions, jqXHR){
        var token = $("#OwlToken").val();
        jqXHR.setRequestHeader('JWT-Token', token);
    });
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
                            dataType: 'JSON',
                            success: function(data){
                                RefreshToken(data.token);
                                console.log(data);
                            }
                        });
                        break;
                    case 'liste_devis':
                        // displayRecords(10, 1);

                        break;
                    case 'devis':
                        // data.splice(0,data.length);
                        data=[];
                    default:
                        break;
                }
            });   
        });
    // ******* Menu End   *******

//  ******************  Client ******************
    // ******* Pagination tableau CLient Start *******
    $(document).on('click', '.displayRecords',function(){
        var pageNum = $(this).data('pagenum');
        var categorie =$(this).data('categorie');
        console.log(pageNum);
        displayRecords(pageNum,categorie );  

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
                    console.log(data)
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
                    dataType:'JSON',
                    success: function(data){
                        console.log(data)
                        $('#'+idClient).remove();
                        RefreshToken(data.token);
                    }
                })
            }
        });
    // ******* Function Delete End      *******
    // ******* Function Update Start    *******
        $(document).on('click','.update',function(){

            var id= $(this).data('id'),
                categorie=$(this).data('categorie');
                $('#update_client').attr('data-id_client',id);
                $('#status').html('');     
                $.ajax({
                    type: 'POST',
                    url: ajax,
                    data: {info_client:id,action:'chercher',categorie:categorie},
                    dataType:'JSON',
                    success: function(data){
                        if(typeof data[0] === 'object'){
                            for(var prop in data[0]){
                                    // prop c'est la key des données et data(prop) c'est la valeur associée
                                    $('input[id=modal_form_'+prop+'],textarea[id=modal_form_'+prop+']').val(data[0][prop]);
                                    $('select[id=modal_form_'+prop+'] option[value="'+data[0][prop]+'"]').attr('selected', true)
                                }                
                                console.log(data);
                                toggleModal(modal_id);
                                RefreshToken(data.token);
                            }
                }
            });
        });
    // ******* Function Update End      *******
    // ******* Function Update données Start    *******
    $(document).on('click','#modif',function(){
        $('#status').html('');
        $.ajax({
            type:'POST',
            url: ajax,
            data:$('#update_client').serialize(),
            dataType:'JSON',
            success:function(data){
                $('.error').html('');
               console.log(data)
               if(data[0].status === 'error'){
                   console.log('ok');
                   if(data[0].error){
                       for(var prop in data[0].error){
                           $('#'+prop+'-error').html(data[0].error[prop]);
                       }
                   }
                }
                $('#status').html(data[0].msg);
                console.log(data[0].status);
                RefreshToken(data.token);
        }
        });
    });
    // ******* Function Update données End      *******

    // ******* Function Close modal Start      *******
    $(document).on('click', '.close', function(){
        var id= $(this).data('modal');
        toggleModal(id);
    });
    // ******* Function Close modal End      *******
    
    // ******* Function Info Start      *******
        $(document).on('click','.info',function(){
            var idClient = $(this).data('id');
            $.ajax({
                type:'GET',
                url:'views/info.php',
                success:function(data){
                    $('.page-content').html(data);
                    $.ajax({
                        type: 'POST',
                        url: 'views/info_client.php',
                        data: {action:'chercher',categorie:'clients',info_client_2:idClient},
                        success:function(data){
                            // console.log(data);
                            $('#info_client').html(data);
                            RefreshToken(data.token);
                            $.ajax({
                                type: 'POST',
                                url: 'views/info_devis_client.php',
                                data:{action:'chercher',categorie:'devis',info_client:idClient},
                                success: function(data){
                                    console.log('ok info');
                                    $('#client_devis').html(data);
                                }
                            });
                        }
                    });
                }
            })
            console.log(idClient);

        })
    // ******* Function Info End        *******
    // ******* Function Ajout Start     *******
        $(document).on('click','#ajout_client_btn',function(e){
            e.preventDefault();
            $.ajax({
                url: ajax,
                data: $('#ajout_client').serialize(),
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    $('.error').html('')
                //  data = jQuery.parseJSON(data)
                console.log(data)
                if(data[0].status === 'error'){
                    console.log('ok');
                    if(data[0].error){
                        for(var prop in data[0].error){
                            $('#'+prop+'-error').html(data[0].error[prop]);
                        }
                    }
                }
                    $('#html').html(data[0].msg);
                    console.log(data[0].status)
                    RefreshToken(data.token);
                },
                complete: function(){
                    console.log('c\'est fini')
                    $('form')[0].reset()
                }
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

        $(document).on('change','.statut_devis',function(){
            var element =$(this);
            var devis_num = element.data('id');
            var statut = element.val();
            $.ajax({
                type:'POST',
                url:ajax,
                data:{devis_num:devis_num,statut:statut,action:'modification_statut',categorie:'devis'},
                dataType:'JSON',
                success:function(data){
                    // data=data[0];
                    if(data.token){
                        RefreshToken(data.token);
                    }
                    if(data[0].statut ){
                        if(data[0].type =='Facture'){
                            var statut_html ='';
                        }else{
                            var statut_html=data[0].html;
                        }
                        $('#type_devis-'+devis_num).html(data[0].type);
                        $('#statut_devis_actuel-'+devis_num).html(statut_html);
                    }else{
                        alert('Une erreur est survenue');
                    }
                }
            });
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
            $('#id_client').val(id_client)
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
                // var id_client = $(this).data('client_id')
                var id_article = $('#ref_id_ref').val()
                var ref_qte_commande = $('#ref_qte_commande').val()
                var ref_designation = $('#ref_designation').val()
                var ref_prix_commande = parseFloat($('#ref_prix_commande').val())
                $('<tr class="article_fixe"/>').loadTemplate($("#template_tab"), {
                    id_article: id_article,
                    ref_designation: ref_designation,
                    ref_qte:ref_qte_commande,
                    ref_prix:ref_prix_commande,
                    ref_commande:ref_prix_commande
                }).appendTo($("#contenu_devis"));

                var total = parseFloat($('#total_commande').val())
                total += ref_prix_commande
                $('#total_commande').val(total.toFixed(2))
                // console.log(total)
                var ligne ={id_article:id_article,qte:ref_qte_commande,ref_prix:ref_prix_commande};
                // //data.push(ligne)
                data[id_article]=ligne;
                console.log(data);
             });
             // ******** Function Insert Tableau Devis Toiture End   *******
             // ******** Function Remove Ligne Tableau Devis Toiture Start   *******
             $(document).on('click','.remove_row',function(){
                var montant = $(this).data('refcommande');
                var total = parseFloat($('#total_commande').val());
                // Permet de recup l'id de l'article
                var index=$(this).data('id_article');
                data.splice(index,1);  
                total -= montant
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
                    dataType: 'JSON',
                    success: function(data){
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
                        console.log('test replace '+test);
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
                var tot = $('#total_commande').val();
                var client =$('#id_client').val();
                $.ajax({
                    type : 'POST',
                    url: 'controller/vrac.php',
                    data:{action:'ajout',categorie:'devis',details:data,montant:tot,client:client},
                    success: function(data){
                        console.log(data)
                    }
                });
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
                        $(this).data('id_client',client_num);
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
    // Modification devis Start
    // cette ligne permet d'éxécuter une seule fois le trigger
    $(document).on('click','.update_devis',function(){
        var id =$(this).data('modal'); 
        var devis = $(this).data('id')
        $.ajax({
            type: 'POST',
            url: 'views/modification_devis.php',
            data:{action:'details',categorie:'devis',id_ref:devis},
            success:function(data){
                $('#modal_content').html(data);
                toggleModal(id);
        }
        })
        console.log('update_devis')
    });
    $(document).on('click','.modification_devis',function(){
        
    });
    // Modification devis End
    $(document).on('click','.deco',function(){
        $.ajax({
            type:'POST',
            url: securite,
            data:{deco:1},
            success:function(data){
                window.location = "http://localhost/testV4/login.php";
                console.log(data);
            }
        });
    });
})