<?php
    /*function verificar_data(){
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
}*/
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    
    <!--<script type="text/javascript" src="criterios/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="criterios/bootstrap.min.js"></script>
    <script type="text/javascript" src="criterios/jquery.mask.min.js"></script>
    <script type="text/javascript" src="verifica_dados.js"></script>-->

    <title>Ficha de Inscrição</title>
</head>
<body>
    <h1>Ficha de Inscrição</h1>
    <form action="../descarte/deu_certo.php" method="POST" enctype="multipart/form-data" autocomplete="on" onsubmit="return validateForm()">

        <img id="preview" style="max-width: 300px;" src= ""><br>
        <span id="imgAlerta"></span><br>
        <input required type="file" id="imageInput" accept=".png, .jpg, .jpeg" onchange="handleImageUpload(event)">
        <br>
        <fieldset>
            <legend>Dados Pessoais</legend>
            <p>
                <label for="inome">Nome: </label><br>
                <input required value="" name="nome" id="inome" type="text" minlength="3" maxlength="15" size=""><br>
            </p>
            <p>
                <label for="isobrenome">Sobrenome: </label><br>
                <input required value="" name="sobrenome" id="isobrenome" type="text" minlength="5" maxlength="150" size="">
            </p>
                <label for="iapelido">Apelido: </label><br>
                <input value="" name="apelido" id="iapelido" type="text"><br>
            </p>
            <p>
                <label for="icpf">CPF: </label><br>
                <input required value="" name="cpf" id="icpf" type="text" oninput="formatCPF(this)" onblur="verificaCpf()"><br>
            </p>
            <p>
                <label for="irg">RG: </label><br>
                <input required value="" name="rg" id="irg" type="text" oninput="formatRG(this)" onblur="verificaRG()"><br>
            </p>
            <p>
                <label for="inascimento">Data de Nascimento: </label><br>
                <input required value="" name="nascimento" id="inascimento" type="text" placeholder="00/00/0000" oninput="formatarData(this)" onblur="verificaData()"><br>
            </p>
            <p> 
                <label for="iuf">Estado Natal: </label><br>
                <select required name="uf" id="iuf" value="">
                <option value="Escolha" >---Escolha---</option>
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
                <input required value="" name="cidnatal" id="icidnatal" type="text"><br>
            </p>
            <p>
                <label for="imae">Nome da Mãe: </label><br>
                <input required value="" name="mae" id="imae" type="data"><br>
            </p>
            <p>
                <label for="ipai">Nome do Pai: </label><br>
                <input value="" name="pai" id="ipai" type="text"><br>
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
                <select name="uf_atual" id="iuf_atual" value="">
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
                <!-- Adicione mais opções para outros estados aqui -->
                </select>
            </p>
            <p>
                <label for="icep">CEP: </label><br>
                <input required value="" name="cep" id="icep" type="text" maxlength="9" oninput="formatarCEP(this)" onblur="fetchCityByCEP()"><br>
            </p>
            <p>
                <label for="icid_atual">Cidade Atual: </label><br>
                <input required value="" name="cid_atual" id="icid_atual" type="text"><br>
            </p>
            <p>
                <label for="iendereco">Logradouro: AV/RUA </label><br>
                <input required value="" name="endereco" id="iendereco" type="text"><br>
            </p>
            <p>
                <label for="inum">N°: </label><br>
                <input required value="" name="numero" id="inum" type="text"><br>
            </p>
            <p>
                <label for="ibairro">Bairro: </label><br>
                <input required value="" name="bairro" id="ibairro" type="text"><br>
            </p>
        </fieldset>
        <fieldset>
            <legend>Contatos</legend>
            <p>
                <label for="icelular1">Celular 1: </label><br>
                <input required value="" name="celular1" id="icelular1" type="text" placeholder="(00) 00000-0000" size="" oninput="formatarCelular1(this)" onblur="verificaCelular1()"><br>
            </p>
            <p>
                <label for="icelular2">Celular 2: Opcional </label><br>
                <input value="" name="celular2" id="icelular2" type="text" placeholder="(00) 00000-0000" size="" oninput="formatarCelular2(this)" onblur="verificaCelular2()"><br>
            </p>
            <p>
                <label for="iemail">E-mail:</label><br>
                <input required value="" name="email" id="iemail" type="email"><br>
            </p>
        </fieldset>
        <p>
            <label for="imotivo">Diga qual é o motivo ao qual você deseja se tornar sócio: </label><br>
            <textarea required value=""  rows="4" cols="50" placeholder="Minimo 100 digitos" minlength="100" maxlength="1500" type="text" name="motivo" id="imotivo" ></textarea>
        </p>
        <p>
            <input type="checkbox" id="iaceito"  onchange="verificarAceite()" name="aceito" value="sim">Eu aceito os <a href="termos.php" target="_blank">Termos.</a><br><br>
            <span id="imgAlerta2"></span><br>
            <a href="../index.html">Voltar</a>
            <input id="solicitar" disabled ="false" type="submit" value="Solicitar">
        </p>
        <script src="verifica_dados.js"></script>
    </form>
</body>
</html>