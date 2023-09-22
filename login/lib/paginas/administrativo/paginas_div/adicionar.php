<?php
    include('../../../conexao.php');

    if(!isset($_SESSION)){
        session_start(); 

        if(isset($_SESSION['usuario'])){

            if (isset($_POST["tipoLogin"])) {
                // echo "1";
                $usuario = $_SESSION['usuario'];
                $valorSelecionado = $_POST["tipoLogin"];// Obter o valor do input radio
                $admin = $valorSelecionado;

                if($admin != 1){
                    $usuario = $_SESSION['usuario'];
                    $admin = $_SESSION['admin'];
                    //echo "1";
                    header("Location: ../../usuarios/usuario_home.php");      
                }else{
                    $usuario = $_SESSION['usuario'];
                    $admin = $_SESSION['admin'];
                    $_SESSION['usuario'];
                    $_SESSION['admin'];  
                }
            }  

        }else{
            //echo "5";
            session_unset();
            session_destroy(); 
            header("Location: ../../../../../index.php");  
        }
    
    }else{
        //echo "6";
        session_unset();
        session_destroy(); 
        header("Location: ../../../../../index.php");  
    }

    $id = $_SESSION['usuario'];
    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
    $usuario = $sql_query->fetch_assoc();

    $id_insc = $_GET['id_socio'];
    $sql_insc = $mysqli->query("SELECT * FROM int_associar WHERE id = '$id_insc'") or die($mysqli->$error);
    $inscrito = $sql_insc->fetch_assoc();

    // Verificando se o registro foi encontrado
    if ($inscrito) {
        // Extrair os dados do inscrito
        $apelido = $inscrito['apelido'];
        $nome_completo = $inscrito['nome_completo'];
        
        $nascimento = $inscrito['nascimento'];


        // Construir a consulta SQL para inserir o inscrito
        $sql_inserir_socios = "INSERT INTO socios (nome_completo, apelido, nascimento) VALUES ('$nome_completo', '$apelido', '$nascimento')";

        // Executar a consulta SQL
        if ($mysqli_socios->query($sql_inserir_socios) === TRUE) {
            echo "Inscrito inserido com sucesso em socios.";
        } else {
            echo "Erro ao inserir inscrito em socios: " . $mysqli_socios->error;
        }

        // Fechar a conexão com socios
        $mysqli_socios->close();
    } else {
        echo "Nenhum inscrito encontrado com o ID fornecido.";
    }

    // Fechar a conexão com int_associar
    $mysqli->close();
?>
