<?php
    /*codigo da sessão
    include('../lib/php/conexao.php');

    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['usuario'])){
        header("Location: ../login.php");
    }*/
    $caminhoDaImagem = "../arquivos/9734564-default-avatar-profile-icon-of-social-media-user-vetor.jpg";
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
    <form action="" method="POST">
        <form action="upload_img.php" method="POST" enctype="multipart/form-data">
            <img name="imagem" id="imagem" src="<?php echo $caminhoDaImagem; ?>" alt=""><br>
            <input type="file"><br>
            
            <!--<input type="submit" value="Adicionar">  


            <label for="imagem">Escolha uma imagem:</label>
            <input type="file" name="imagem" id="imagem">
            <input type="submit" value="Enviar">    -->        
        </form>


  
        <p>
            <label>Nome: </label>
            <input required value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text"><br>
        </p>
        <p>
            <label>Sobrenome: </label>
            <input required value="<?php if(isset($_POST['sobrenome'])) echo $_POST['sobrenome']; ?>" name="sobrenome" type="text"><br>
        </p>
        <p>
            <label>Apelido: </label>
            <input value="<?php if(isset($_POST['apelido'])) echo $_POST['apelido']; ?>" name="apelido" type="text"><br>
        </p>
        <p>
            <label>CPF: </label>
            <input required value="<?php if(isset($_POST['cpf'])) echo $_POST['cpf']; ?>" name="cpf" type="number"><br>
        </p>
        <p>
            <label>RG: </label>
            <input required value="<?php if(isset($_POST['rg'])) echo $_POST['rg']; ?>" name="rg" type="number"><br>
        </p>
        <p>
            <label>Data de Nascimento: </label>
            <input required value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" name="nascimento" type="date"><br>
        </p>
        <p> 
            <!--<input required value="<?php if(isset($_POST['uf'])) echo $_POST['uf']; ?>" name="uf" type="text"><br>-->
            
            <label>Estado: </label><select name="uf" id="uf" value="<?php if(isset($_POST['uf'])) echo $_POST['uf']; ?>">
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <!-- Adicione mais opções para outros estados aqui -->
            </select>
        </p>
        <p>
            <label>Cidade Natal: </label>
            <input required value="<?php if(isset($_POST['cidnatal'])) echo $_POST['cidnatal']; ?>" name="cidnatal" type="text"><br>
        </p>

        <p>
            <label>Nome da Mãe: </label>
            <input required value="<?php if(isset($_POST['mae'])) echo $_POST['mae']; ?>" name="mae" type="data"><br>
        </p>
        <p>
            <label>Nome do Pai: </label>
            <input value="<?php if(isset($_POST['pai'])) echo $_POST['pai']; ?>" name="pai" type="text"><br>
        </p>

        <p>
            <label>Celular 1: </label>
            <input required value="<?php if(isset($_POST['celular1'])) echo $_POST['celular1']; ?>" name="celular1" type="text"><br>
        </p>
        <p>
            <label>Celular 2: </label>
            <input value="<?php if(isset($_POST['celular2'])) echo $_POST['celular2']; ?>" name="celular2" type="text"><br>
        </p>
        <p>
            <label>Endereço: </label>
            <input required value="<?php if(isset($_POST['endereco'])) echo $_POST['endereco']; ?>" name="endereco" type="text"><br>
        </p>
        <p>
            <label>N°: </label>
            <input required value="<?php if(isset($_POST['numero'])) echo $_POST['numero']; ?>" name="numero" type="text"><br>
        </p>
        <p>
            <label>Bairro: </label>
            <input required value="<?php if(isset($_POST['bairro'])) echo $_POST['bairro']; ?>" name="bairro" type="text"><br>
        </p>
        <p>
            <label>E-mail:</label>
            <input required value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="email"><br>
        </p>
        <p>
            <label for="">Diga qual é o motivo ao qual você deseja se tornar sócio: </label><br>
            <textarea required placeholder="Minimo 100 digitos" rows="4" cols="50" value="<?php if(isset($_POST['motivo'])) echo $_POST['motivo']; ?>" type="text" name="motivo"></textarea>
        </p>
        <p>
        <input type="checkbox" name="aceito" value="sim">Eu aceito os <a href="">Termos.</a><br>
            <a href="../index.php">Voltar</a>
            <button type="submit">Salvar</button>
        </p>
</body>
</html>

