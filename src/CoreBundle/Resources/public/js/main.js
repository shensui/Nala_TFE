$(document).ready(function(){
    debug("ic c'est bon!!");
    Control();
});

function debug($msg){
    console.log("log: "+$msg);
}

function Control(){
    $('#pseudo').blur(function(){
       if($('#pseudo').val().length <= 3){
           $('#helpPseudo').html('trop petit');
       }else {$('#helpPseudo').html('');}
    });

    $('#pass2').blur(function(){
        if($('#pass2').val() != $('#pass1').val()){
            $('#helpPass').html('les mots de passe ne sont pas identiques !!');
        }
    });



}