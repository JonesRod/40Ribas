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

    //echo $id;

    $id_insc = $_GET['id_socio'];
    $sql_insc = $mysqli->query("SELECT * FROM int_associar WHERE id = '$id_insc'") or die($mysqli->$error);
    $inscrito = $sql_insc->fetch_assoc();
    

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração da Votação</title>
</head>
<body>
    <h2>Configure conforme desejado</h2>

    <form action="" method="post" onsubmit="return validateForm()">

        <img src="<?php echo "../../usuarios/".$inscrito['foto']; ?>" alt="" style="max-width: 200px;"><br>

        <label for="iapelido" >Apelido: </label>
        <input readonly id="iapelido" value="<?php echo $inscrito['apelido']; ?>" name="apelido" type="text"><br>

        <label for="inome_completo" >Nome Completo: </label>
        <input readonly id="inome_completo" value="<?php echo $inscrito['nome_completo']; ?>" name="nome_completo" type="text"><br>

        <label for="iuf">Estado Natal: </label>
        <input readonly id="iuf" value="<?php echo $inscrito['uf']; ?>" name="uf" type="text"><br>   

        <label for="icid_natal" >Cidade Natal: </label>
        <input readonly id="icid_natal" value="<?php echo $inscrito['cid_natal']; ?>" name="cidnatal" type="text"><br>

        <label for="isexo">Sexo: </label>
        <input readonly id="isexo" value="<?php echo $inscrito['sexo']; ?>" name="sexo" type="text"><br>

        <label for="iuf_atual">Estado Atual: </label>
        <input readonly value="<?php echo $inscrito['uf_atual']; ?>" name="uf_atual" id="iuf_atual" type="text"><br>

        <label for="icid_atual">Cidade Atual: </label>
        <input readonly value="<?php echo $inscrito['cid_atual']; ?>" name="cid_atual" id="icid_atual" type="text"><br>

        <label for="idata_ini">Data da votação: </label>
        <input value="" name="data_ini" id="idata_ini" type="text"  oninput="formatarData_ini(this)" onblur="compararDatas()"><br>

        <label for="ihora_ini">Hora inicial: </label>
        <input value="" name="hora_ini" id="ihora_ini" type="time" onblur="compararHorarios()"><br>

        <label for="idata_final">Data da Final: </label>
        <input value="" name="data_final" id="idata_final" type="text" oninput="formatarData_fim(this)" onblur="compararDatas()"><br>

        <label for="ihora_final">Hora Final: </label>
        <input value="" name="hora_final" id="ihora_final" type="time" onblur="compararHorarios()"><br>

        <span id="imgAlerta"></span><br>

        <button type="button" onclick="window.location.href='integrarSocio.php'">Cancelar</button>
        <button type="submit">Registrar</button>
    </form>
    <script src="verifica_dados.js"></script>
</body>
</html>
