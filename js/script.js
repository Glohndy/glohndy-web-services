$(function () {
    
    $('#contact-form').submit(function(e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) {
                    $('#contact-form').append("<p class='thank-you'>Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>");
                    $('#contact-form')[0].reset();
                } else {
                    $('#name + .comments').html(json.nameError);
                    $('#firstname + .comments').html(json.firstnameError);
                    $('#phone + .comments').html(json.phoneError);
                    $('#email + .comments').html(json.emailError);
                    $('#message + .comments').html(json.messageError);
                }                
            }
        });
    });

})