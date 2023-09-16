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

    $sql_ultimo_mes = $mysqli->query("SELECT id FROM mensalidades_geradas ORDER BY data DESC LIMIT 1") or die($mysqli->error);
    $ultimo_mes = $sql_ultimo_mes->fetch_assoc();
    if ($ultimo_mes) {
        $ultima_mensalidade = $ultimo_mes['mensalidade_mes'];
        //echo "O ID da última entrada é: $ultimo_id";
    } else {
        //echo "Não foi possível encontrar a última entrada.";
        $mes_atual = date('n');
        //echo $mes_atual;
        //date('n', strtotime('+1 month'))
        $ultima_mensalidade = $mes_atual;
        //echo $ultima_mensalidade;
    }

    $sql_dados = $mysqli->query("SELECT * FROM config_admin WHERE id = '1'") or die($mysqli->$error);
    $dados = $sql_dados->fetch_assoc();

    // Fecha a conexão
    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Mensalidades</title>
</head>
<body>
    <h2>Gerador de Mensalidades</h2>
    <form action="">
        <label for="iultmes">Ultima mensalidade gerada foi do mês: </label>
        <input disabled="false" id="iultmes" name="ultmes" type="text" value="<?php echo $ultima_mensalidade; ?>"><br>

        <label for="iqtmes">Quantidade de meses que você pretende gerar: </label>
        <input id="iqtmes" name="qtmes" type="number" value="1"><br>

        <label for="ivalormes">Valor da Mensalidade: R$</label>
        <input disabled="false" type="text" id="ivalormes" name="valormes" value="<?php echo $dados['valor_mensalidades']; ?>"><br>

        <label for="idiavenc">Dia de vencimento: </label>
        <input disabled="false" type="text" id="idiavenc" name="diavenc" value="<?php echo $dados['dia_fecha_mes']; ?>"><br>

        <label for="idesc">Desconto: R$</label>
        <input disabled="false" type="text" id="idesc" name="desc" value="<?php echo $dados['desconto_mensalidades']; ?>"><br>

        <label for="imulta">Multa: R$</label>
        <input disabled="false" type="text" id="imulta" name="multa" value="<?php echo $dados['multa']; ?>"><br>

        <button type="submit">Gerar Mensalidades</button>
    </form>
</body>
</html>