<?php

// Recebe valores via POST
$nome_exibicao = $_POST["nome_exibicao"];
$email = $_POST["email"];
$email = $email . "@aldeiaconsultoriajr.com";
$password = $_POST["password"];

$host_smtp = $_POST["host_smtp"];
$porta_smtp = $_POST["porta_smtp"];

$nome_recipientes = $_POST["nome_recipientes"];
$email_recipientes = $_POST["email_recipientes"];

// Processa os nomes
$nomes = explode("\n", str_replace("\r", "", $nome_recipientes));
$emails = explode("\n", str_replace("\r", "", $email_recipientes));

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
ini_set('max_execution_time', 0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include 'lib/phpmailer/Exception.php';
include 'lib/phpmailer/PHPMailer.php';
include '/lib/phpmailer/SMTP.php';

$sucesso = 0;

// cria um novo array baseado com nome e email
foreach( $nomes as $offset => $nome ) {
    $dados[] = array( 'nome' => $nome, 'email' => $emails[ $offset ] );
}


// envia os emails para cada um individualmente
foreach($dados as $dado){
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
	try {
	    //Server settings
	    //$mail->SMTPDebug = 4;                                 // Enable verbose debug output
	    $mail->isSMTP();                                        // Set mailer to use SMT
	    $mail->Host = $host_smtp;  							    // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
	    $mail->SMTPAutoTLS = false;
	    $mail->Username = $email;                 				// SMTP username
	    $mail->Password = $password;                            // SMTP password
	    $mail->Port = intval($porta_smtp);                      // TCP port to connect to

	    // Informações de quem está enviando o email
	    $mail->setFrom($email, $nome_exibicao);
	    $mail->addAddress($dado['email'], $dado['nome']);     	// Add a recipient
		
	    // Attachments
	    //$mail->addAttachment('attachment1.jpg');         		// Add attachments
	    //$mail->addAttachment('attachment2.jpg');    					

	    // Conteúdo do email
	    $mail->isHTML(true);                                    // Set email format to HTML
	    //$mail->AddEmbeddedImage('flyer_if_portas_abertas.jpg', 'flyer');
	    $mail->Subject = 'CIRCUITO EMPREENDA POÇOS – Zona Sul';
	    $mail->Body    = file_get_contents("dados/cep2018.html");
	    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    $sucesso++;
	} catch (Exception $e) {
	    echo 'A mensagem não pode ser enviada.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}

echo $sucesso . "/" . count($dados) . " Emails foram enviados com sucesso!";


?>