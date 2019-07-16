<?php
// Seta tempo de execução como ilimitado para que script não finalize execução
// antes de enviar email para todas as pessoas
ini_set('max_execution_time', 0);
// Importa as classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$nomes = array("Exemplo de nome 1", 
	"Exemplo de nome 2"
	);

$emails = array("exemplo1@email.com",
	"exemplo2@email.com"
 	);

$sucesso = 0;

// Cria um novo array baseado com nome e email
foreach( $nomes as $offset => $nome ) {
    $dados[] = array( 'nome' => $nome, 'email' => $emails[ $offset ] );
}

// Envia os emails para cada um individualmente
foreach($dados as $dado){
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
	try {
	    // Configurações do Servidor
	    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output (Útil para depuração em caso de erros ao enviar o email)
	    $mail->isSMTP();                                   		// Set mailer to use SMT
	    $mail->Host = 'smtp.aldeiaconsultoriajr.com';  			// Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
	    $mail->SMTPAutoTLS = false;
	    $mail->Username = 'contato@aldeiaconsultoriajr.com';    // SMTP username
	    $mail->Password = 'senhaDoEmail77';                     // SMTP password
	    $mail->Port = 25;                                       // TCP port to connect to

	    // Informações de quem está enviado
	    $mail->setFrom('contato@aldeiaconsultoriajr.com', 'Contato Aldeia');
	    $mail->addAddress($dado['email'], $dado['nome']);       // Add a recipient

	    // Attachments
	    $mail->addAttachment('imagens/img1.jpg');               // Adiciona um attachment
	    $mail->addAttachment('imagens/img2.jpg');				// Adiciona outro attachment

	    // Conteúdo do email
	    $mail->isHTML(true);                                    // Seta o formato do email para HMTL
	    $mail->AddEmbeddedImage('imagens/flyer_if_portas_abertas.jpg', 'flyer');
	    $mail->Subject = 'Convite para IF de Portas Abertas';
	    $mail->Body    = 'Prezada ' . $dado['nome'] . file_get_contents("convite_if_portas_abertas.html");

	    $mail->send();
	    $sucesso++;
	} catch (Exception $e) {
	    echo 'A mensagem não pode ser enviada.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}

echo $sucesso . "/" . count($dados) . " Emails foram enviados com sucesso!";


?>