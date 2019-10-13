jQuery(function () {
    var form = $('#ajax-contact-form');

    console.log("Executou a função");

    form.on('submit', e => {
        if (!e.isDefaultPrevented()) {
            const url = 'contact_form.php';

            console.log("Pronto para fazer o post");

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

                        console.log("Entrou aqui por algum motivo");

                        form[0].reset();
                    }
                }
            });
            console.log("Alguma coisa aconteceu");
            return false;
        }
    })
})