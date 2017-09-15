$(document).ready(function () {
    $('#contact-form').submit(function () {
        mail($(this));
        return false;
    });

});