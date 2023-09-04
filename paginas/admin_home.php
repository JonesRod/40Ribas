<?php
    include('../login/conexao.php');

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
                        header("Location: ../paginas/usuario_home.php");      
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
            header("Location: ../index.php");  
        }
    
    }else{
        //echo "6";
        session_unset();
        session_destroy(); 
        header("Location: ../index.php");  
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
    <style>
        /* Estilos para ocultar o menu inicialmente */
        .escondido {
            display: none;
        }

        /* Estilos para o botão */
        #menuBtn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Estilos para o menu suspenso */
        #menu {
            list-style: none;
            padding: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            position: absolute;
            z-index: 1;
        }

        #menu li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        #menu li:last-child {
            border-bottom: none;
        }



        



                /* Estilos para o botão de menu */
                .menu-button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: relative;
        }

        /* Estilos para o menu suspenso */
        .menu-dropdown {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Estilos para os itens do menu */
        .menu-item {
            padding: 12px 16px;
            text-decoration: none;
            color: white;
            display: block;
        }

        /* Quando o mouse passa sobre o botão de menu, exibe o menu suspenso */
        .menu-button:hover .menu-dropdown {
            display: block;
        }

    </style>
    <title>Tela Admin</title>
</head>
<body>
    <a>Admin <?php echo $usuario['apelido']; ?></a> <br>

    <button id="menuBtn">Menu</button>
    <ul id="menu" class="escondido">
        <li><a href="admin_config.php">Configurações</a></li>
        <li><a href="admin_logout.php">Sair</a></li>
    </ul>
    
    <div class="menu-button">
        Menu ▼ <!-- Seta para baixo -->
        <div class="menu-dropdown">
            <div></div>
            <div></div>
            <div></div>
            <a class="menu-item" href="#">Configuração</a>
            <a class="menu-item" href="#">Sair</a>
            <!-- Adicione mais itens de menu, se necessário -->
        </div>
    </div>

    <script>
        // Captura o botão e o menu
        // Captura o botão e o menu
        var menuBtn = document.getElementById('menuBtn');
        var menu = document.getElementById('menu');

        // Adiciona um evento de clique ao botão
        menuBtn.addEventListener('click', function() {
            // Alterna a visibilidade do menu
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        });

    </script>

</body>
</html>