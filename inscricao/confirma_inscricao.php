<?php
function enviarArquivo($error, $name, $tmp_name) {
    // para obrigar a ter foto
    if($error)
        //echo("Falha ao enviar arquivo");
        return false;

    $pasta = "foto_perfil/";
    $nomeDoArquivo = $name;
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($tmp_name, $path);
    if ($deu_certo) {
        return $path;
    } else
        return false;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação</title>
    <?php

        if(isset($_POST['email'])) {
            //include('upload.php');
            include('../login/conexao.php');
            include('../lib/php/enviarEmail.php');

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
            $sexo = $mysqli->escape_string($_POST['sexo']);
            $uf_atual = $mysqli->escape_string($_POST['uf_atual']);
            $cep = $mysqli->escape_string($_POST['cep']);
            $cid_atual = $mysqli->escape_string($_POST['cid_atual']);
            $endereco = $mysqli->escape_string($_POST['endereco']);
            $numero = $mysqli->escape_string($_POST['numero']);
            $bairro = $mysqli->escape_string($_POST['bairro']);        
            $celular1 = $mysqli->escape_string($_POST['celular1']);
            $celular2 = $mysqli->escape_string($_POST['celular2']);
            $email = $mysqli->escape_string($_POST['email']);
            $motivo = $mysqli->escape_string($_POST['motivo']);
            $termos = $mysqli->escape_string($_POST['aceito']);
            
            $hoje = new DateTime('now');
            $dataStr = $nascimento;
            $dataFormatada = DateTime::createFromFormat('d/m/Y', $dataStr);

            if ($dataFormatada !== false) {
            // echo $dataFormatada->format('Y-m-d'); // Formato de data: yyyy-mm-dd
            $dataFormatada->format('Y-m-d');
            //$nasc = new DateTime($dataFormatada);
            } else {
            // echo "Formato de data inválido.";
            }
            //echo $dataFormatada->format('Y-m-d');
            $nasc = $dataFormatada->format('Y-m-d');
            $idade = $hoje->diff($dataFormatada);
            $idade_minima = 35;
            $anos_idade = $idade->y;

            /*echo "Diferença de " . $idade->d . " dias";
            echo " e " . $idade->m . " mese s";
            echo " e " . $idade->y . " anos.";*/
            
            //var_dump($_POST);

            if(($anos_idade) >= $idade_minima) {
                //echo "Você tem " . $idade->y . " anos, ". $idade->m ." meses e ". $idade->d ." dias.";

                $sql_cpf = $mysqli->query("SELECT * FROM int_associar WHERE cpf = '$cpf'");
                $result_cpf= $sql_cpf->fetch_assoc();
                $cpf_registrado = $sql_cpf->num_rows;

                $sql_email = $mysqli->query("SELECT * FROM int_associar WHERE email = '$email'");
                $result_email= $sql_email->fetch_assoc();
                $email_registrado = $sql_email->num_rows;
                //var_dump($_POST);
                //die();
                //echo $cpf_registrado ;   
                if(($cpf_registrado) == 0) {
            
                    if(($email_registrado ) == 0) {
                        
                        $arq = $_FILES['imageInput'];
                        $path = enviarArquivo($arq['error'], $arq['name'], $arq['tmp_name']);
                        //echo $path;
                        $sql_code = "INSERT INTO int_associar (data, foto, apelido, nome, sobrenome, cpf, rg, nascimento, uf, cid_natal, mae, pai, sexo, uf_atual, cep, cid_atual, endereco, nu, bairro, celular1, celular2, email, motivo, termos) 
                        VALUES (NOW(),'$path','$apelido', '$nome','$sobrenome','$cpf','$rg','$nasc', '$uf', '$cid_natal', '$mae', '$pai', '$sexo', '$uf_atual','$cep','$cid_atual','$endereco','$numero','$bairro','$celular1','$celular2','$email', '$motivo', '$termos')";
                        $deu_certo = $mysqli->query($sql_code) or die($mysqli->$error);

                        if($deu_certo){
                            $msg = true;
                            $msg = "Sua solicitação foi enviada e registrada com sucesso.";
                            //echo $msg;

                            enviar_email($email, "Registro de solicitação de para associação ao Club 40Ribas", "
                            <h1>Olá Sr. " . $nome . "</h1>
                            <p>Sua solicitação foi registrada com sucesso. Assim que surgir uma vaga passaremos sua 
                            solicitação por votação de aprovação. Lhe avisaremos assim ...</p>
                            <p>Menssagem automatica. Não responda!</p>");

                            unset($_POST);

                            header("refresh: 5;../index.html"); //Atualiza a pagina em 5s e redireciona apagina
                        }                
                    }
                    if(($email_registrado) != 0) {

                        $msg = "Já existe uma Solicitação cadastrada com esse e-mail!";
                        $msg1 = "";
                        $msg2 = "";
                        //echo $msg;
                        header("refresh: 10;../index.html");
                    }
                }
                if(($cpf_registrado) != 0) {

                    $msg = ("Já existe um Solicitação cadastrada com esse CPF!");
                    $msg1 = "";
                    $msg2 = "";
                    //echo $msg;
                    header("refresh: 10;../index.html");
                }
            }else{

                $msg = "Você tem " . $idade->y . " anos, ". $idade->m ." meses e ". $idade->d ." dias.";
                $msg1 = "Você ainda não tem idade o suficiente para ser sócio!";
                $msg2 = "Complete a idade minima que é ".$idade_minima ." anos e tente novamente.";
                unset($_POST);

                header("refresh: 10;../index.html");
            }
        }else {
            exit;
        }
    ?>
</head>
<body>
    <div id="msg">
    <p><span><?php echo $msg; ?></span></p>
    <p><span><?php echo $msg1; ?></span></p>
    <p><span><?php echo $msg2; ?></span></p>
    </div>
</body>
</html>
