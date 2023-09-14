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

// Verifique se a variável 'status' foi enviada via POST
if (isset($_POST['status'])) {
    $status = $_POST['status'];

    // Construa a consulta SQL com base no valor do botão de rádio
    $sql = "SELECT * FROM socios";

    if ($status !== 'TODOS') {
        $sql .= " WHERE status = '$status'";
    }

    // Execute a consulta SQL
    $result = $mysqli->query($sql);

    // Construa a tabela HTML com os dados
    if ($result->num_rows > 0) {
        echo "<p>Total de Sócios: " . $result->num_rows . "</p>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Associol</th>
                <th>Foto</th>
                <th>Apelido</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Obs.</th>
                <th>Alterar</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            if($id != $row["id"]){
                echo "<tr>
                    <td>" . $row["data"] . "</td>
                    <td><img src='../usuarios/" . $row["foto"] . "' width='70'></td>
                    <td>" . $row["apelido"] . "</td>
                    <td>" . $row["nome_completo"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["celular1"] . " / " . $row["celular2"] . "</td>
                    <td>" . $row["observacao"] . "</td>
                    <td><a href='editar_socio.php?id=" . $row["id"] . "'>Editar</a></td>
                </tr>";
            }
        }

        echo "</table>";
    } else {
        echo "Nenhum sócio registrado";
    }

    // Fecha a conexão
    $mysqli->close();
}
?>
