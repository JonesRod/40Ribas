<?php
    include('conexao.php');

    if(!isset($_SESSION)){
        session_start();
       // echo "sem"; 
        if(isset($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
            $admin = $_SESSION['admin'];  
            
            if($admin != 1){
                $usuario = $_SESSION['usuario'];
                $admin = $_SESSION['admin'];
                header("Location: ../paginas/usuario_home.php");      
            }else{
                $usuario = $_SESSION['usuario'];
                $admin = $_SESSION['admin'];
 
                $id = $_SESSION['usuario'];
                $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
                $usuario = $sql_query->fetch_assoc(); 
            }
        }else{
            // Destruir todas as variáveis de sessão
            session_unset();
            session_destroy();
            header("Location: ../index.php");  
        }
    }else{
            // Destruir todas as variáveis de sessão
            session_unset();
            session_destroy();
            header("Location: ../index.php");  
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <main>
        <h2>Olá, <?php echo $usuario['apelido']; ?></h2>
        <h3>Escolha o tipo de login:</h3>
        <form id="escolherLoginForm" method="POST" action="../paginas/admin_home.php" onsubmit="return resposta()">
            <label>
                <input type="radio" name="tipoLogin" value="1"> Admin
            </label>
            <label>
                <input type="radio" name="tipoLogin" value="0"> Usuário
            </label>
            <a id="iresposta" href="outra-pagina.html" type="hidden"></a>

            <button type="submit" onclick="responder()">Logar</button><!---->
        </form>

    </main>
    <script>
        function responder() {
            var escolha = document.querySelector('input[name="tipoLogin"]:checked').value;
            //console.log(escolha);
            if (escolha === "1") {
                //document.getElementById("iresposta").href="../paginas/admin_home.php";
                document.getElementById("iresposta").click();
            } else if (escolha === "0") {
                //document.getElementById("iresposta").href="../paginas/usuario_home.php";
                document.getElementById("iresposta").click();
            }
        }
        
        function resposta() {
            var radioSelecionado = document.querySelector('input[name="tipoLogin"]:checked');

            if (!radioSelecionado) {
                alert("Selecione uma opção antes de enviar o formulário.");
                return false; // Impede o envio do formulário
            }
            return true; // Permite o envio do formulário
        }

    </script>
</body>
</html>
