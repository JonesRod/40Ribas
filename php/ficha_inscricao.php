<?php
    /*codigo da sessão
    include('../lib/php/conexao.php');

    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['usuario'])){
        header("Location: ../login.php");
    }*/
    $caminhoDaImagem= false;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Inscrição</title>
</head>
<body>
    <h1>Ficha de Inscrição</h1>
    <form method="POST" action="">
        <div>
            <img src="<?php echo $caminhoDaImagem; ?>" alt="Sem Foto"><br>
            <a href="">Adicione uma foto de perfil.</a>
        </div>    
        <p>
            <label>Nome: </label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text"><br>
        </p>
        <p>
            <label>Sobrenome: </label>
            <input value="<?php if(isset($_POST['sobrenome'])) echo $_POST['sobrenome']; ?>" name="sobrenome" type="text"><br>
        </p>
        <p>
            <label>Apelido: </label>
            <input value="<?php if(isset($_POST['apelido'])) echo $_POST['apelido']; ?>" name="apelido" type="text"><br>
        </p>
        <p>
            <label>CPF: </label>
            <input value="<?php if(isset($_POST['cpf'])) echo $_POST['cpf']; ?>" name="cpf" type="text"><br>
        </p>
        <p>
            <label>RG: </label>
            <input value="<?php if(isset($_POST['rg'])) echo $_POST['rg']; ?>" name="rg" type="text"><br>
        </p>
        <p>
            <label>Data de Nascimento: </label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" name="nascimento" type="text"><br>
        </p>
        <p>
            <label>Cidade Natal: </label>
            <input value="<?php if(isset($_POST['cidnatal'])) echo $_POST['cidnatal']; ?>" name="cidnatal" type="text"><br>
        </p>
        <p>
            <label>UF: </label>
            <input value="<?php if(isset($_POST['uf'])) echo $_POST['uf']; ?>" name="uf" type="text"><br>
        </p>
        <p>
            <label>Celular 1: </label>
            <input value="<?php if(isset($_POST['celular1'])) echo $_POST['celular1']; ?>" name="celular1" type="text"><br>
        </p>
        <p>
            <label>Celular 2: </label>
            <input value="<?php if(isset($_POST['celular2'])) echo $_POST['celular2']; ?>" name="celular2" type="text"><br>
        </p>
        <p>
            <label>Endereço: </label>
            <input value="<?php if(isset($_POST['endereco'])) echo $_POST['endereco']; ?>" name="endereco" type="text"><br>
        </p>
        <p>
            <label>N°: </label>
            <input value="<?php if(isset($_POST['numero'])) echo $_POST['numero']; ?>" name="numero" type="text"><br>
        </p>
        <p>
            <label>Bairro: </label>
            <input value="<?php if(isset($_POST['bairro'])) echo $_POST['bairro']; ?>" name="bairro" type="text"><br>
        </p>
        <p>
            <label>E-mail:</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="email"><br>
        </p>
        <p>
            <label for="">Diga qual é o motivo ao qual você deseja se tornar sócio: </label><br>
            <input placeholder="Minimo 100 digitos" value="<?php if(isset($_POST['motivo'])) echo $_POST['motivo']; ?>" type="text" name="motivo">
        </p>
        <p>
            <a href="../index.php">Voltar</a>
            <button type="submit">Salvar</button>
        </p>
</body>
</html>

