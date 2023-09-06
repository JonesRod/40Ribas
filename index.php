<?php
include("login/lib/conexao.php");

if(isset($_SESSION)) {
    
    $usuario = $_SESSION['usuario'];
    $admin = $_SESSION['admin'];

    if($admin == 1 ){
        //echo "2";  
       header("Location: login/lib/paginas/administrativo/admin_home.php");       
    }else{
        //echo "3";  
        header("Location: login/lib/paginas/usuarios/usuario_home.php");  
    }
}
if(!isset($_SESSION)){
    session_start(); 
}

$msg= false;

if(isset($_POST['email']) || isset($_POST['senha'])) {

    $email = $mysqli->escape_string($_POST['email']);//$mysqli->escape_string SERVE PARA PROTEGER O ACESSO 
    $senha = $mysqli->escape_string($_POST['senha']);

    //echo "oii";
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $senha = password_hash($_SESSION['senha'], PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO senha (email, senha) VALUES('$email','$senha')");

    }
    if(strlen($_POST['email']) == 0 ) {
        $msg= true;
        $msg = "Preencha o campo E-mail.";
        //echo $msg;
    } else if(strlen($_POST['senha']) == 0 ) {
        $msg= true;
        $msg = "Preencha sua senha.";
        //echo $msg;
    } else {

        $sql_code = "SELECT * FROM socios WHERE email = '$email' LIMIT 1";
        $sql_query =$mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->$error);
        $usuario = $sql_query->fetch_assoc();
        $quantidade = $sql_query->num_rows;//retorna a quantidade encontrado

        if(($quantidade ) == 1) {

            if(password_verify($senha, $usuario['senha'])) {

                $admin = $usuario['admin'];

                if($admin == 1){
                    $_SESSION['usuario'] = $usuario['id'];
                    $_SESSION['admin'] = $admin;
                    //$msg = "1";
                    unset($_POST);
                    header("Location: login/lib/tipo_login.php");
                }else if($admin != 1){
                    $_SESSION['usuario'] = $usuario['id'];
                    $_SESSION['admin'] = $admin;
                    //$msg = "2";
                    unset($_POST);
                    header("Location: login/lib/paginas/usuario_home.php");
                }    
            }else{
                $msg= true;
                $msg = "Usúario ou Senha estão inválidos!";    
                //echo $msg;
            }
        }else{
            $msg= true;
            $msg = "O e-mail informado não esta correto ou não está cadastrado!";
            //echo $msg;
        }
    }
}   

?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/style/index.css">
    <link rel="stylesheet" href="login/style/media-query.css">

    <title>Entrar</title>
</head>
<body>
    <main class="conteiner">   
        <form id ="login" action="" method="POST" >
            <img id="img" alt="">
            <h1 id="titulo">Entrar</h1>
            <span id="msg"><?php echo $msg; ?></span>
            <p>
                <label id="email" for="iemail">E-mail</label>
                <input required type="email" name="email" id="iemail" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
            </p>
            <p>
                <label id="senha" for="">Senha</label>
                <input required type="password" name="senha" value="<?php if(isset($_POST['senha'])) echo $_POST['senha']; ?>">
            </p>
            <p> 
                <a style="margin-right:10px;" href="inscricao/ficha_inscricao.html">Quero ser sócio.</a> 
                <a style="margin-right:10px;" href="login/lib/Recupera_Senha.php">Esqueci minha Senha!</a> 
            </p>
            <button type="submit">Entrar</button>

        </form>
    </main>
</body>
</html>