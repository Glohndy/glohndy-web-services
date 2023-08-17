$(function () {
    
    $('#contact-form2').submit(function(e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form2').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'php/email.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) {
                    $('#contact-form2').append("<p class='thank-you'>Votre email a bien été envoyé. Merci de m'avoir contacté :)</p>");
                    $('#contact-form2')[0].reset();
                } else {

                    
                    $('#email + .comments').html(json.emailError);
                    
                }                
            }
        });
    });

})