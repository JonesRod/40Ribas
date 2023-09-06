<?php
    include('../../conexao.php');

    if(!isset($_SESSION)){
        session_start(); 

        if(isset($_SESSION['usuario'])){

            //if($_SERVER["REQUEST_METHOD"] === "POST") {  

                if (isset($_POST["tipoLogin"])) {
                   // echo "1";
                    $usuario = $_SESSION['usuario'];
                    $valorSelecionado = $_POST["tipoLogin"];// Obter o valor do input radio
                    $admin = $valorSelecionado;

                    if($admin != 1){
                        $usuario = $_SESSION['usuario'];
                        $admin = $_SESSION['admin'];
                        //echo "1";
                        header("Location: ../usuarios/usuario_home.php");      
                    }else{
                        $usuario = $_SESSION['usuario'];
                        $admin = $_SESSION['admin'];
                        $_SESSION['usuario'];
                        $_SESSION['admin'];       
                    }
                }  
                /*if($admin != 1){
                    echo "2";
                    session_unset();
                    session_destroy();
                    //header("Location: ../index.php");      
                }else{
                    echo "3";
                    $usuario = $_SESSION['usuario'];
                    $admin = $_SESSION['admin'];
                }
            }else{
                echo "4";
                session_unset();
                session_destroy();
                //header("Location: ../index.php"); 
            }*/
        }else{
            //echo "5";
            session_unset();
            session_destroy(); 
            header("Location: ../../../index.php");  
        }
    
    }else{
        //echo "6";
        session_unset();
        session_destroy(); 
        header("Location: ../../../index.php");  
    }

    $id = $_SESSION['usuario'];
    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
    $usuario = $sql_query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_config.css">
    <title>Tela Admin</title>
</head>
<body>
    <a>Admin <?php echo $usuario['apelido']; ?></a> <br>

    <button id="menuBtn">Menu</button>
    <ul id="menu" class="escondido">
        <li><a href="admin_config.php">Configurações</a></li>
        <li><a href="admin_logout.php">Sair</a></li>
    </ul>   
    <script src="admin_home.js"></script>
</body>
</html>