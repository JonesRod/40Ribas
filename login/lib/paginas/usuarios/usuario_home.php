<?php
    include('../../conexao.php');

    if(!isset($_SESSION)){
        session_start(); 

        if(isset($_SESSION['usuario'])){
            //if($_SERVER["REQUEST_METHOD"] === "POST") {  

                if (isset($_POST["tipoLogin"])) {
                    // Obter o valor do input radio
                    $usuario = $_SESSION['usuario'];
                    $valorSelecionado = $_POST["tipoLogin"];
                    $admin = $valorSelecionado;

                    /*if($admin != 1){
                        //echo "3"; 
                        // Destruir todas as variáveis de sessão
                        //session_unset();
                        //session_destroy();
                        //echo $_SESSION['id'];
                        echo "1" . $usuario . $admin; 
                        //header("Location: ../index.php");
                        $_SESSION['usuario'];
                        $_SESSION['admin'];
                        //header("Location: ../paginas/usuario_home.php");       
                    }else*///if{
                        $usuario = $_SESSION['usuario'];
                        $admin = $_SESSION['admin'];
                        $_SESSION['usuario'];
                        $_SESSION['admin'];       
                    //}
                }  
            /*}else{
                session_unset();
                session_destroy();
                header("Location: ../index.php"); 
            }*/
        }else{
            session_unset();
            session_destroy();
            header("Location: ../../../../index.php"); 
        }
    }else{
        session_unset();
        session_destroy();
        header("Location: ../../../../index.php"); 
    }

    $id = $_SESSION['usuario'];
    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
    $usuario = $sql_query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site</title>
</head>
<body>
    <div>
        <img src="<?php echo $usuario['foto']; ?>" style="max-width: 100px;" alt=""><br>
    </div>
    <p>
        <a>Seja Bem Vindo, <?php echo $usuario['apelido']; ?></a><br>
        <a href="perfil.php">Meu Perfil</a><br>
        <a href="usuario_logout.php">Sair</a>
    </p>

</body>
</html>