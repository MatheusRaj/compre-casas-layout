<?php
    $mail_to = "matheusraj5@gmail.com";
        
    # Sender Data
    $subject = $_POST["subject"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];
    
    # Mail Content
    $content = "Name: $name\n";
    $content .= "Email: $email\n\n";
    $content .= "Phone: $phone\n";
    $content .= "Message:\n$message\n";

    # email headers.
    $headers = "From: " . $name . "<". $email .">\r\n";

    # Send the email.
    $success = mail($mail_to, $subject, $content, $headers);
    if ($success) {
        # Set a 200 (okay) response code.
        http_response_code(200);
        echo "Seu email foi enviado com sucesso. Logo nossos corretores entrarão em contato com você!";
    } else {
        # Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops... algo deu errado. Tente novamente mais tarde.";
    }
?>