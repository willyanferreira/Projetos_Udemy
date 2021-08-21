<?php 
	session_start();


	$usuario_autenticado = false;
	$usuarios_app = array(
		array('email' => 'adm@teste.com.br', 'senha' => '123456'),
		array('email' => 'user@teste.com.br', 'senha' => 'abcdef'),
	);

	foreach ($usuarios_app as $key) {
	
		if ($key['email'] === $_POST['email'] && $key['senha'] === $_POST['senha']) {
			$usuario_autenticado = true;
		}
	}
	if ($usuario_autenticado) {
			$_SESSION['autenticado'] = 'SIM';
			$_SESSION['x'] = 'um valor';
			$_SESSION['y'] = 'outro valor';
			header('Location: home.php');
		}else{
			$_SESSION['autenticado'] = 'NAO';
			header('Location: index.php?login=erro');
		}
		echo '<hr>';
?>