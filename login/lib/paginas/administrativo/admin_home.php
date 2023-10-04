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
<?php
/*
    include('../../conexao.php');
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
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="admin_home.css">
    <script>
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
    <div>
        <div id="idivMenu">
            <div id="imenuBtn" onclick="toggleMenu()">
                <div class="iconeMenu"></div>
                <div class="iconeMenu"></div>
                <div class="iconeMenu"></div>
            </div>  
            <a> Olá, <?php echo $usuario['apelido']; ?></a>  
        </div>
    </div>
    <div class="titulo">
        <div class="menu" id="imenu">
            <ul id="ilista" class="lista">
                <li><a href="#" onclick="abrirNaDiv('paginas_div/inicio.php');toggleMenu()">Inicío</a></li>
                <li><a href="admin_config.php">Configurações</a></li> 
                <li><a href="#" onclick="abrirNaDiv('paginas_div/integrarSocio.php');toggleMenu()">Integrar de Sócios</a></li>  
                <li><a href="#" onclick="abrirNaDiv('paginas_div/incluir_joia.php');toggleMenu()">Incluir Jóia</a></li> 
                <li><a href="#" onclick="abrirNaDiv('paginas_div/joia_para_receber.php');toggleMenu()">Jóia á Receber</a></li>
                <li><a href="#" onclick="abrirNaDiv('paginas_div/listaSocios.php');toggleMenu()">Lista de Sócios</a></li>              
                <li><a href="#" onclick="abrirNaDiv('paginas_div/GerarMensalidades.php');toggleMenu()">Gerar Mensalidades</a></li>
                <li><a href="#" onclick="abrirNaDiv('paginas_div/CarregarMensalidades.php');toggleMenu()">Carregar Mensalidades</a></li>
                <li><a href="paginas_div/resetar/excluir_todos_socios.php">Resetar</a></li>
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
                                <td>" . $row["nome_completo"] . "</td>
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
                    // Executa a consulta para obter a lista de sócios
                    $sql = "SELECT * FROM socios";
                    $result = $mysqli->query($sql);

                    // Verifica se há resultados
                    if ($result->num_rows > 0) {

                        $nasc = $usuario['nascimento'];
                        $dataAtual = date('Y-m-d');
                        //echo $dataAtual;
                        // Converte a data de nascimento em um objeto DateTime
                        $dataNascimento = new DateTime($nasc);
                        //echo $dataNascimento;
                        // Obtém o mês e o dia da data de nascimento
                        $mesNascimento = $dataNascimento->format('m');
                        $diaNascimento = $dataNascimento->format('d');

                        // Obtém o mês e o dia da data atual
                        $mesAtual = date('m');
                        $diaAtual = date('d');

                        // Obtém a data atual
                        $dataAtual = new DateTime();

                        // Calcula a diferença entre a data atual e a data de nascimento
                        $intervalo = $dataNascimento->diff($dataAtual);

                        // Obtém o ano de diferença
                        $idade = $intervalo->y;

                        //echo "A idade do usuário é: " . $idade . " anos.";
                        // Verifica se é o aniversário do usuário
                        if ($mesNascimento == $mesAtual && $diaNascimento == $diaAtual) {
                            // Exibe o total de aniversariantes                            
                            echo "<p>Total de Aniversáriantes: " . $result->num_rows . "</p>";

                            // Exibe os dados em uma tabela
                            echo "<table border='1'>";
                            echo "<tr>
                                    <th>Data Nasc.</th>
                                    <th>Apalido</th>
                                    <th>Nome</th>
                                    <th>Idade</th>
                                    
                                </tr>";//<th></th>
                            while($row = $result->fetch_assoc()) {

                                $nascimento_formatado = date('d/m/Y', strtotime($row["nascimento"]));
                                echo "<tr>
                                    <td>" . $nascimento_formatado. "</td>
                                        <td>" . $row["apelido"] . "</td>
                                        <td>" . $row["nome_completo"] . "</td>
                                        <td>" . $idade . "</td>
                                        
                                    </tr>";//<td><a href='receber_pagamento.php?id=" . $row["id"] . "'>Receber</a></td>
                                //}
                            }
                            echo "</table>";
                        } else {
                            echo "Nenhum Aniversáriante!";
                        }
                    } else {
                        echo "Nenhum Aniversáriante!";
                    }

                    // Fecha a conexão
                    //$mysqli->close();
                ?>
            </div>
            <div class="aniver">
                <h3>Aniversáriantes de Amanhâ</h3>
                <?php
                    // Executa a consulta para obter a lista de sócios
                    $sql = "SELECT * FROM socios";
                    $result = $mysqli->query($sql);

                    // Verifica se há resultados
                    if ($result->num_rows > 0) {

                        $nasc = $usuario['nascimento'];
                        $dataAtual = date('Y-m-d');
                        //echo $dataAtual;
                        // Converte a data de nascimento em um objeto DateTime
                        $dataNascimento = new DateTime($nasc);
                        //echo $nasc;
                        // Obtém o mês e o dia da data de nascimento
                        $mesNascimento = $dataNascimento->format('m');
                        $diaNascimento = $dataNascimento->format('d');

                        // Obtém o mês e o dia da data atual
                        $mesAtual = date('m');
                        $diaAtual = date('d');

                        // Obtém a data atual
                        $dataAtual = new DateTime();

                        // Calcula a diferença entre a data atual e a data de nascimento
                        $intervalo = $dataNascimento->diff($dataAtual);

                        // Obtém o ano de diferença
                        $idade = $intervalo->y;

                        //echo "A idade do usuário é: " . $idade . " anos.";
                        // Verifica se é o aniversário do usuário
                        if ($mesNascimento == $mesAtual && $diaNascimento == $diaAtual + 1) {
                            // Exibe o total de aniversariantes                            
                            echo "<p>Total de Aniversáriantes: " . $result->num_rows . "</p>";

                            // Exibe os dados em uma tabela
                            echo "<table border='1'>";
                            echo "<tr>
                                    <th>Data Nasc.</th>
                                    <th>Apalido</th>
                                    <th>Nome</th>
                                    <th>Idade</th>
                                    
                                </tr>";//<th></th>
                            while($row = $result->fetch_assoc()) {

                                $nascimento_formatado = date('d/m/Y', strtotime($row["nascimento"]));
                                echo "<tr>
                                    <td>" . $nascimento_formatado. "</td>
                                        <td>" . $row["apelido"] . "</td>
                                        <td>" . $row["nome_completo"] . "</td>
                                        <td>" . $idade . "</td>
                                        
                                    </tr>";//<td><a href='receber_pagamento.php?id=" . $row["id"] . "'>Receber</a></td>
                                //}
                            }
                            echo "</table>";
                        } else {
                            echo "Nenhum Aniversáriante!";
                        }
                    } else {
                        echo "Nenhum Aniversáriante!";
                    }

                    // Fecha a conexão
                    $mysqli->close();
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
