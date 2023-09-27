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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <Style>
        body{
            text-align: center;
        }
        body #table{
            text-align: center;
        }
        table {
            margin-left: auto;
            margin-right: auto;
        }
    </Style>
    <script>
        //atualiza a pagian a cada 10 seg
        setTimeout(function() {
            location.reload();
        }, 100000);

        $(document).ready(function() {
            // Função para atualizar a tabela com base na seleção do botão de rádio
            function atualizarTabela(vencimento, nomeSocio) {
                $.ajax({
                    type: 'POST',
                    url: 'atualizar_tabela_joia.php', // Nome do arquivo PHP que buscará os dados
                    data: { situacao: vencimento, nome_socio: nomeSocio },
                    success: function(response) {
                        $('#tabela-joia').html(response); // Atualiza a tabela com os novos dados
                    }
                });
            }

            $('input[name="situacao"]').change(function() {
                $('input[name="socio"]').val(''); // Define o valor do campo de busca como vazio
                var situacaoSelecionado = $(this).val();
                var nomeSocio = $('input[name="socio"]').val();
                atualizarTabela(situacaoSelecionado, nomeSocio);
            });

            // Define um manipulador de eventos para o botão de busca por nome de sócio
            $('#buscarSocio').click(function() {
                var situacaoSelecionado = $('input[name="situacao"]:checked').val();
                var nomeSocio = $('input[name="socio"]').val();
                atualizarTabela(situacaoSelecionado, nomeSocio);
            });

            // Inicialmente, carrega a tabela com "TODOS" selecionados
            atualizarTabela('ATRASADOS', '');
        });

    </script>
    <title>Jóia á receber</title>
</head>
<body>
    <h1>Relatório de Jóias á receber</h1>
    <p>
        <label for="">BUSCAR: </label>
        <input type="radio" name="situacao" id="iatrasados" checked value="ATRASADOS"><label for="iatrasados">ATRASADOS</label>
        <input type="radio" name="situacao" id="iEmDia" value="EM_DIA"><label for="iEmDia">EM DIA</label>
        <input type="radio" name="situacao" id="itodos" value="TODOS"><label for="itodos">TODAS GERADAS</label> <br> 
        
        <label for="">BUSCAR POR SOCIO: </label><input type="text" name="socio"><button id="buscarSocio">Buscar</button>
    </p>
    <div id="tabela-joia"></div>
</body>
</html>