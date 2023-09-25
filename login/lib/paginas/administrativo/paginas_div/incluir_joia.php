<?PHP
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

    $id_joia_config = '1';
    $sql_joia_config = $mysqli->query("SELECT * FROM config_admin WHERE id = '$id_joia_config'") or die($mysqli->$error);
    $valor_joia = $sql_joia_config->fetch_assoc();

    $joia =$valor_joia['joia'];
    $parcelas = $valor_joia['parcela_joia'];

    if(isset($_GET['id_socio'])) {
        $id_socio = $_GET['id_socio'];
        //echo $id_socio;
        $sql_joia_receber = $mysqli->query("SELECT * FROM socios WHERE id = '$id_socio'") or die($mysqli->error);
        $socio = $sql_joia_receber->fetch_assoc();

        $admin = $usuario['apelido'];
        $apelido = $socio['apelido'];
        $nome = $socio['nome_completo'];
        $celular1 = $socio['celular1'];
        $celular2 = $socio['celular2'];
        $email = $socio['email'];

    } else {
        $admin = $usuario['apelido'];
        $apelido = '';
        $nome = '';
        $celular1 = '';
        $celular2 = '';
        $email = '';
    }

    /*if(isset($_GET['pesquisa'])) {
        $id_socio = '';
        $nome_socio = $_GET['pesquisa'];

        $sql = "SELECT * FROM socios WHERE nome_completo LIKE '%$nome_socio%' LIMIT 1";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $result_pesquisa = $result->fetch_assoc();
        
            $admin = $usuario['apelido'];
            $apelido = $result_pesquisa['apelido'];
            $nome = $result_pesquisa['nome_completo'];
            $celular1 = $result_pesquisa['celular1'];
            $celular2 = $result_pesquisa['celular2'];
            $email = $result_pesquisa['email'];
            echo json_encode($result_pesquisa); // Retorna os dados como JSON
        } else {
            //echo json_encode(['error' => 'Nenhum sócio encontrado']); // Retorna uma mensagem de erro em JSON
        }
    }*/

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carregar Jóia</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Função para buscar os dados do sócio pelo nome
            function buscarDadosSocio(nomeSocio) {
                $.ajax({
                    type: 'GET',
                    url: 'buscar_dados.php',
                    data: { pesquisa: nomeSocio },
                    dataType: 'json',
                    success: function(dados) {
                        if (dados.msg) {
                            $('#imsg').text(dados.msg); // Exibe a mensagem no <span>
                        } else {
                            $('#imsg').text(''); // Limpa a mensagem se houver dados válidos
                            $('#iapelido').val(dados.apelido);
                            $('#inome').val(dados.nome_completo);
                            $('#icelular1').val(dados.celular1);
                            $('#icelular2').val(dados.celular2);
                            $('#iemail').val(dados.email);
                        }
                    },
                });
            }

                $('#buscarSocio').click(function() {
                    var nomeSocio = $('#ipesquisa').val();
                    buscarDadosSocio(nomeSocio);
                    //console.log('oii');
                });

                // Inicialmente, carrega a tabela com "TODOS" selecionados
                //buscarDadosSocio('');
        });

    </script>

</head>
<body>
    <div>
        <h2>Carregar Jóia</h2>

        <label for="ipesquisa">Pesquisar por Nome: </label>
        <input id="ipesquisa" name="pesquisa" type="text">
        <button id="buscarSocio">Buscar</button>
        <span id="imsg"></span>
        <form action="" method="post">

            <input id="" value="<?php echo $usuario['id']; ?>" name="admin" type="hidden">
            <p>
                <label for="iapelido" >Apelido: </label>
                <input readonly id="iapelido" value="<?php echo $apelido; ?>" name="apelido" type="text"><br>
            </p>
            <p>
                <label for="inome" >Nome Completo: </label>
                <input readonly id="inome" value="<?php echo $nome; ?>" name="nome" type="text"><br>
            </p>
            <p>
                <label for="icelular1">Celular 1:</label>
                <input readonly id="icelular1" type="text" value="<?php echo $celular1; ?>" >
            </p>
            <p>
                <label for="icelular2">Celular 2:</label>
                <input readonly id="icelular2" type="text" value="<?php echo $celular2; ?>" >
            </p>
            <p>
                <label for="iemail">E-mail:</label>
                <input readonly id="iemail" type="text" value="<?php echo $email; ?>" >
            </p>
            <p>
                <label for="ijoia">Valor da Joia:</label>
                <input readonly id="ijoia" type="text" value="<?php echo $joia . ',00'; ?>" >
            </p>
            <p>
                <label for="ientrada">Entrada:</label>
                <input id="ientrada" type="text" value="0,00" >
            </p>
            <p>
                <label for="irest">Restante:</label>
                <input readonly id="irest" type="text" value="<?php echo $joia . ',00'; ?>" >
            </p>
            <p>
                <label for="iparcelas">Quantidade de Parcelas:</label>
                <input  id="iparcelas" type="number" value="<?php echo $parcelas; ?>" >
            </p>
            <p>
                <label for="ivalor_parcelas">Valor da Parcelas:</label>
                <input  readonly id="ivalor_parcelas" value="<?php echo $valor_parcelas; ?>" >
            </p>

        </form>

    </div>
    
</body>
</html>