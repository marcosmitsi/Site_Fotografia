<?php
//Importar classes PHPMailer para o namespace global
//Eles devem estar no topo do seu script, não dentro de uma função
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Carregar o autoloader do Composer
require '../libs/vendor/autoload.php';



$dadosForm = $_POST;
//var_dump($dadosForm);
if (isset($dadosForm['SendAddMsg'])) {

//Crie uma instância; passar `true` habilita exceções
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = '';
    $mail->SMTPAuth   = true;
    $mail->Username   = '';
    $mail->Password   = '';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('', 'MSG Via Site');
    $mail->addAddress('', 'Marcos Mitsi');     //Add a recipient
    $mail->addReplyTo($dadosForm['email'], $dadosForm['name']);
    
    //Configuração do email
    $mail->isHTML(true); // Aceita HTML
    $mail->Subject = utf8_decode($dadosForm['subject']. " fotografia.mitsi.com.br");
    $body = utf8_decode("Prezado(a) recebemos a mensagem de " . $dadosForm['name'] . "<br>
    Email: ".$dadosForm['email'] ."<br>
    Com o Assunto:" . $dadosForm['subject'] ."<br> 
    Conteúdo da Mensagem: " . $dadosForm['message'])."<br> 
    Por Favor Responder o mais breve possivel";

    $mail->Body    = $body;
    //$mail->AltBody = utf8_decode($dadosForm['mensg'] . "Enviado Via PHPMailer.\n");
    $mail->send();
    echo '<script>alert("Mensagem Enviada com Sucesso");</script>';
    echo '<script>window.location.href = "../../contact.php";</script>';
} catch (Exception $e) {
    echo '<script>alert("A mensagem não pode ser enviada. Erro de correspondência: {$mail->ErrorInfo}");</script>';
    echo '<script>window.location.href = "../../contact.php";</script>';
}
}