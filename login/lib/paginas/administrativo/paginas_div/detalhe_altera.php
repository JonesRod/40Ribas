<?php
    include('../../../conexao.php');

    $erro = false;

    if(!isset($_SESSION))
        session_start();
        
    if(!isset($_SESSION['usuario'])){
        header("Location: ../../../../../index.php");
    }

    if(count($_POST) > 0) { 
        $id = intval($_POST['id']);
        $status = $mysqli->escape_string($_POST['status']);
        $admin = $mysqli->escape_string($_POST['admin']);
        $obs = $mysqli->escape_string($_POST['obs']);
    
        // Verifica se o ID existe no banco de dados
        $result = $mysqli->query("SELECT * FROM socios WHERE id = $id");
    
        if($result->num_rows > 0) {
            // O ID existe, então pode prosseguir com a atualização
    
            if($admin == 1) {
                // Verifica se há mais de um sócio no banco de dados
                $result = $mysqli->query("SELECT COUNT(*) as total FROM socios");
                $row = $result->fetch_assoc();
    
                if($row['total'] > 1) {
                    
                    echo "<script>
                        if (confirm('Tem certeza que deseja tornar este usuário um administrador?')) {
                            // Usuário confirmou a ação
                            // Prossiga com a atualização
                            console.log('Usuário confirmou a ação');
                        } else {
                            // Usuário cancelou a ação
                            // Não é necessário fazer nada neste caso
                            console.log('Usuário cancelou a ação');
                        }
                    </script>";

                    // Usuário confirmou a ação
                    // Prossiga com a atualização
                    echo '<p><b>Dados atualizados com sucesso!</b></p>';
                    unset($_POST);
                    //header('refresh: 5; listaSocios.php');
                    
                    // Agora, execute a consulta de atualização
                    $sql_code = "UPDATE socios
                    SET 
                    status ='$status',
                    admin = '$admin',
                    observacao = '$obs'
                    WHERE id = '$id'";
                    $mysqli->query($sql_code) or die($mysqli->error);


                    $id_sessao = $_SESSION['usuario'];
                    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id_sessao'") or die($mysqli->$error);
                    $usuario_sessao = $sql_query->fetch_assoc();

                    // Agora, execute a consulta de atualização
                    $sql_code = "UPDATE socios
                    SET 
                    admin ='0'
                    WHERE id = '$id_sessao'";
                    $mysqli->query($sql_code) or die($mysqli->error);

                    // Fecha a conexão
                    $mysqli->close();
                    header('refresh: 5; ../admin_logout.php');

                } else {
                    echo "Não é possível remover o último administrador. Deve haver pelo menos um administrador no sistema.";
                    // Usuário confirmou a ação
                    // Prossiga com a atualização
                    echo '<p><b>Dados atualizados com sucesso!</b></p>';
                    unset($_POST);
                    header('refresh: 5; listaSocios.php');
                    
                    // Agora, execute a consulta de atualização
                    $sql_code = "UPDATE socios
                    SET 
                    status ='$status',
                    admin = '1',
                    observacao = '$obs'
                    WHERE id = '$id'";
                    $mysqli->query($sql_code) or die($mysqli->error);
                }
            } else {
                // Caso $admin seja 0, não há necessidade de confirmação
                echo '<p><b>Dados atualizados com sucesso!</b></p>';
                unset($_POST);
                header('refresh: 5; listaSocios.php');
                
                // Agora, execute a consulta de atualização
                $sql_code = "UPDATE socios
                SET 
                status ='$status',
                admin = '$admin',
                observacao = '$obs'
                WHERE id = '$id'";
                $mysqli->query($sql_code) or die($mysqli->$erro);
            }
        } else {
            echo "ID inválido.";
        }
    }
       
?>

