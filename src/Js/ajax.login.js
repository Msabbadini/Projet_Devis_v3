var secu = 'controller/securite.php';
$(document).ready(function(){
//  ************************************  LOGIN ************************************
    $(document).on('click','#but_login',function(){
        var email =$('#email').val();
        var mp =$('#password').val();
        
        if(email !='' && mp !=''){
            $('#mpError').text('');
            $('#logError').text('');
            $.ajax({
                type:'POST',
                url:secu,
                data:{log:email,mp:mp},
                dataType:'JSON',
                success:function(data){
                    console.log(data);
                    if(data){
                        $('#validLogin').text('Connexion établie');
                        window.location = "http://localhost/testV4/index.php";
                    }else{
                        $('#errorLogin').text('Connexion erreur');
                    }
                }
            });
        }else{
            $('#mpError').text('Veuillez mettre un mot de passe');
            $('#logError').text('Veuillez mettre un identifiant (email ou pseudo)');
        }
    })


})
