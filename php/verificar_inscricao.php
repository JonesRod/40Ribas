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
