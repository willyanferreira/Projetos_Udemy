<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio rápido de formulário</title>
</head>
<body>
    <form action="http://localhost:2017/usuarios/adiciona" method="post">
        <label for="nome">seu nome: </label>
        <input type="text" name="nome" placeholder="digite aqui">
        <br>
        <label for="idade">sua idade: </label>
        <input type="numeric" name="idade" placeholder="digite aqui">
        <br>
        <label for="profi">sua profissão: </label>
        <input type="text" name="profi" placeholder="digite aqui">
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>