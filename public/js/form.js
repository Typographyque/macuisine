$(function () {
    $("#form_submit").click(function () {
        valid = true;
        if($("#form_name").val() == ""){
            $("#form_name").next(".error-message").fadeIn().text("Veuillez entrer votre nom");
            valid = false;
        }
        else{
            $("#form_name").next(".error-message").fadeOut();
        }
        if($("#form_email").val() == ""){
            $("#form_email").next(".error-message").fadeIn().text("Veuillez entrer votre email");
            valid = false;
        }
        else if(!$("#form_email").val().match(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/)){
            $("#form_email").next(".error-message").fadeIn().text("Veuillez entrer un email valide");
            valid = false;
        }
        else{
            $("#form_email").next(".error-message").fadeOut();
        }
        if($("#form_comment").val() == ""){
            $("#form_comment").next(".error-message").fadeIn().text("Veuillez écrire votre message");
            valid = false;
        }
        else{
            $("#form_comment").next(".error-message").fadeOut();
        }
        return valid;
    })

})