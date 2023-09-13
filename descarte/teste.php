<?php
    include('../login/lib/conexao.php');

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
            header("Location: ../../../../index.php");  
        }
    
    }else{
        //echo "6";
        session_unset();
        session_destroy(); 
        header("Location: ../../../../index.php");  
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
    <link rel="stylesheet" href="../login/lib/paginas/administrativo/admin_home.css">
    <title>Tela Admin</title>
</head>
<body>
    <div>
        <button id="menuBtn">Menu</button><a> Olá, Admin <?php echo $usuario['apelido']; ?></a><br>
    </div>
    <div class="container">
        <div class="left" id="menu">
            <!-- Conteúdo da div esquerda (opções e configurações) -->
            <ul class="escondido">
                <li><a href="#" onclick="abrirNaDiv('../login/lib/paginas/administrativo/admin_config.php')">Configurações</a></li>
                <li><a href="admin_logout.php">Sair</a></li>
            </ul>             
        </div>

        <div class="center" id="icentro">
            <!-- Conteúdo central (dados escolhidos) -->
 
        </div>
        <div class="right">
            <!-- Conteúdo da div direita (outras atividades) -->
        </div>
    </div>
    <script src="../login/lib/paginas/administrativo/admin_home.js"></script>
</body>
</html>
