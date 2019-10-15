<?php

    require "./classes/personalinfo.php";
    
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './classes/PHPMailer/src/Exception.php';
    require './classes/PHPMailer/src/PHPMailer.php';
    require './classes/PHPMailer/src/SMTP.php';

    $Mailer = new PHPMailer();

    //define que será usado SMTP
    $Mailer -> isSMTP();

    //aceitar caracteres especiais
    $Mailer -> Charser = 'UTF-8';

    //Configurações
    $Mailer -> IsHTML(true);
    $Mailer -> SMTPAuth = true;
    $Mailer -> SMTPSecure = 'ssl';

    //Nome do servidor e Porta de saída do e-mail
    $Mailer -> Host = 'tls://smtp.gmail.com:587';

    //Dados do usuário do e-mail de saída
    $Mailer -> Username = constant("SITE_EMAIL");
    $Mailer -> Password = constant("SITE_EMAIL_PASSWORD");

    //E-mail remetente
    $Mailer -> From = $email;

    //Nome do remetente
    $Mailer -> FromName = $nome;

    //Assunto da mensagem
    $Mailer -> Subject = constant("EMAIL_SUBJECT");

    //Conteúdo da mensagem
    $Mailer -> Body = $mensagem;

    //Corpo da mensagem em texto
    $Mailer -> AltBody = $mensagem;

    //Destinatário
    $Mailer -> AddReplyTo($email);
    $Mailer -> AddAddress(constant("SITE_EMAIL"));

    if($Mailer -> Send()) {
        echo "E-mail enviado com sucesso!";
    }
    else {
        echo "E-mail NÃO enviado com sucesso!<br>" . $Mailer -> ErrorInfo;
    }

    header("location:../index.php");

?>