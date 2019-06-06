$(document).ready(function () {

    $("#signupform-role").change(function(){
        if ($("#signupform-role").val() == 1) {
            $('.legal-info').show();
        } else {
            $('.legal-info').hide();
        }
    });

});