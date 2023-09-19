<?php
    include('../../../conexao.php');

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
                    header("Location: ../../usuarios/usuario_home.php");      
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
            header("Location: ../../../../../index.php");  
        }
    
    }else{
        //echo "6";
        session_unset();
        session_destroy(); 
        header("Location: ../../../../../index.php");  
    }

    $id = $_SESSION['usuario'];
    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
    $usuario = $sql_query->fetch_assoc();

    // Inclua aqui a conexão com o banco de dados
    //include 'conexao.php';

    if (isset($_POST['situacao'])) {
        $situacao = $_POST['situacao'];
        $nome_socio = $_POST['nome_socio'];

        $sql = "SELECT * FROM mensalidades WHERE 1=1";

        if ($situacao == 'ATRASADOS') {
            $sql .= " AND data_vencimento < CURDATE()";
        } elseif ($situacao == 'EM_DIA') {
            $sql .= " AND data_vencimento >= CURDATE()";
        }

        if (!empty($nome_socio)) {
            $sql .= " AND nome_completo LIKE '%$nome_socio%'";
        }

        $result = $mysqli->query($sql);

        if ($result) {
            echo "<p>Total de Mensalidades: " . $result->num_rows . "</p>";
            echo "<table border='1'>";
            echo "<tr>
                <th>Apelido</th>
                <th>Nome</th>
                <th>Mensalidade</th>
                <th>Valor</th>
                <th>Desconto</th>
                <th>Multa</th>
                <th>Vencimento</th>
                <th>Valor á Receber</th>
                <th>Detalhes</th>
            </tr>";

            $valor_total_a_receber = 0;
            while ($row = $result->fetch_assoc()) {
                $valor_mensalidade = $row["valor_mensalidade"];
                $desconto_mensalidade = ($row["data_vencimento"] >= date('Y-m-d')) ? $row["desconto_mensalidade"] : 0;
                $multa_mensalidade = ($row["data_vencimento"] < date('Y-m-d')) ? $row["multa_mensalidade"] : 0;
        
                $data_vencimento_formatada = date('d/m/Y', strtotime($row["data_vencimento"]));
                $valor_a_receber = $valor_mensalidade - $desconto_mensalidade + $multa_mensalidade;
                $valor_total_a_receber += $valor_a_receber;
        
                echo "<tr>
                    <td>" . $row["apelido"] . "</td>
                    <td>" . $row["nome_completo"] . "</td>
                    <td>" . $row["mensalidade_mes"] . "/" . $row["mensalidade_ano"] ."</td>
                    <td>" . $valor_mensalidade . ",00"."</td>
                    <td>" . $desconto_mensalidade . ",00"."</td>
                    <td>" . $multa_mensalidade . ",00"."</td>
                    <td>" . $data_vencimento_formatada . "</td>
                    <td>" . $valor_a_receber . ",00"."</td>
                    <td><a href='detalhes_socio.php?id_sessao=" . $id . "&id_socio=" . $row["id"] ."'>Receber</a></td>
                </tr>";
            }

            echo "</table>";
            echo "<p>Valor Total a Receber: $valor_total_a_receber,00</p>";
        } else {
            echo "Nenhum registrado";
        }
    } else {
        echo "Nenhum parâmetro de busca recebido.";
    }

    $mysqli->close();
?>




