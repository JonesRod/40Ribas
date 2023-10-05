<?php 

    include('../../../../conexao.php');

    if(!isset($_SESSION)){
        session_start(); 

        if(isset($_SESSION['usuario'])){

            if (isset($_POST["tipoLogin"])) {
                $usuario_sessao = $_SESSION['usuario'];
                $valorSelecionado = $_POST["tipoLogin"];
                $admin = $valorSelecionado;

                if($admin != 1){
                    header("Location: ../../../usuarios/usuario_home.php");      
                } else {
                    $_SESSION['usuario'];
                    $_SESSION['admin'];  
                }
            }  

        } else {
            session_unset();
            session_destroy(); 
            header("Location: ../../../../../../index.php");  
        }
    } else {
        if(isset($_SESSION['usuario'])){

            if (isset($_POST["tipoLogin"])) {
                $usuario_sessao = $_SESSION['usuario'];
                $valorSelecionado = $_POST["tipoLogin"];
                $admin = $valorSelecionado;

                if($admin != 1){
                    header("Location: ../../../usuarios/usuario_home.php");      
                } else {
                    $_SESSION['usuario'];
                    $_SESSION['admin'];  
                }
            }  

        } else {
            session_unset();
            session_destroy(); 
            header("Location: ../../../../../../index.php");  
        }
 
    }

    $msg= false;

    if(isset($_POST['senha'])) {
        
        $senha_usuario = $mysqli->escape_string($_POST['senha']);
        
        if(strlen($_POST['senha']) == 0 ) {
            $msg= true;
            $msg = "Preencha sua senha.";
            echo $msg;
        } else {

            $sql_code = "SELECT * FROM socios WHERE admin = '1'";
            $sql_query =$mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->$error);
            $usuario_sessao = $sql_query->fetch_assoc();
            $quantidade = $sql_query->num_rows;//retorna a quantidade encontrado

            if(($quantidade ) >= 1) {

                if(password_verify($senha_usuario, $usuario_sessao['senha'])) {
                
                    // Nome do arquivo de backup
                    $backupFile = 'backup_' . date('Y-m-d') . '.sql';
                
                    // pega os Nomes dos dados de acesso do banco
                    $usuario = $mysqli->real_escape_string($usuario);
                    $database = $mysqli->real_escape_string($banco);

                    var_dump($usuario);
                    var_dump($senha);
                    var_dump($host);
                    var_dump($database);
                    var_dump($backupFile);   
                                     
                    /*// Comando para realizar o backup
                    $commandBackup = "mysqldump --user={$usuario} --password={$senha} --host={$host} {$database} > {$backupFile}";
                    
                    var_dump($commandBackup);  
                    // Executa o comando de backup
                    exec($commandBackup, $output, $return);
                    
                    if ($return === 0) {
                        echo "Backup realizado com sucesso.";

                    } else {
                        echo "Erro ao realizar o backup. Detalhes: " . implode("\n", $output);
                    }*/
                    $commandBackup = "mysqldump --user={$usuario} --password={$senha} --host={$host} {$database} > {$backupFile} 2>&1";
                    exec($commandBackup, $output, $return);

                    if ($return === 0) {
                        echo "Backup realizado com sucesso.";
                    } else {
                        echo "Erro ao realizar o backup. Detalhes: " . implode("\n", $output);
                    }


                    // Verifica se a conexão foi estabelecida
                    if ($mysqli->connect_error) {
                        die("Falha na conexão: " . $mysqli->connect_error);
                    }
                die();                
                    // Obtém a lista de tabelas no banco de dados
                    $result = $mysqli->query("SHOW TABLES");
                    $tables = [];
                
                    while ($row = $result->fetch_row()) {
                        $tables[] = $row[0];
                    }
                
                    // Exclui todos os dados das tabelas
                    foreach ($tables as $table) {
                        $mysqli->query("DELETE FROM $table");
                    }
                
                    // Fecha a conexão
                    $mysqli->close();
                
                    $msg = "Backup realizado e dados excluídos com sucesso.";
                
                    unset($_POST);
                    header("refresh: 5; ../admin_logout.php");

                }else{
                    $msg = true;
                    $msg = "Senaha inválida!";    
                    //echo $msg;
                }
            }else{
                $msg = "";  
                //echo 'oii';
                // Fecha a conexão
                $mysqli->close();
            }
        }
    } 
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Resetar Sócios</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }

        #iform {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /*sombra*/

        }

        #ititulo {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        #msg {
            color: red;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            text-align: left;
            margin-left: 15px;
        }

        #senhaInput{
            width: 85%;
            padding: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            text-align: left;
            display: block;
            margin-left: 15px;
        }

        #senhaInputContainer {
            position: relative;
        }

        #toggleSenha {
            position: absolute;
            right: 0px;
            top: 75%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
    <form id ="iform" action="" method="POST" >
        <h1 id="ititulo">Confirmação para Resetar</h1>
        <p>
            Você realmente deseja resetar e excluir todos os dados armazenado?
        </p>
        <p>
            Caso click em 'Reset': Os dados serão todos apagados, mas estarão disponiveis no Backup.
        </p>
        <span id="msg"><?php echo $msg; ?></span>
        <p>
            <div id="senhaInputContainer">
                <label for="">Senha do admin: </label>
                <input required placeholder="Minimo 8 digitos" id="senhaInput" value="<?php if(isset($_POST['senha'])) echo $_POST['senha']; ?>" type="password" name="senha">
                <span id="toggleSenha" onclick="toggleSenha()">👁️</span>
            </div>
        </p>
        <p>
            <a href="../../index.php">Voltar para tela de login</a>
            <button type="submit">Reset</button>
        </p>
    </form>
</body>
</html>