<?php
    /*include('login/lib/conexao.php');
    //echo 'oi';
    if(!isset($_SESSION)){
        session_start(); 

        if(isset($_SESSION['usuario'])){

            if (isset($_POST["tipoLogin"])) {
                // echo "1";
                $usuario = $_SESSION['usuario'];
                $valorSelecionado = $_POST["tipoLogin"];// Obter o valor do input radio
                $admin = $valorSelecionado;

                if($admin != 1){
                    $id = $_SESSION['usuario'];
                    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
                    $usuario = $sql_query->fetch_assoc();

                    $usuario = $_SESSION['usuario'];
                    $admin = $_SESSION['admin'];
                    //echo "1";
                    header("Location: login/lib/paginas/usuarios/usuario_home.php");    
                }else{
                    $id = $_SESSION['usuario'];
                    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
                    $usuario = $sql_query->fetch_assoc();

                    $usuario = $_SESSION['usuario'];
                    $admin = $_SESSION['admin'];
                    $_SESSION['usuario'];
                    $_SESSION['admin'];  
                    header("Location: login/lib/paginas/administrativo/admin_home.php");       
                }
            }  

        }else{
            //echo "5";
            session_unset();
            session_destroy(); 
            header("Location: index.php");  
        }
    
    }else{
        //echo "6";
        session_unset();
        session_destroy(); 
        header("Location: index.php");  
    }

    /*$id = $_SESSION['usuario'];
    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
    $usuario = $sql_query->fetch_assoc();*/
//--------------------
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
    $cpf = $mysqli->escape_string($_POST['email']);
    $senha = $mysqli->escape_string($_POST['senha']);
    

    //echo "oii";
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $senha = password_hash($_SESSION['senha'], PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO senha (email, senha, cpf) VALUES('$email','$senha','$cpf')");
    }
    if(strlen($_POST['email']) == 0 ) {
        $msg= true;
        $msg = "Preencha o campo Usuário.";
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
                $msg = "Usúario ou Senha estão inválidos!1";    
                //echo $msg;
            }
        }else{

            $sql_cpf = "SELECT * FROM socios WHERE cpf = '$cpf' LIMIT 1";
            $sql_query =$mysqli->query($sql_cpf) or die("Falha na execução do código SQL: " . $mysqli->$error);
            $usuario = $sql_query->fetch_assoc();
            $quantidade_cpf = $sql_query->num_rows;//retorna a quantidade encontrado
    
            if(($quantidade_cpf) == 1) {
    
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
                    $mysqli->close(); 
                    //echo $msg;
                }
            }else{
                $msg= true;
                $msg = "O Usúario informado não esta correto ou não está cadastrado!";
                $mysqli->close();
                //echo $msg;
            }
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
    <title>Entrar</title>
    <script>
        function toggleSenha() {
            var senhaInput = document.getElementById('senhaInput');
            var toggleSenha = document.getElementById('toggleSenha');

            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                toggleSenha.textContent = '👁️';
            } else {
                senhaInput.type = 'password';
                toggleSenha.textContent = '👁️';
            }
        }
    </script>
</head>
<body>  
    <form id ="login" action="" method="POST" >
        <img id="img" alt="">
        <h1 id="ititulo">Entrar</h1>
        <span id="msg"><?php echo $msg; ?></span>
        <p>
            <label id="email" for="iemail">Usuário</label>
            <input required type="text" name="email" id="iemail" placeholder="E-mail ou CPF" oninput="formatarCampo(this)" value="<?php //if(isset($_POST['email'])) echo $_POST['email']; ?>">
        </p>
        <p>
            <label id="senha" for="senha">Senha</label>
            <input required type="password" name="senha" id="senhaInput" placeholder="Sua Senha" value="<?php //if(isset($_POST['senha'])) echo $_POST['senha']; ?>">
            <span id="toggleSenha" onclick="toggleSenha()">👁️</span>
        </p>
        <p> 
            <a style="margin-right:10px;" href="inscricao/ficha_inscricao.html">Quero ser sócio.</a> 
            <a style="margin-right:10px;" href="login/lib/Recupera_Senha.php">Esqueci minha Senha!</a> 
        </p>
        <button type="submit">Entrar</button>

    </form>
    <script>
        function formatarCampo(input) {
            let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (/^[0-9]+$/.test(value)) {
                if (value.length > 9) {
                    value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                } else if (value.length > 6) {
                    value = value.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');
                } else if (value.length > 3) {
                    value = value.replace(/(\d{3})(\d{3})/, '$1.$2');
                }
                input.value = value; 
            }

            if (value.includes('@')) {
                // Se o valor contiver '@', formatar como E-mail
                let emailElement = document.getElementById('iemail');
                emailElement.textContent = value;
            }
        }
    </script>
</body>
</html>