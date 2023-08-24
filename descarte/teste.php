<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ficha de Inscrição</title>
</head>
<body>
    <h1>Ficha de Inscrição</h1>
    <form action="deu_certo.php" method="POST" enctype="multipart/form-data" autocomplete="on" id="idados">
    
        <img height="200" for="img" src="../arquivos/9734564-default-avatar-profile-icon-of-social-media-user-vetor.jpg" alt=""><br>
        <input name="foto" type="file" id="img">
        <br>

        <span id="imgAlerta"></span>

        <p>
            <label for="idata">Data: </label><br>
            <input type="text" id="idata" name="data" oninput="formatarData(this)" onblur="verificaData()"><br><br>

            <label for="icpf">CPF:</label><br>
            <input type="text" id="icpf" oninput="formatCPF(this)" onblur="verificaCpf()">
        </p>
        <p>
            <input id="solicitar" type="submit" value="Solicitar">
        </p>
        <script src="verifica_dados.js"></script>
    </form>
    
</body>
</html>