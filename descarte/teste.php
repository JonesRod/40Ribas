<?php
function processarArquivo() {
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = $_FILES['arquivo']['name'];
        //move_uploaded_file($_FILES['arquivo']['tmp_name'], 'caminho/para/diretorio/' . $nomeArquivo);
        echo ('../arquivos/') .$nomeArquivo;
        return $nomeArquivo;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeArquivo = processarArquivo();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload de Arquivo</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="arquivo">
        <input type="submit" value="Enviar" >
    </form>
    
    <?php if (isset($nomeArquivo)): ?>

        
    <?php endif; ?>
<img id="img" src="<?php echo ('../arquivos/') .$nomeArquivo; ?>">
</body>
</html>
