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

    $id_insc = $_GET['id_socio'];
    
    // Verificar se o ID foi fornecido corretamente
    if (isset($id_insc)) {
        // Executar a consulta SQL para excluir o inscrito
        $sql_excluir = "DELETE FROM int_associar WHERE id = '$id_insc'";
    
        if ($mysqli->query($sql_excluir)) {
            echo "Inscrito excluído com sucesso.";
            unset($_POST);
            header("refresh: 5; integrarSocio.php");
            
        } else {
            echo "Erro ao excluir inscrito: " . $mysqli->error;
        }
    } else {
        echo "ID do inscrito não fornecido.";
    }
    
    // Fechar a conexão
    $mysqli->close();
    
?>