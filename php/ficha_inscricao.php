<?php
    include('upload.php');

    $caminhoDaImagem ="";
    $msg = false;

    if(isset($_POST['email'])) {

        include('../lib/php/conexao.php');
        include('../lib/php/enviarEmail.php');
        //echo ($_FILES['input_imagem']);
        //$caminhoDaImagem = $foto;
        $nome_foto = $caminhoDaImagem;
        $nome = $mysqli->escape_string($_POST['nome']);
        $sobrenome = $mysqli->escape_string($_POST['sobrenome']);
        $apelido = $mysqli->escape_string($_POST['apelido']);
        $cpf = $mysqli->escape_string($_POST['cpf']);
        $rg = $mysqli->escape_string($_POST['rg']);
        $nascimento = $mysqli->escape_string($_POST['nascimento']);
        $uf = $mysqli->escape_string($_POST['uf']);
        $cid_natal = $mysqli->escape_string($_POST['cidnatal']);
        $mae = $mysqli->escape_string($_POST['mae']);
        $pai = $mysqli->escape_string($_POST['pai']);
        $celular1 = $mysqli->escape_string($_POST['celular1']);
        $celular2 = $mysqli->escape_string($_POST['celular2']);
        $endereco = $mysqli->escape_string($_POST['endereco']);
        $numero = $mysqli->escape_string($_POST['numero']);
        $bairro = $mysqli->escape_string($_POST['bairro']);
        $email = $mysqli->escape_string($_POST['email']);
        $motivo = $mysqli->escape_string($_POST['motivo']);
        $aceito = $mysqli->escape_string($_POST['aceito']);

        $sql_cpf = $mysqli->query("SELECT * FROM int_associar WHERE cpf = '$cpf'");
        $result_cpf= $sql_cpf->fetch_assoc();
        $cpf_registrado = $sql_cpf->num_rows;

        $sql_email = $mysqli->query("SELECT * FROM int_associar WHERE email = '$email'");
        $result_email= $sql_email->fetch_assoc();
        $email_registrado = $sql_email->num_rows;
        //var_dump($_POST);
        //die();
        //echo $cpf_registrado ;   
        if(($cpf_registrado ) == 0) {
     
            if(($email_registrado ) == 0) {
               
                $sql_code = "INSERT INTO int_associar (data, foto, apelido, nome, sobrenome, cpf, rg, nascimento, uf, cid_natal, mae, pai, celular1, celular2, endereco, numero, bairro, email, motivo, concord_termos) 
                VALUES (NOW(), '$nome_foto','$apelido', '$nome','$sobrenome','$cpf','$rg','$nascimento', '$uf', '$cid_natal', '$mae', '$pai', '$celular1','$celular2', '$endereco', '$numero', '$bairro', '$email', '$motivo', '$aceito')";
                $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);

                if($deu_certo){

                    $msg = "Sua solicitação foi enviada e registrada com sucesso.";
                    //echo $msg;

                    /*enviar_email($email, "Registro de solicitação de associação ao Club 40Ribas", "
                    <h1>Seja bem vindo " . $nome . "</h1>
                    <p>texto informativo</p>");*/

                    unset($_POST);

                    header("refresh: 5;../index.php"); //Atualiza a pagina em 5s e redireciona apagina
            
                }                
            }
            if(($email_registrado) != 0) {

                $msg = "Já existe um Solicitação cadastrada com esse e-mail!";

            }
        }
        if(($cpf_registrado) != 0) {

            $msg = "Já existe um Solicitação cadastrada com esse CPF!";

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
            var imagem = document.getElementById('imagem_preview');
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
            <input required value="<?php if(isset($_POST['cpf'])) echo $_POST['cpf']; ?>" name="cpf" type="text"><br>
        </p>
        <p>
            <label>RG: </label>
            <input required value="<?php if(isset($_POST['rg'])) echo $_POST['rg']; ?>" name="rg" type="text"><br>
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
            <textarea required value=""  rows="4" cols="50" placeholder="Minimo 100 digitos" type="text" name="motivo"><?php if(isset($_POST['motivo'])) echo $_POST['motivo']; ?></textarea>
        </p>
        <p>
            <input type="checkbox" id="aceito"  onchange="verificarAceite()" name="aceito" value="sim">Eu aceito os <a href="termos.php" target="_blank">Termos.</a><br><br>
            <span>
                <?php 
                    echo $msg; 
                ?>
            </span><br>
            <a href="../index.php">Voltar</a>
            <button id="solicitar" disabled = "false" type="submit">Solicitar</button>
        </p>
</body>
</html>