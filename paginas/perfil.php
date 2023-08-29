<?php
    //codigo da sessão
    include('../login/conexao.php');

    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['usuario'])){
        header("Location: ../login.html");
    }
    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
        $senha = password_hash($_SESSION['senha'], PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO senha (email, senha) VALUES('$email','$senha')");
    
    }
    
    $id = $_SESSION['usuario'];
    $sql_query = $mysqli->query("SELECT * FROM socios WHERE id = '$id'") or die($mysqli->$error);
    $usuario = $sql_query->fetch_assoc();

    $caminhoDaImagem= false;
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
</head>
<body>
    <form action="alterar_dados_perfil.php" method="POST" enctype="multipart/form-data" autocomplete="on" onsubmit="return validateForm()">
        <div>
            <img id="preview" style="max-width: 300px;" src= "<?php echo "../arquivos/" .  $usuario['foto']; ?>" alt="Sem Foto"><br>
            <label for="">Alterar Foto </label><input required type="file" id="imageInput" name="imageInput" accept=".png, .jpg, .jpeg" onchange="handleImageUpload(event)">
            <br>
        </div>  
        <p>
            <label>Nome: </label>
            <input value="<?php echo $usuario['nome']; ?>" name="nome" type="text"><br>
        </p>
        <p>
            <label>Sobrenome: </label>
            <input value="<?php echo $usuario['sobrenome']; ?>" name="sobrenome" type="text"><br>
        </p>
        <p>
            <label>Apelido: </label>
            <input value="<?php echo $usuario['apelido']; ?>" name="apelido" type="text"><br>
        </p>
        <p>
            <label>CPF: </label>
            <input value="<?php echo $usuario['cpf']; ?>" name="cpf" type="text" oninput="formatCPF(this)" onblur="verificaCpf()"><br>
        </p>
        <p>
            <label>RG: </label>
            <input value="<?php echo $usuario['rg']; ?>" name="rg" type="text" oninput="formatRG(this)" onblur="verificaRG()"><br>
        </p>
        <p>
            <label>Data de Nascimento: </label>
            <?php
                // Suponha que $usuario seja um array contendo os dados do banco de dados, incluindo o campo "data_nascimento"
                $dataNascimento = $usuario['nascimento'];

                // Formate a data para o formato brasileiro (dd/mm/yyyy)
                $dataNascimentoFormatada = date('d/m/Y', strtotime($dataNascimento));
            ?>
            <input id="inascimento" value="<?php echo $dataNascimentoFormatada; ?>" name="nascimento" type="text"  oninput="formatarData(this)" onblur="verificaData()"><br>
        </p>
        <p>
            <label for="iuf">Estado Natal: </label><br>
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
            <!-- Adicione mais opções para outros estados aqui -->
            </select>
            
        </p>
        <p>
            <label>Cidade Natal: </label>
            <input value="<?php echo $usuario['cid_natal']; ?>" name="cidnatal" type="text"><br>
        </p>
        <p>
            <label for="">Nome da Mãe: </label>
            <input value="<?php echo $usuario['mae']; ?>" name="" type="text"><br>
        </p>
        <p>
            <label for="">Nome do Pai: </label>
            <input value="<?php echo $usuario['pai']; ?>" name="" type="text"><br>
        </p>
        <fieldset>
            <legend>Sexo</legend>
            <p>
                <?php
                    // Suponha que $usuario seja um array contendo os dados do banco de dados, incluindo o campo "sexo"
                    $sexoMasculino = ($usuario['sexo'] == 1) ? 'checked' : '';
                    $sexoFeminino = ($usuario['sexo'] == 2) ? 'checked' : '';
                    $sexoOutro = ($usuario['sexo'] == 3) ? 'checked' : '';
                ?>
                <input type="radio" name="sexo" id="imasc" value="1" <?php echo $sexoMasculino; ?>><label for="imasc">Masculino</label> 
                <input type="radio" name="sexo" id="ifemi" value="2" <?php echo $sexoFeminino; ?>><label for="ifemi">Feminino</label> 
                <input type="radio" name="sexo" id="iout" value="3" <?php echo $sexoOutro; ?>><label for="iout">Outros</label>

            </p>
        </fieldset>
        <fieldset>
            <legend>Endereço Atual</legend>
            <p> 
                <label for="iuf_atual">Estado Atual: </label><br>
                <select name="uf_atual" id="iuf_atual" value="">
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
                <!-- Adicione mais opções para outros estados aqui -->
                </select>
            </p>
            <p>
                <label for="icep">CEP: </label><br>
                <input required value="<?php echo $usuario['cep']; ?>" name="cep" id="icep" type="text" maxlength="9" oninput="formatarCEP(this)" onblur="fetchCityByCEP()"><br>
            </p>
            <p>
                <label for="icid_atual">Cidade Atual: </label><br>
                <input required value="<?php echo $usuario['cid_atual']; ?>" name="cid_atual" id="icid_atual" type="text"><br>
            </p>
            <p>
                <label for="iendereco">Logradouro: AV/RUA </label><br>
                <input required value="<?php echo $usuario['endereco']; ?>" name="endereco" id="iendereco" type="text"><br>
            </p>
            <p>
                <label for="inum">N°: </label><br>
                <input required value="<?php echo $usuario['numero']; ?>" name="numero" id="inum" type="text"><br>
            </p>
            <p>
                <label for="ibairro">Bairro: </label><br>
                <input required value="<?php echo $usuario['bairro']; ?>" name="bairro" id="ibairro" type="text"><br>
            </p>
        </fieldset>
        <fieldset>
            <legend>Contatos</legend>
            <p>
                <label for="icelular1">Celular 1: </label><br>
                <input required value="<?php echo $usuario['celular1']; ?>" name="celular1" id="icelular1" type="text" placeholder="(00) 00000-0000" size="" oninput="formatarCelular1(this)" onblur="verificaCelular1()"><br>
            </p>
            <p>
                <label for="icelular2">Celular 2: Opcional </label><br>
                <input value="<?php echo $usuario['celular2']; ?>" name="celular2" id="icelular2" type="text" placeholder="(00) 00000-0000" size="" oninput="formatarCelular2(this)" onblur="verificaCelular2()"><br>
            </p>
            <p>
                <label for="iemail">E-mail:</label><br>
                <input required value="<?php echo $usuario['email']; ?>" name="email" id="iemail" type="email"><br>
            </p>
        </fieldset>
        <p>
            <span id="imgAlerta"></span><br>
            <a href="home.php">Voltar</a><a href="redefinir_senha.php">Redefinir Senha</a>
            <button type="submit">Salvar</button>
        </p>
        <script src="../inscricao/verifica_dados.js"></script>
    </form>
</body>
</html>

