/* 
 * copye this file in main.js in OSAdminBundle/public/js/main.js
 */

$(document).ready(function(){
    AjaxPays();
});

function AjaxPays(){
    $(".pays_type").blur(function(){
        console.log('je quitte le champs');
        $.ajax({
            type: 'get',
            url: 'http://localhost/otakuShensui/web/app_dev.php/admin/pays/'+$('.pays_type').val(),
            beforeSend: function(){
                console.log('ca charge');
            },
            success: function(data){
                $('.pays').val(data.pays);
            }
        });
    });
}
