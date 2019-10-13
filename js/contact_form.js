jQuery(function () {
    var form = $('#ajax-contact-form');

    form.on('submit', e => {
        if (!e.isDefaultPrevented()) {
            const url = 'contact.php';

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                sucess: (data) => {
                    let messageAlert = 'alert-' + data.type;
                    let messageText = data.message;

                    let alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    
                    if (messageAlert && messageText) {
                        form.find('.messages').html(alertBox);

                        form[0].reset();
                    }
                }
            });
            return false;
        }
    })
})