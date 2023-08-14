<?php
    /*codigo da sessão
    include('../lib/php/conexao.php');

    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['usuario'])){
        header("Location: ../login.php");
    }*/
    $caminhoDaImagem = "../arquivos/9734564-default-avatar-profile-icon-of-social-media-user-vetor.jpg";
    $msg = false;

    if(isset($_POST['email'])) {

        include('../lib/php/conexao.php');
        include('../lib/php/enviarEmail.php');

        $cpf = $mysqli->escape_string($_POST['cpf']);
        $email = $mysqli->escape_string($_POST['email']);

        $sql_query = $mysqli->query("SELECT * FROM int_associar WHERE cpf = '$cpf', email = '$email'");
        $result = $sql_query->fetch_assoc();
        $registro = $sql_query->num_rows;

        if(($registro ) == 0) {

            //$senha = $_POST['confSenha'];
            //$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
            $sql_code = "INSERT INTO int_associar (data, nome, sobrenome, apelido, cpf, rg, nascimento, uf, cidnatal, mae, pai, celular1, celular2, endereco, numero, bairro, email, motivo) 
            VALUES(NOW(), '$nome', '$sobrenome', '$apelido', '$cpf', '$rg', '$nascimento', '$uf', '$cidnata', '$mae', '$pai', '$celular1', '$celular2', '$endereco', '$numero', '$bairro', '$email', '$motivo')";
            $deu_certo = $mysqli->query($sql_code) or die($mysqli->$error);

            if($deu_certo){

                $msg = "Sua solicitação foi enviada e registrada com sucesso.";
                echo $msg;

                enviar_email($email, "Registro de solicitação de associação ao Club 40Ribas", "
                <h1>Seja bem vindo " . $nome . "</h1>
                <p>texto informativo</p>");

                unset($_POST);

                header("refresh: 5;../index.php"); //Atualiza a pagina em 5s e redireciona apagina
            }
        }
        if(($registro ) != 0) {
            $msg = true;
            $msg = "Já existe um Solicitação cadastrada com esse e-mail!";
            echo $msg;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function carregarImagem(event) {
            var imagem = document.getElementById('imagem-preview');
            imagem.src = URL.createObjectURL(event.target.files[0]);
        }
        function verificarAceite() {
            var checkbox = document.getElementById('aceito');
            var botaoEnviar = document.getElementById('solicitar');
            
            if (checkbox.checked) {
                botaoEnviar.disabled = false;
            } else {
                botaoEnviar.disabled = true;
            }
        }
    </script>
    <title>Ficha de Inscrição</title>
</head>
<body>
    <h1>Ficha de Inscrição</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <img id="imagem-preview" src="<?php echo $caminhoDaImagem ?>" name="img" alt="" style="max-width: 150px;"><br>
        <input type="file" id="input-imagem" name="input-imagem" accept="image/*" onchange="carregarImagem(event)"><!--função do js-->

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
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
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
        <input type="checkbox" id="aceito" onchange="verificarAceite()" name="aceito" value="sim">Eu aceito os <a href="termos.php" target="_blank">Termos.</a><br><br>
            <a href="../index.php">Voltar</a>
            <button id="solicitar" type="submit">Solicitar</button>
        </p>
</body>
</html>

