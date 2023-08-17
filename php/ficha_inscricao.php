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
<html lang="PT-BR">
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
    <form action="verificar_inscricao.php" method="POST" enctype="multipart/form-data" autocomplete="on">
        <p>
            <label for="inome">Nome: </label><br>
            <input required value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" id="inome" type="text" maxlength="15" size=""><br>
        </p>
        <p>
            <label for="isobrenome">Sobrenome: </label><br>
            <input required value="<?php if(isset($_POST['sobrenome'])) echo $_POST['sobrenome']; ?>" name="sobrenome" id="isobrenome" type="text" maxlength="100" size="">
        </p>
            <label for="iapelido">Apelido: </label><br>
            <input value="<?php if(isset($_POST['apelido'])) echo $_POST['apelido']; ?>" name="apelido" id="iapelido" type="text"><br>
        </p>
        <p>
            <label for="icpf">CPF: </label><br>
            <input required value="<?php if(isset($_POST['cpf'])) echo $_POST['cpf']; ?>" name="cpf" id="icpf" type="text" maxlength="14"><br>
        </p>
        <p>
            <label for="irg">RG: </label><br>
            <input required value="<?php if(isset($_POST['rg'])) echo $_POST['rg']; ?>" name="rg" id="irg" type="text"><br>
        </p>
        <p>
            <label for="inascimento">Data de Nascimento: </label><br>
            <input required value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" name="nascimento" id="inascimento" type="date" maxlength="10"><br>
        </p>
        <p> 
            <!--<input required value="<?php if(isset($_POST['uf'])) echo $_POST['uf']; ?>" name="uf" type="text"><br>-->
            
            <label for="iuf">Estado: </label><br>
            <select name="uf" id="iuf" value="<?php if(isset($_POST['uf'])) echo $_POST['uf']; ?>">
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
            <label for="icidnatal">Cidade Natal: </label><br>
            <input required value="<?php if(isset($_POST['cidnatal'])) echo $_POST['cidnatal']; ?>" name="cidnatal" id="icidnatal" type="text"><br>
        </p>

        <p>
            <label for="imae">Nome da Mãe: </label><br>
            <input required value="<?php if(isset($_POST['mae'])) echo $_POST['mae']; ?>" name="mae" id="imae" type="data"><br>
        </p>
        <p>
            <label for="ipai">Nome do Pai: </label><br>
            <input value="<?php if(isset($_POST['pai'])) echo $_POST['pai']; ?>" name="pai" id="ipai" type="text"><br>
        </p>

        <p>
            <label for="icelular1">Celular 1: </label><br>
            <input required value="<?php if(isset($_POST['celular1'])) echo $_POST['celular1']; ?>" name="celular1" id="icelular1" type="text" maxlength="15" size=""><br>
        </p>
        <p>
            <label for="icelular2">Celular 2: </label><br>
            <input value="<?php if(isset($_POST['celular2'])) echo $_POST['celular2']; ?>" name="celular2" id="" type="text" maxlength="15" size=""><br>
        </p>
        <p>
            <label for="iendereco">Endereço: </label><br>
            <input required value="<?php if(isset($_POST['endereco'])) echo $_POST['endereco']; ?>" name="endereco" id="iendereco" type="text"><br>
        </p>
        <p>
            <label for="inum">N°: </label><br>
            <input required value="<?php if(isset($_POST['numero'])) echo $_POST['numero']; ?>" name="numero" id="inum" type="text"><br>
        </p>
        <p>
            <label for="ibairro">Bairro: </label><br>
            <input required value="<?php if(isset($_POST['bairro'])) echo $_POST['bairro']; ?>" name="bairro" id="ibairro" type="text"><br>
        </p>
        <p>
            <label for="iemail">E-mail:</label><br>
            <input required value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" id="iemail" type="email"><br>
        </p>
        <p>
            <label for="imotivo">Diga qual é o motivo ao qual você deseja se tornar sócio: </label><br>
            <textarea required value=""  rows="4" cols="50" placeholder="Minimo 100 digitos" minlength="10" maxlength="1500" type="text" name="motivo" id="imotivo" ><?php if(isset($_POST['motivo'])) echo $_POST['motivo']; ?></textarea>
        </p>
        <p>
            <input type="checkbox" id="aceito"  onchange="verificarAceite()" name="aceito" value="sim">Eu aceito os <a href="termos.php" target="_blank">Termos.</a><br><br>

            <a href="../index.php">Voltar</a>
            <input id="solicitar" disabled ="false" type="submit" value="Solicitar">
        </p>
    </form>
</body>
</html>