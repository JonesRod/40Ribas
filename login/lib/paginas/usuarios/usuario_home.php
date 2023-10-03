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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="usuario_home.css">
    <script>

    </script>
    <title>Meu Site</title>
</head>
<body>

    <div id="idivMenu">
        <div id="imenuBtn" onclick="<?php if (!isset($_SESSION['usuario'])) { ?>
                location.reload();
            <?php } else { ?>
                toggleMenu();   
            <?php } ?>">
            <div class="iconeMenu"></div>
            <div class="iconeMenu"></div>
            <div class="iconeMenu"></div>
        </div>  
        <div id="ititulo">
            <H1>Associação 40Ribas</H1> 
        </div>
        <div id="iuse">
            <a> Olá, <?php echo $usuario['apelido']; ?></a><br>
            <a> Status: <?php echo $usuario['status']; ?></a> 
        </div>
    </div>
  
    <div class="menu" id="imenu">
        <ul id="ilista" class="lista">
            <li><a href="#" onclick="abrirNaDiv('inicio.php');toggleMenu()">Inicío </a></li> 
            <li><a href="#" onclick="abrirNaDiv('perfil.php');toggleMenu()">Meu Perfil </a></li>              
            <li><a href="#" onclick="abrirNaDiv('CarregarMensalidades.php');toggleMenu()">Minhas Mensalidades</a></li>
            <li><a href="#" onclick="abrirNaDiv('Carregar_joia.php');toggleMenu()">Jóia</a></li>
            <li><a href="usuario_logout.php">Sair</a></li>
        </ul> 
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
    <script src="usuario_home.js"></script>
</body>
</html>