<?php

	$titulo = str_replace('|', '#', $_POST['titulo']);
	$categoria = str_replace('|', '#', $_POST['categoria']);
	$descricao = str_replace('|', '#', $_POST['descricao']);
	
	$texto = $titulo . ' | ' . $categoria . ' | ' . $descricao . PHP_EOL;

	$arquivo = fopen('arquivo.hd', 'a');
	
	fwrite($arquivo, $texto);

	fclose($arquivo);

	//header('Location: abrir_chamado.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Registro efetuado</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		.registraChamado a {
			display: inline-block;
			width: 48%;
			margin: 5px;
		}
		.registraChamado {
			width: 50%;
			margin: 10px auto;
			text-align: center;
			padding: 10px;
			border: 1px solid black;
			border-radius: 10px;
			text-transform: uppercase;
			color: black;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
    </nav>
	<div class="registraChamado">
		<p class="btn btn-success text-dark" style="width: 100%;">Chamado aberto com sucesso</p>
		<a class="btn btn-warning text-dark" href="abrir_chamado.php">Novo chamado</a>
		<a class="btn btn-info text-dark" href="consultar_chamado.php">Consultar chamados</a>
		<a class="btn btn-danger text-dark" style="width: 100%;" href="logoff.php">Encerrar sessão</a>
	</div>
</body>
</html>