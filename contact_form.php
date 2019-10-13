<?php

$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];

$from = 'Demo contact form <demo@domain.com>';

$sendTo = 'Demo contact form <demo@domain.com>';

$subject = "Novo cliente:  $name";

$fields = array('name' => $name, 'email' => $email, 'message' => $message); 

$okMessage = 'Email enviado com sucesso, logo nossos corretores entrarão em contato com você!';

$errorMessage = 'Ocorreu um erro ao enviar o email, tente novamente mais tarde.';

error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "Novo email recebido do site.\n\n"."Detalhes do cliente:\n\nNome: $name\n\nEmail: $email_address\n\nMensagem:\n$message";

    foreach ($_POST as $key => $value) {
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}
