<?php
    include('../login/conexao.php');

    if(!isset($_SESSION)){
        session_start(); 

        if(isset($_SESSION['usuario'])){
            //if($_SERVER["REQUEST_METHOD"] === "POST") {  

                if (isset($_POST["tipoLogin"])) {
                    // Obter o valor do input radio
                    $usuario = $_SESSION['usuario'];
                    $valorSelecionado = $_POST["tipoLogin"];
                    $admin = $valorSelecionado;

                    if($admin != 1){
                        //echo "3"; 
                        // Destruir todas as variáveis de sessão
                        session_unset();
                        session_destroy();
                        //echo $_SESSION['id'];
                        //echo "1" . $usuario . $admin; 
                        header("Location: ../index.php");
                        //$_SESSION['usuario'];
                        //$_SESSION['admin'];
                        //header("Location: ../paginas/usuario_home.php");       
                    }else{
                        $usuario = $_SESSION['usuario'];
                        $admin = $_SESSION['admin'];
                        $_SESSION['usuario'];
                        $_SESSION['admin']; 
                        //echo 'oi';
                        $id = $_SESSION['usuario'];
                        $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
                        $usuario = $sql_query->fetch_assoc();      
                    }
                }else{
                    //session_unset();
                    //session_destroy();
                    //header("Location: ../index.php"); 
                    //echo 'oii';
                    $id = $_SESSION['usuario'];
                    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
                    $usuario = $sql_query->fetch_assoc();  
                } 

        }else{
            session_unset();
            session_destroy();
            header("Location: ../index.php"); 
        }
    }else{
        session_unset();
        session_destroy();
        header("Location: ../index.php"); 
    }

    $id = 1;
    $dados = $mysqli->query("SELECT * FROM config_admin WHERE id = '$id'") or die($mysqli->$error);
    $dadosEscolhido = $dados->fetch_assoc();
//hidden esconde o input
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração</title>
</head>
<body>
    <a>Admin <?php echo $usuario['apelido']; ?></a> <br>
    <h1>Configurações do Administrador</h1>
    
    <form action="" method="POST" enctype="multipart/form-data" autocomplete="on" onsubmit="return validateForm()">
        <fieldset>
            <p>
                <?php if($dadosEscolhido['logo']) { ?>
                <img id="ilogo" style="max-width: 200px;" src= "<?php echo $dadosEscolhido['logo']; ?>" name="logo_antiga" alt=""><br>
                <?php } ?>
                <img id="ilogoNova" style="max-width: 200px;" alt=""><br>
                <label for="imageInput">Alterar Logo</label>
                <input type="file" id="imageInput" name="imageInput" accept=".png, .jpg, .jpeg" onchange="imgLogo(event)">
                <input type="hidden" name="end_logo" value= "<?php echo $dadosEscolhido['logo']; ?>">
            </p>  
            <p>
                <label for="irazao">Razão Social:</label><br>
                <input required id="irazao" type="text" value="<?php echo $dadosEscolhido['razao']; ?>">           
            </p>
            <p>
                <label for="icnpj">CNPJ:</label><br>
                <input required id="icnpj" type="text" oninput="formataCNPJ(this)" onblur="verificaCnpj()" value="<?php echo $dadosEscolhido['cnpj']; ?>">           
            </p>
        </fieldset>
        <fieldset>
            <legend>Localização:</legend>
            <p> 
                <label for="iuf">Estado: </label><br>
                <select name="uf" id="iuf">
                <?php
                    $estados = array(
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará' ,
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MS' => 'Mato Grosso do Sul',
                    'MT' => 'Mato Grosso',
                    'MG' => 'Minas Gerais',
                    'PA' => 'Pará',
                    'PB' => 'Paraíba',
                    'PR' => 'Paraná',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo',
                    'SE' => 'Sergipe',
                    'TO' => 'Tocantins'
                    );

                    $ufSelecionada = $usuario['uf'];

                    echo '<option value="' . $ufSelecionada . '">' . $estados[$ufSelecionada] . '</option>';

                    foreach ($estados as $uf => $estado) {
                        if ($uf !== $ufSelecionada) {
                            echo '<option value="' . $uf . '">' . $estado . '</option>';
                        }
                    }           
                ?>
                <option value="Escolha">---Escolha---</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MT">Mato Grosso</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
                </select>
            </p>
            <p>
                <label for="icep">CEP: </label><br>
                <input required value="<?php echo $dadosEscolhido['cep']; ?>" name="cep" id="icep" type="text" maxlength="9" oninput="formatarCEP(this)" onblur="fetchCityByCEP()"><br>
            </p>
            <p>
                <label for="icidade">Cidade Atual: </label><br>
                <input required name="cid" id="icidade" type="text" value="<?php echo $dadosEscolhido['cid']; ?>"><br>
            </p>
            <p>
                <label for="iendereco">Logradouro: AV/RUA </label><br>
                <input required name="endereco" id="iendereco" type="text" value="<?php echo $dadosEscolhido['rua']; ?>"><br>
            </p>
            <p>
                <label for="inum">N°: </label><br>
                <input required name="numero" id="inum" type="text" value="<?php echo $dadosEscolhido['numero']; ?>"><br>
            </p>
            <p>
                <label for="ibairro">Bairro: </label><br>
                <input required name="bairro" id="ibairro" type="text" value="<?php echo $dadosEscolhido['bairro']; ?>"><br>
            </p>
        
        </fieldset>
        <fieldset>
            <legend>Administrativo:</legend>
            <p>
                <label for="ipresidente">Nome do Presidente:</label><br>
                <input id="ipresidente" type="text" value="<?php echo $dadosEscolhido['presidente']; ?>">           
            </p>
            <p>
                <label for="ivicepresidente">Nome do Vice-Presidente:</label><br>
                <input id="ivicepresidente" type="text" value="<?php echo $dadosEscolhido['vice_presidente']; ?>">           
            </p>
            <p>
                <label for="inome">Nome do Tesoureiro(Admin):</label><br>
                <input id="inome" type="text" value="<?php echo $dadosEscolhido['nome_tesoureiro']; ?>">           
            </p>
            <p>
                <label for="isobrenome">Sobrenome do Admin:</label><br>
                <input id="isobrenome" type="text" value="<?php echo $dadosEscolhido['sobrenome_tesoureiro']; ?>">           
            </p>
            <p>
                <label for="iEmailNot">E-mail de notificação:</label><br>
                <input required id="iEmailNot" type="email" value="<?php echo $dadosEscolhido['email_not']; ?>">
            </p>
            <p>
                <label for="iEmailRec">E-mail de recuperação de senha:</label><br>
                <input required id="iEmailRec" type="email" value="<?php echo $dadosEscolhido['email_rec']; ?>">           
            </p>
        </fieldset>
        <fieldset>
            <legend>Config. Financeira:</legend>
            <p>
                <label for="idia" for="">Dia de vencimento das Mensalidades:</label><br>
                <input required id="idia" type="number" value="<?php echo $dadosEscolhido['dia_fecha_mes']; ?>">  
            </p>
            <p>
                <label for="imensal" for="">Valor das Mensalidades: </label><br>
                <input required id="imensal" type="number" value="<?php echo $dadosEscolhido['valor_mensalidades']; ?>">  
            </p>
            <p>
                <label for="idesc" for="">Desconto na mensalidade se pagar em dia:</label><br>
                <input required id="idesc" type="number" value="<?php echo $dadosEscolhido['desconto_mensalidades']; ?>">  
            </p>
            <p>
                <label for="imulta" for="">Multa na Mensalidade após vencimento:</label><br>
                <input required id="imulta" type="number" value="<?php echo $dadosEscolhido['multa']; ?>">  
            </p>
            <p>
                <label for="ijoia" for="">Valor da Jóia: </label><br>
                <input required id="ijoia" type="number" value="<?php echo $dadosEscolhido['joia']; ?>">  
            </p>
            <p>
                <label for="iparJoia" for="">Parcelamento máximo da Jóia: </label><br>
                <input required id="iparJoia" type="number" value="<?php echo $dadosEscolhido['parcela_joia']; ?>">  
            </p>
            <p>
                <label id="" for="imes3">Quantidades de meses em atraso para suspenção das atividades do associado: </label><br>
                <input required id="imes3" type="number" value="<?php echo $dadosEscolhido['meses_vence3']; ?>">  
            </p>
            <p>
                <label for="imes5">Quantidades de meses em atraso para exclusão do associado: </label><br>
                <input id="imes5" type="number" value="<?php echo $dadosEscolhido['meses_vence5']; ?>">  
            </p>
        </fieldset>
        <p>
            <label for="itermos">Termos da Inscrição:</label><br>
            <textarea required name="" id="itermos" cols="50" rows="20" minlength="10" value="<?php echo $dadosEscolhido['termos_insc']; ?>"></textarea>
        </p>
        <p>
            <label for="iEst">Estatuto interno:</label><br>
            <textarea required id="iEst" name="" cols="50" rows="20" minlength="10" value="<?php echo $dadosEscolhido['estatuto_int']; ?>"></textarea>
        </p>
        <p>
            <label for="iReg" for="">Regimento interno:</label><br>
            <textarea required name="" id="iReg" cols="50" rows="20" minlength="10" value="<?php echo $dadosEscolhido['reg_int']; ?>"></textarea>
        </p>

        <p>
            <span id="imsgAlerta"></span><br>
            <a href="admin_home.php">Voltar</a>
            <button type="submit">Salvar</button>
        </p>
        
        <script src="admin_verifica.js"></script>
    </form>
</body>
</html>