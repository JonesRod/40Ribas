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
    <title>Descrição do Sócio</title>
</head>
<body>
    <form action="alterar_dados_perfil.php" method="POST" enctype="multipart/form-data" autocomplete="on" onsubmit="return validateForm()">
        <p>
            <img id="ifoto" style="max-width: 200px;" src= "<?php echo '../usuarios/'. $usuario['foto']; ?>" name="foto" alt=""><br>
        </p>  
        
        <input id="" value="<?php echo $usuario['id']; ?>" name="id" type="hidden">
        <p>
            <label for="iapelido" >Apelido: </label>
            <input id="iapelido" value="<?php echo $usuario['apelido']; ?>" name="apelido" type="text"><br>
        </p>        
        <p>
            <label for="inome_completo" >Nome Completo: </label>
            <input id="inome_completo" value="<?php echo $usuario['nome_completo']; ?>" name="nome_completo" type="text"><br>
        </p>
        <p>
            <label for="icpf" >CPF: </label>
            <input id="icpf" value="<?php echo $usuario['cpf']; ?>" name="cpf" type="text" oninput="formatCPF(this)" onblur="verificaCpf()"><br>
        </p>
        <p>
            <label for="irg" >RG: </label>
            <input id="irg" value="<?php echo $usuario['rg']; ?>" name="rg" type="text" oninput="formatRG(this)" onblur="verificaRG()"><br>
        </p>
        <p>
            <label for="inascimento" >Data de Nascimento: </label>
            <?php
                // Suponha que $usuario seja um array contendo os dados do banco de dados, incluindo o campo "data_nascimento"
                $dataNascimento = $usuario['nascimento'];

                // Formate a data para o formato brasileiro (dd/mm/yyyy)
                $dataNascimentoFormatada = date('d/m/Y', strtotime($dataNascimento));
            ?>
            <input id="inascimento" value="<?php echo $dataNascimentoFormatada; ?>" name="nascimento" type="text"  oninput="formatarData(this)" onblur="verificaData()"><br>
        </p>
        <p>
            <label id="iuf">Estado Natal: </label>
            <input id="iuf" value="<?php echo $usuario['uf']; ?>" name="uf" type="text"><br>   
        </p>
        <p>
            <label for="icid_natal" >Cidade Natal: </label>
            <input id="icid_natal" value="<?php echo $usuario['cid_natal']; ?>" name="cidnatal" type="text"><br>
        </p>
        <p>
            <label id="" for="imae">Nome da Mãe: </label>
            <input id="imae" value="<?php echo $usuario['mae']; ?>" name="mae" type="text"><br>
        </p>
        <p>
            <label id="" for="ipai">Nome do Pai: </label>
            <input id="ipai" value="<?php echo $usuario['pai']; ?>" name="pai" type="text"><br>
        </p>
        <p>
            <label id="" for="isexo">Sexo: </label>
            <input id="isexo" value="<?php echo $usuario['sexo']; ?>" name="sexo" type="text"><br>
        </p>
        <fieldset>
            <legend>Endereço Atual</legend>
            <p> 
                <label for="iuf_atual">Estado Atual: </label>
                <input value="<?php echo $usuario['uf_atual']; ?>" name="uf_atual" id="iuf_atual" type="text"><br>
            </p>
            <p>
                <label for="icep">CEP: </label><br>
                <input value="<?php echo $usuario['cep']; ?>" name="cep" id="icep" type="text"><br>
            </p>
            <p>
                <label for="icid_atual">Cidade Atual: </label><br>
                <input value="<?php echo $usuario['cid_atual']; ?>" name="cid_atual" id="icid_atual" type="text"><br>
            </p>
            <p>
                <label for="iendereco">Logradouro: AV/RUA </label><br>
                <input value="<?php echo $usuario['endereco']; ?>" name="endereco" id="iendereco" type="text"><br>
            </p>
            <p>
                <label id="" for="inum">N°: </label><br>
                <input value="<?php echo $usuario['numero']; ?>" name="numero" id="inum" type="text"><br>
            </p>
            <p>
                <label id="" for="ibairro">Bairro: </label><br>
                <input value="<?php echo $usuario['bairro']; ?>" name="bairro" id="ibairro" type="text"><br>
            </p>
        </fieldset>
        <fieldset>
            <legend>Contatos</legend>
            <p>
                <label id="" for="icelular1">Celular 1: </label><br>
                <input value="<?php echo $usuario['celular1']; ?>" name="celular1" id="icelular1" type="text" size=""><br>
            </p>
            <p>
                <label id="" for="icelular2">Celular 2: Opcional </label><br>
                <input value="<?php echo $usuario['celular2']; ?>" name="celular2" id="icelular2" type="text" size=""><br>
            </p>
            <p>
                <label id="" for="iemail">E-mail:</label><br>
                <input value="<?php echo $usuario['email']; ?>" name="email" id="iemail" type="email"><br>
            </p>
        </fieldset>
        <p>
            <span id="imgAlerta"></span><br>
            <span id="imgAlerta2" type="hidden"></span><br>
            <a href="usuario_home.php" style="margin-left: 10px; margin-right: 10px;">Voltar</a><a href="../../redefinir_senha.php" style="margin-left: 10px; margin-right: 10px;">Redefinir Senha</a>
            <button id="" type="submit" style="margin-left: 10px;">Salvar</button>
        </p>
        <script src="perfil_verifica_dados.js"></script>
    </form>
</body>
</html>

