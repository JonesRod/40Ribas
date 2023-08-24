<?php
    function verificar_data(){
    $data_inicio = "1900-01-01";
    $nascimento = $_POST['nascimento'];
//verificar_inscricao.php
    // Comparando as Datas
    if(strtotime($data_inicio) > strtotime($nascimento)){
    echo 'Data invalida. O ano deve ser maior que 1900!';
    }
    elseif(strtotime($data_inicio) >= strtotime($nascimento)){
    echo 'A data 1 é igual a data 2.';
    }
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    
    <script type="text/javascript" src="criterios/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="criterios/bootstrap.min.js"></script>
    <script type="text/javascript" src="criterios/jquery.mask.min.js"></script>
    <script type="text/javascript" src="criterios/aplicar.js"></script>

    <title>Ficha de Inscrição</title>
</head>
<body>
    <h1>Ficha de Inscrição</h1>
    <form action="verificar_inscricao.php" method="POST" enctype="multipart/form-data" autocomplete="on" onsubmit="">
        <fieldset>
            <div class="max-width">
                <div class="imageContainer">
                    <img src="../arquivos/9734564-default-avatar-profile-icon-of-social-media-user-vetor.jpg" width="300px" height="300px" alt="Selecione uma imagem" id="imgPhoto">
                </div>
            </div>
            <input type="file" id="flImage" name="fImage" accept="image/*">
            <script src="criterios/scriptfoto.js"></script>
        </fieldset>
        <fieldset>
            <legend>Dados Pessoais</legend>
            <p>
                <label for="inome">Nome: </label><br>
                <input required value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" id="inome" type="text" maxlength="15" size=""><br>
            </p>
            <p>
                <label for="isobrenome">Sobrenome: </label><br>
                <input required value="<?php if(isset($_POST['sobrenome'])) echo $_POST['sobrenome']; ?>" name="sobrenome" id="isobrenome" type="text" maxlength="100" size="">
            </p>
                <label for="iapelido">Apelido: </label><br>
                <input value="<?php if(isset($_POST['apelido'])) echo $_POST['apelido']; ?>" name="apelido" id="iapelido" type="text"><br>
            </p>
            <p>
                <label for="icpf">CPF: </label><br>
                <input required value="<?php if(isset($_POST['cpf'])) echo $_POST['cpf']; ?>" name="cpf" id="icpf" type="text" minlength="14" maxlength="14"><br>
            </p>
            <p>
                <label for="irg">RG: </label><br>
                <input required value="<?php if(isset($_POST['rg'])) echo $_POST['rg']; ?>" name="rg" id="irg" type="text"><br>
            </p>
            <p>
                <label for="inascimento">Data de Nascimento: </label><br>
                <input required value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" name="nascimento" id="inascimento" type="date" placeholder="00/00/0000"><br>
            </p>
            <p> 
                <label for="iuf">Estado Natal: </label><br>
                <select name="uf" id="iuf" value="<?php if(isset($_POST['uf'])) echo $_POST['uf']; ?>">
                <option value="">---Escolha---</option>
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
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
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
                <!-- Adicione mais opções para outros estados aqui -->
                </select>
            </p>
            <p>
                <label for="icidnatal">Cidade Natal: </label><br>
                <input required value="<?php if(isset($_POST['cidnatal'])) echo $_POST['cidnatal']; ?>" name="cidnatal" id="icidnatal" type="text"><br>
            </p>
            <p>
                <label for="imae">Nome da Mãe: </label><br>
                <input required value="<?php if(isset($_POST['mae'])) echo $_POST['mae']; ?>" name="mae" id="imae" type="data"><br>
            </p>
            <p>
                <label for="ipai">Nome do Pai: </label><br>
                <input value="<?php if(isset($_POST['pai'])) echo $_POST['pai']; ?>" name="pai" id="ipai" type="text"><br>
            </p>
        </fieldset>
        <fieldset>
            <legend>Sexo</legend>
            <p>
                <input type="radio" name="sexo" id="imasc" checked><label for="imasc">Masculino</label> 
                <input type="radio" name="sexo" id="ifemi"><label for="ifemi">Feminino</label> 
                <input type="radio" name="sexo" id="iout"><label for="iout">Outros</label>
            </p>
        </fieldset>
        <fieldset>
            <legend>Endereço Atual</legend>
            <p> 
                <label for="iuf_atual">Estado Atual: </label><br>
                <select name="uf_atual" id="iuf_atual" value="<?php if(isset($_POST['uf_atual'])) echo $_POST['uf_atual']; ?>">
                <option value="">---Escolha---</option>
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
                <!-- Adicione mais opções para outros estados aqui -->
                </select>
            </p>
            <p>
                <label for="icep">CEP: </label><br>
                <input required value="<?php if(isset($_POST['cep'])) echo $_POST['cep']; ?>" name="cep" id="icep" type="text" minlength="10" maxlength="10"><br>
            </p>
            <p>
                <label for="icid_atual">Cidade Atual: </label><br>
                <input required value="<?php if(isset($_POST['cid_atual'])) echo $_POST['cid_atual']; ?>" name="cid_atual" id="icid_atual" type="text"><br>
            </p>
            <p>
                <label for="iendereco">Logradouro: AV/RUA </label><br>
                <input required value="<?php if(isset($_POST['endereco'])) echo $_POST['endereco']; ?>" name="endereco" id="iendereco" type="text"><br>
            </p>
            <p>
                <label for="inum">N°: </label><br>
                <input required value="<?php if(isset($_POST['numero'])) echo $_POST['numero']; ?>" name="numero" id="inum" type="text"><br>
            </p>
            <p>
                <label for="ibairro">Bairro: </label><br>
                <input required value="<?php if(isset($_POST['bairro'])) echo $_POST['bairro']; ?>" name="bairro" id="ibairro" type="text"><br>
            </p>
        </fieldset>
        <fieldset>
            <legend>Contatos</legend>
            <p>
                <label for="icelular1">Celular 1: </label><br>
                <input required value="<?php if(isset($_POST['celular1'])) echo $_POST['celular1']; ?>" name="celular1" id="icelular1" type="text" placeholder="(00) 00000-0000" minlength="15" maxlength="15" size=""><br>
            </p>
            <p>
                <label for="icelular2">Celular 2: Opcional </label><br>
                <input value="<?php if(isset($_POST['celular2'])) echo $_POST['celular2']; ?>" name="celular2" id="icelular2" type="text" placeholder="(00) 00000-0000" minlength="15" maxlength="15" size=""><br>
            </p>
            <p>
                <label for="iemail">E-mail:</label><br>
                <input required value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" id="iemail" type="email"><br>
            </p>
        </fieldset>
        <p>
            <label for="imotivo">Diga qual é o motivo ao qual você deseja se tornar sócio: </label><br>
            <textarea required value=""  rows="4" cols="50" placeholder="Minimo 100 digitos" minlength="10" maxlength="1500" type="text" name="motivo" id="imotivo" ><?php if(isset($_POST['motivo'])) echo $_POST['motivo']; ?></textarea>
        </p>
        <p>
            <input type="checkbox" id="aceito"  onchange="verificarAceite()" name="aceito" value="sim">Eu aceito os <a href="termos.php" target="_blank">Termos.</a><br><br>

            <a href="../index.html">Voltar</a>
            <input id="solicitar" disabled ="false" type="submit" value="Solicitar">
        </p>
    </form>
</body>
</html>