<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Entrar</title>
</head>
<body>
    <div>
        <?php

            include("../login/conexao.php");
            include("../login/protect.php");

            $msg= false;
            $email = $_POST['email'];//$mysqli->escape_string SERVE PARA PROTEGER O ACESSO 
            $senha = $_POST['senha'];

            if (isset($_POST['email']) || isset($_POST['senha'])) {

                if(strlen($_POST['email']) == 0 ) {
                    $msg= true;
                    $msg = "Preencha o campo E-mail.";
                    echo $msg;
                } else if(strlen($_POST['senha']) == 0 ) {
                    $msg= true;
                    $msg = "Preencha sua senha.";
                    echo $msg;
                } else {

                    $sql_code = "SELECT * FROM socios WHERE email = '$email' LIMIT 1";
                    $sql_query =$mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->$error);
                    $usuario = $sql_query->fetch_assoc();
                    $quantidade = $sql_query->num_rows;//retorna a quantidade encontrado

                    if(($quantidade ) == 1) {
                        if(password_verify($senha, $usuario['senha'])) {
                            if(!isset($_SESSION))
                                session_start();

                                $_SESSION['usuario'] = $usuario['id'];
                                //$_SESSION['admin'] = $usuario['admin'];
                                unset($_POST);
                                header("Location: ../paginas/home.php");
                        }else{
                            //$msg= true;
                            $msg = "Usúario ou Senha estão inválidos!";
                            echo $msg;
                        }
                    }else{
                        //$msg= true;
                        $msg = "O e-mail informado não esta correto ou não está cadastrado!";
                        echo $msg;
                    }
                }   
            }
        ?>
    </div>
</body>
</html>