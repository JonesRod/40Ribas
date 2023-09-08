<?php
    include('../../conexao.php');

    $erro = false;

    if(!isset($_SESSION))
        session_start();
        
    if(!isset($_SESSION['usuario'])){
        header("Location: ../../../../index.php");
    }   
    function enviarArquivo($error, $name, $tmp_name) {
        if ($error) {
            echo "Falha ao enviar o arquivo. Código de erro: " . $error;
            return false;
        }
    
        $pasta = "arquivos/";
        $nomeDoArquivo = $name;
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($tmp_name, $path);
    
        if ($deu_certo) {
            return $path;
        } else {
            echo "Falha ao mover o arquivo para o diretório de destino.";
            return false;
        }
    }
    function enviarArquivotermos($error, $name, $tmp_name) {
        if ($error) {
            echo "Falha ao enviar o arquivo. Código de erro: " . $error;
            return false;
        }
    
        $pasta = "arquivos/";
        $nomeDoArquivo = $name;
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    
        $pathtermos = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($tmp_name, $pathtermos);
    
        if ($deu_certo) {
            return $pathtermos;
        } else {
            echo "Falha ao mover o arquivo para o diretório de destino.";
            return false;
        }
    }
    if(count($_POST) > 0) { 

        if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] != 4) {
            $arq = $_FILES['imageInput'];
            $path = enviarArquivo($arq['error'], $arq['name'], $arq['tmp_name']);
        
            if ($path !== false) {
                // Se o upload foi bem-sucedido, você pode usar $path na sua instrução SQL para atualizar o banco de dados.
                //$nova_logo = " logo = '$path'";
                $nova_logo = $path;
                // Execute a instrução SQL aqui
                //echo $nova_logo.'1';
                //$nova_logo = $_POST['end_logo'];
                echo $nova_logo.'2';
                if(empty($_POST['foto'])) {
                    if(isset($_POST['logo']) && $_POST['logo'] !== 'arquivos/IMG-20230811-WA0040.jpg')
                        unlink($_POST['logo']);
                    //echo $nova_logo.'5';
                }
            } else {
                // O upload falhou, você pode querer tomar alguma ação aqui.
                $nova_logo = $_POST['end_logo'];
                //echo $nova_logo.'2';
            }
        } else {
            // O campo de arquivo não foi enviado no formulário.
            $nova_logo = $_POST['end_logo'];
            //echo $nova_logo.'3';
        }
        /*if(empty($_POST['foto'])) {
                if(isset($_POST['logo']) && $_POST['logo'] !== 'arquivos/9734564-default-avatar-profile-icon-of-social-media-user-vetor.jpg')
                unlink($_POST['logo']);
                echo $nova_logo.'5';
        }*/
        if (isset($_FILES['novos_termos_insc']) && $_FILES['novos_termos_insc']['error'] != 4) {
            $arq = $_FILES['novos_termos_insc'];
            $pathtermos = enviarArquivotermos($arq['error'], $arq['name'], $arq['tmp_name']);
        
            if ($pathtermos !== false) {
                // Se o upload foi bem-sucedido, você pode usar $path na sua instrução SQL para atualizar o banco de dados.
                //$nova_logo = " logo = '$path'";
                $termos_insc = $pathtermos;
                // Execute a instrução SQL aqui
                //echo $nova_logo.'1';
            } else {
                // O upload falhou, você pode querer tomar alguma ação aqui.
                $termos_insc = $mysqli->escape_string($_POST['termos_insc']);
                //echo $nova_logo.'2';
            }
        } else {
            // O campo de arquivo não foi enviado no formulário.
            $termos_insc = $mysqli->escape_string($_POST['termos_insc']);
            //echo $nova_logo.'3';
        }
    

        $id = 1;
        $razao = $mysqli->escape_string($_POST['razao']);
        $cnpj = $mysqli->escape_string($_POST['cnpj']);
        $uf = $mysqli->escape_string($_POST['uf']);
        $cep = $mysqli->escape_string($_POST['cep']);
        $cid = $mysqli->escape_string($_POST['cid']);
        $rua = $mysqli->escape_string($_POST['endereco']);
        $numero = $mysqli->escape_string($_POST['numero']);
        $bairro = $mysqli->escape_string($_POST['bairro']);
        $nome_tesoureiro = $mysqli->escape_string($_POST['nome_tesoureiro']);
        $presidente = $mysqli->escape_string($_POST['presidente']);
        $vice_presidente = $mysqli->escape_string($_POST['vice_presidente']);
        $email_not = $mysqli->escape_string($_POST['email_not']);
        $email_rec = $mysqli->escape_string($_POST['email_rec']);
        //$termos_insc = $mysqli->escape_string($_POST['termos_insc']);
        $estatuto_int = $mysqli->escape_string($_POST['estatuto_int']);
        $reg_int = $mysqli->escape_string($_POST['reg_int']);
        $dia_fecha_mes = $mysqli->escape_string($_POST['dia_fecha_mes']);        
        $valor_mensalidades = $mysqli->escape_string($_POST['valor_mensalidades']);
        $desconto_mensalidades = $mysqli->escape_string($_POST['desconto_mensalidades']);
        $multa = $mysqli->escape_string($_POST['multa']);
        $joia = $mysqli->escape_string($_POST['joia']);        
        $parcela_joia = $mysqli->escape_string($_POST['parcela_joia']);
        $meses_vence3 = $mysqli->escape_string($_POST['meses_vence3']); 
        $meses_vence5 = $mysqli->escape_string($_POST['meses_vence5']); 
        //$hoje = new DateTime('now');
        /*$dataStr = $nascimento;
        $dataFormatada = DateTime::createFromFormat('d/m/Y', $dataStr);

        $nasc = $dataFormatada->format('Y-m-d');*/
        
        //var_dump($_POST);
           // 
        if($erro) {
            echo "<p><b>ERRO: $erro</b></p>";
        } else {
        //, 
            $sql_code = "UPDATE config_admin
            SET 
            data_alteracao = NOW(),
            logo = '$nova_logo',
            razao = '$razao',
            cnpj = '$cnpj',
            uf = '$uf',
            cep = '$cep',
            cid = '$cid',
            rua = '$rua',
            numero = '$numero',
            bairro = '$bairro',
            nome_tesoureiro = '$nome_tesoureiro',
            presidente = '$presidente',
            vice_presidente = '$vice_presidente',
            email_not = '$email_not',
            email_rec = '$email_rec',
            termos_insc = '$termos_insc',
            estatuto_int = '$estatuto_int',
            reg_int = '$reg_int',
            dia_fecha_mes = '$dia_fecha_mes',       
            valor_mensalidades = '$valor_mensalidades',
            desconto_mensalidades = '$desconto_mensalidades',
            multa = '$multa',
            joia = '$joia',       
            parcela_joia = '$parcela_joia',
            meses_vence3 = '$meses_vence3', 
            meses_vence5 = '$meses_vence5'
            WHERE id = '$id'";

            //echo $nova_logo.'4';
            //var_dump($_POST);

            $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);

            $sql_code = "INSERT INTO histo_config_admin (data_alteracao, logo, razao, cnpj, uf, cep, cid,rua, numero, bairro, 
            nome_tesoureiro, presidente, vice_presidente, email_not, email_rec,termos_insc, estatuto_int, reg_int, dia_fecha_mes, 
            valor_mensalidades, desconto_mensalidades, multa, joia, parcela_joia, meses_vence3, meses_vence5) 
            VALUES(NOW(), '$nova_logo', '$razao', '$cnpj', '$uf', '$cep', '$cid', '$rua', '$numero', '$bairro', 
            '$nome_tesoureiro', '$presidente', '$vice_presidente', '$email_not', '$email_rec', '$termos_insc', '$estatuto_int', '$reg_int', '$dia_fecha_mes', 
            '$valor_mensalidades', '$desconto_mensalidades', '$multa', '$joia', '$parcela_joia', '$meses_vence3', '$meses_vence5')";

            $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
            //var_dump($_POST);
            if($deu_certo) {
                echo "<p><b>Dados atualizado com sucesso!!!</b></p>";
                unset($_POST);
                header("refresh: 5; admin_config.php");
                //header("refresh: 10;../index.php");
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Dados</title>

</head>
<body>

</body>
</html>
