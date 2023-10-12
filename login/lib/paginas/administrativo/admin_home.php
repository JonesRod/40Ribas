<?php
    include('../../conexao.php');
    //echo '1';
    //die();
    if(!isset($_SESSION)){
        session_start(); 
        //echo '2';
        //die();
        if($_SERVER["REQUEST_METHOD"] === "POST") {  
            //echo '3';
            if (isset($_POST["tipoLogin"])) {
                //echo '4';
                if(isset($_SESSION['usuario'])){ 
                    //echo '5';
                    // Obter o valor do input radio
                    $usuario = $_SESSION['usuario'];
                    $valorSelecionado = $_POST["tipoLogin"];
                    $admin = $valorSelecionado;

                    if($admin == 0){
                        //echo '6';
                        $_SESSION['usuario'];
                        header("Location: ../usuarios/usuario_home.php");       
                    }else if($admin == 1){
                        //echo '7';
                        $usuario = $_SESSION['usuario'];
                        $admin = $_SESSION['admin'];
                        $_SESSION['usuario'];
                        $_SESSION['admin'];  
                        
                        $id = $_SESSION['usuario'];
                        $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
                        $usuario = $sql_query->fetch_assoc();    
                    }else{
                        //echo '8';
                        session_unset();
                        session_destroy();
                        header("Location: ../../../../index.php"); 
                    }
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
        }else if(isset($_SESSION['usuario'])){    
            //echo '3';
            //die();
            $usuario = $_SESSION['usuario'];
            $admin = $_SESSION['admin'];
            $_SESSION['usuario'];
            $_SESSION['admin'];  
    
            $id = $_SESSION['usuario'];
            $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
            $usuario = $sql_query->fetch_assoc();    
    
        }else{

            session_unset();
            session_destroy();
            header("Location: ../../../../index.php"); 
        }
    }else if(isset($_SESSION['usuario'])){    
        //echo '3';
        //die();
        $usuario = $_SESSION['usuario'];
        $admin = $_SESSION['admin'];
        $_SESSION['usuario'];
        $_SESSION['admin'];  

        $id = $_SESSION['usuario'];
        $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
        $usuario = $sql_query->fetch_assoc();    

    }else{
        //echo '4';
        //die();
        if($_SERVER["REQUEST_METHOD"] === "POST") {  

            if (isset($_POST["tipoLogin"])) {
                // Obter o valor do input radio
                $usuario = $_SESSION['usuario'];
                $valorSelecionado = $_POST["tipoLogin"];
                $admin = $valorSelecionado;

                if($admin == 0){

                    $_SESSION['usuario'];
                    header("Location: ../usuario_home.php");       
                }else if($admin == 1){
                    $usuario = $_SESSION['usuario'];
                    $admin = $_SESSION['admin'];
                    $_SESSION['usuario'];
                    $_SESSION['admin'];  

                    $id = $_SESSION['usuario'];
                    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
                    $usuario = $sql_query->fetch_assoc();    

                }else{

                    session_unset();
                    session_destroy();
                    header("Location: ../../../../index.php"); 
                }
            }  
        }else{

            session_unset();
            session_destroy();
            header("Location: ../../../../index.php"); 
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="admin_home.css">
    <script>
        //atualiza a pagian a cada 10 min
        setTimeout(function() {
            location.reload();
        }, 1000000);
        
        // Função para carregar o conteúdo na div
        function abrirNaDiv(pagina) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("iconteudo").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", pagina, true);
            xhttp.send();
        }

        // Carregar a página de início ao carregar a página
        window.onload = function() {
            abrirNaDiv('paginas_div/inicio.php');
        }
    </script>
    <title>Tela Admin</title>
</head>
<body>

    <div id="idivMenu">
        <div id="imenuBtn" onclick="toggleMenu()">
            <div class="iconeMenu"></div>
            <div class="iconeMenu"></div>
            <div class="iconeMenu"></div>
        </div> 
        <div id="iusuario"> 
            <a> Olá, <?php echo $usuario['apelido']; ?></a> 
        </div> 
    </div>

    <div class="titulo">
        <div class="menu" id="imenu">
            <ul id="ilista" class="lista">
                <li><a href="#" onclick="abrirNaDiv('paginas_div/inicio.php');toggleMenu()">Inicío</a></li>
                <li><a href="#" onclick="abrirNaDiv('paginas_div/admin_config.php');toggleMenu()">Configurações</a></li> 
                <li><a href="#" onclick="abrirNaDiv('paginas_div/integrarSocio.php');toggleMenu()">Integrar de Sócios</a></li>  
                <li><a href="#" onclick="abrirNaDiv('paginas_div/incluir_joia.php');toggleMenu()">Incluir Jóia</a></li> 
                <li><a href="#" onclick="abrirNaDiv('paginas_div/joia_para_receber.php');toggleMenu()">Jóia á Receber</a></li>
                <li><a href="#" onclick="abrirNaDiv('paginas_div/listaSocios.php');toggleMenu()">Lista de Sócios</a></li>              
                <li><a href="#" onclick="abrirNaDiv('paginas_div/GerarMensalidades.php');toggleMenu()">Gerar Mensalidades</a></li>
                <li><a href="#" onclick="abrirNaDiv('paginas_div/CarregarMensalidades.php');toggleMenu()">Carregar Mensalidades</a></li>
                <li><a href="admin_logout.php">Sair</a></li>
            </ul> 
        </div> 
        <div id="ititulo">
           <H1>Associação 40Ribas</H1> 
        </div>      
    </div>
    <div class="container">
        <div class="left">
            <!-- Conteúdo da div direita (outras atividades) -->
            <div class="aniver">
                <h3>Aniversariantes do mês de 
                    <?php
                        $meses = [
                            1 => 'Janeiro',
                            2 => 'Fevereiro',
                            3 => 'Março',
                            4 => 'Abril',
                            5 => 'Maio',
                            6 => 'Junho',
                            7 => 'Julho',
                            8 => 'Agosto',
                            9 => 'Setembro',
                            10 => 'Outubro',
                            11 => 'Novembro',
                            12 => 'Dezembro'
                        ];

                        $mes_atual = date('n');
                        $nome_mes = $meses[$mes_atual];
                        echo $nome_mes;
                    ?>
                </h3>
                <?php
                    // Agora, vamos buscar os aniversariantes do mês
                    $result = $mysqli->query("SELECT * FROM socios WHERE MONTH(nascimento) = $mes_atual ORDER BY DAY(nascimento)") or die($mysqli->error);

                    // Verifica se há resultados
                    if ($result->num_rows > 0) {
                        echo "<p>Total de Aniversariantes: " . $result->num_rows . "</p>";
                        echo "<table border='1'>";
                        echo "<tr>
                                <th>Data Nasc.</th>
                                <th>Apelido</th>
                                <th>Nome</th>
                                <th>Idade</th>
                            </tr>";

                        while($row = $result->fetch_assoc()) {
                            $nascimento_formatado = date('d/m/Y', strtotime($row["nascimento"]));
                            $dataNascimento = new DateTime($row["nascimento"]);
                            $intervalo = $dataNascimento->diff(new DateTime());
                            $idade = $intervalo->y;

                            echo "<tr>
                                <td>" . $nascimento_formatado . "</td>
                                <td>" . $row["apelido"] . "</td>
                                <td style='text-align: left; padding-left: 5px;'>" . $row["nome_completo"] . "</td>
                                <td>" . $idade . "</td>
                            </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Nenhum Aniversariante!";
                    }
                ?>
            </div>
            <div class="aniver">
                <h3>Aniversáriantes de Hoje</h3>
                <?php
                    // Obtém a data atual
                    $dataAtual = date('m-d');
                    
                    // Executa a consulta para obter a lista de aniversariantes do dia
                    $sql = "SELECT * FROM socios WHERE DATE_FORMAT(nascimento, '%m-%d') = '$dataAtual'";
                    $result = $mysqli->query($sql);

                    // Verifica se há resultados
                    if ($result->num_rows > 0) {
                        echo "<p>Total de Aniversariantes: " . $result->num_rows . "</p>";

                        // Exibe os dados em uma tabela
                        echo "<table border='1'>";
                        echo "<tr>
                                <th>Data Nasc.</th>
                                <th>Apelido</th>
                                <th>Nome</th>
                                <th>Idade</th>
                            </tr>";

                        while($row = $result->fetch_assoc()) {
                            $nasc = $row['nascimento'];

                            $dataNascimento = new DateTime($nasc);
                            $dataAtual = new DateTime();
                            $intervalo = $dataNascimento->diff($dataAtual);
                            $idade = $intervalo->y;

                            $nascimento_formatado = date('d/m/Y', strtotime($row["nascimento"]));

                            echo "<tr>
                                    <td>" . $nascimento_formatado. "</td>
                                    <td>" . $row["apelido"] . "</td>
                                    <td style='text-align: left; padding-left: 5px;'>" . $row["nome_completo"] . "</td>
                                    <td>" . $idade . "</td>
                                </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Nenhum Aniversariante!";
                    }
                    // Fecha a conexão
                    //$mysqli->close();
                ?>
            </div>
            <div class="aniver">
                <h3>Aniversáriantes de Amanhâ</h3>
                <?php
                    // Obtém a data de amanhã
                    $dataAmanha = date('m-d', strtotime('+1 day'));
                    
                    // Executa a consulta para obter a lista de aniversariantes do dia
                    $sql = "SELECT * FROM socios WHERE DATE_FORMAT(nascimento, '%m-%d') = '$dataAmanha'";
                    $result = $mysqli->query($sql);

                    // Verifica se há resultados
                    if ($result->num_rows > 0) {
                        echo "<p>Total de Aniversariantes: " . $result->num_rows . "</p>";

                        // Exibe os dados em uma tabela
                        echo "<table border='1'>";
                        echo "<tr>
                                <th>Data Nasc.</th>
                                <th>Apelido</th>
                                <th>Nome</th>
                                <th>Idade</th>
                            </tr>";

                        while($row = $result->fetch_assoc()) {
                            $nasc = $row['nascimento'];

                            $dataNascimento = new DateTime($nasc);
                            $dataAtual = new DateTime();
                            $intervalo = $dataNascimento->diff($dataAtual);
                            $idade = $intervalo->y;

                            $nascimento_formatado = date('d/m/Y', strtotime($row["nascimento"]));

                            echo "<tr>
                                    <td>" . $nascimento_formatado. "</td>
                                    <td>" . $row["apelido"] . "</td>
                                    <td style='text-align: left; padding-left: 5px;'>" . $row["nome_completo"] . "</td>
                                    <td>" . $idade . "</td>
                                </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Nenhum Aniversariante!";
                    }
                    // Fecha a conexão
                    //$mysqli->close();
                ?>
            </div>

        </div>
        <div class="conteudo" id="iconteudo">
            <!-- Conteúdo central (dados escolhidos) -->
        </div>
    </div>
    <script src="admin_home.js"></script>
</body>
</html>
