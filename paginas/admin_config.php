<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração</title>
</head>
<body>
    <h1>Configurações do Administrador</h1>
    <form action="">
        <label for="">Logo do Club</label><br>
        <img id="preview" style="max-width: 300px;" src= ""><br>
        <input required type="file" id="imageInput" name="imageInput" accept=".png, .jpg, .jpeg" onchange="handleImageUpload(event)">
        <br>
        <p>
            <label>E-mail de notificação:</label><br>
            <input type="text">
        </p>
        <p>
            <label>E-mail de recuperação de senha:</label><br>
            <input type="text">           
        </p>
        <p>
            <label for="">Termos da Inscrição:</label><br>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </p>
        <p>
            <label for="">Estatuto interno:</label><br>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </p>
        <p>
            <label for="">Regimento interno:</label><br>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </p>

        <p>
            <a href="">Voltar</a>
            <button type="submit">Salvar</button>
        </p>
    </form>
</body>
</html>