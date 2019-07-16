<?php
// Dados email utulizado para envio
$nome_exibicao = "Contato Aldeia";
$email = "contato";
$senha = "aldeia33";

// Dados do Servidor
$host_smtp = "mx1.hostinger.com.br";
$porta_smtp = "587";

$dados = [
	array(
		"nome" => "Exemplo 1",
		"email" => "exemplo1@email.com"
	),
	array(
		"nome" => "Exemplo 2",
		"email" => "exemplo2@email.com"
	),
];

$nomes = $emails = "";

foreach($dados as $dado){
	$nomes = $nomes . $dado["nome"] . "\n";
	$emails = $emails . $dado["email"] . "\n";
}

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Email Aldeia</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<form action="mailer.php" method="post">
					<center><label><h4>Parâmetros de Envio</h4></label>
					</center>
					<div class="form-group">
						<label for="password">Nome exibição</label>
						<input type="text" class="form-control" id="nome_exibicao" name="nome_exibicao" value="<?= $nome_exibicao ?>">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<div class="input-group">
							<input type="text" class="form-control" id="email" name="email" value="<?= $email ?>">
							<span class="input-group-addon" id="email-addon">@aldeiaconsultoriajr.com</span>
						</div>
					</div>
					<div class="form-group">
						<label for="password">Senha</label>
						<input type="password" class="form-control" id="password" name="password" value="<?= $senha ?>">
					</div>
					<center><label><h4>Configurações do Servidor</h4></label>
					</center>
					<div class="form-group">
						<label for="host_smtp">Host SMTP</label>
						<input type="text" readonly class="form-control" id="host_smtp" name="host_smtp" value="<?= $host_smtp ?>">
					</div>
					<div class="form-group">
						<label for="porta_smtp">Porta SMTP</label>
						<input type="text" class="form-control" id="porta_smtp" name="porta_smtp" value="<?= $porta_smtp ?>">
					</div>
					<center><label><h4>Recipientes</h4></label>
					</center>
					<div class="form-group">
						<label for="nome_recipentes">Nomes</label>
						<textarea class="form-control" id="nome_recipientes" name="nome_recipientes" rows="5"><?= $nomes ?></textarea>
					</div>
					<div class="form-group">
						<label for="email_recipentes">Emails</label>
						<textarea class="form-control" id="email_recipientes" name="email_recipientes" rows="5"><?= $emails ?></textarea>
					</div>
					<center><input type="submit" class="btn btn-primary" value="Enviar"></center>
				</form>
			</div>
			<div class="col-lg-3"></div>
		</div>
		<br/>
		<br/>
	</div>
</body>

</html>