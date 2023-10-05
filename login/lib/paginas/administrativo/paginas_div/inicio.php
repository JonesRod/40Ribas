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
            border-collapse: collapse; /* Combina as bordas das células */
        }
        img{
            border-radius: 50%; /* Define um raio de borda de 50% (forma circular) */
            width: 50px; /* Defina a largura desejada para a imagem */
            height: 50px; /* Defina a altura desejada para a imagem */
        }
    </Style>
    <title>Lista de Sócios</title>
    <script>
        $(document).ready(function() {
            // Função para atualizar a tabela com base na seleção do botão de rádio
            function atualizarTabela(status) {
                $.ajax({
                    type: 'POST',
                    url: 'aptos.php', // Nome do arquivo PHP que buscará os dados
                    data: { status: status },
                    success: function(response) {
                        $('#tabela-socios').html(response); // Atualiza a tabela com os novos dados
                    }
                });
            }

            // Define um manipulador de eventos para os botões de rádio
            $('input[name="status"]').change(function() {
                var statusSelecionado = $(this).val();
                atualizarTabela(statusSelecionado);
            });

            // Inicialmente, carrega a tabela com "TODOS" selecionados
            atualizarTabela('ATIVO');
        });
    </script>
</head>
<body>
    <h1>Lista de Sócios Aptos para treinar</h1>
    <p>
        <input type="hidden" name="status" id="iativo" value="ATIVO">
    </p>
    <div id="tabela-socios"></div>
    <p>
        Os demais que não estiver nessa lista, não estão aptos á participarem das atividades. Procure o tesoureiro para mais informações!
    </p>
</body>
</html>
