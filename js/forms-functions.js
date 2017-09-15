function mail(form) {
    var
        message_text = 'Your application has been sent<br>We will get back to you!',
        form_email = $(form).find('input[name="email"]');

    if (!form_email.val()) {
        validate(form_email);
        return false;
    }

    ajax(form, message_text)
}

function ajax(form, message_text) {
    var formData = new FormData(form[0]);
	$.ajax({
        url: 'mail/mailer.php',
        type: 'post',
        contentType: false,
        processData: false,
        data: formData,
        success: function (answer) {
            //alert(answer);
			succ(answer, form, message_text);
        },
		error: function (arg1, arg2, arg3) {
			alert(arg2 + ' ' + arg3);
		}
    });
}

function succ(answer, form, message_text) {
    switch (answer) {
        case 'success':
            form.trigger('reset').fadeOut(300, function () {
                form.after('<p class="message_send">' + message_text + '</p>');
            });
            setTimeout(function () {
                form.fadeIn(300).siblings('.message_send').remove();
            }, 15000);
            break;
        case 'failed':
            break;
    }
}


function validate(email) {
    email
        .animate({backgroundColor: '#ff0000'})
        .animate({backgroundColor: '#fff'});
}