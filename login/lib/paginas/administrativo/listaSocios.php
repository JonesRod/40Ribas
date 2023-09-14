<?php
    include('../../conexao.php');

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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Lista de Sócios</title>
</head>
<body>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Sócios</title>
</head>
<body>
    <h1>Lista de Sócios</h1>

    <?php
    //echo $id;
    // Executa a consulta para obter a lista de sócios
    $sql = "SELECT * FROM socios";
    $result = $mysqli->query($sql);

    // Verifica se há resultados
    if ($result->num_rows > 0) {
        // Exibe o total de sócios
        echo "<p>Total de Sócios: " . $result->num_rows . "</p>";

        // Exibe os dados em uma tabela
        echo "<table border='1'>";
        echo "<tr>
                <th>Associol</th>
                <th>Foto</th>
                <th>Apelido</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Status</th>
                <th>Obs.</th>
                <th>Alterar</th>
                
            </tr>";//<th></th>
        while($row = $result->fetch_assoc()) {
            //if($id != $row["id"]){
                echo "<tr>
                    <td>" . $row["data"] . "</td>
                    <td><img src='../usuarios/". $row["foto"] ."' width='70'></td> 
                    <td>" . $row["apelido"] . "</td>
                    <td>" . $row["nome_completo"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["celular1"] . " / " . $row["celular2"] . "</td>
                    <td>" . $row["status"]. "</td>
                    <td>" . $row["observacao"]. "</td>
                    <td><a href='editar_socio.php?id=" . $row["id"] . "'>Editar</a></td> 
                    
                </tr>";//<td><a href='receber_pagamento.php?id=" . $row["id"] . "'>Receber</a></td>
            //}
        }
        echo "</table>";
    } else {
        echo "Nenhum sócio registrado";
    }

    // Fecha a conexão
    $mysqli->close();
    ?>
</body>
</html>
