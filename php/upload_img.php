<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["imagem"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar se é uma imagem real
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagem"]["tmp_name"]);
        if ($check !== false) {
            echo "Arquivo é uma imagem - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "O arquivo não é uma imagem.";
            $uploadOk = 0;
        }
    }

    // Verificar se o arquivo já existe
    if (file_exists($targetFile)) {
        echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    // Verificar o tamanho do arquivo
    if ($_FILES["imagem"]["size"] > 500000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    // Permitir apenas certos formatos de arquivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        $uploadOk = 0;
    }

    // Verificar se $uploadOk é definido como 0 por um erro
    if ($uploadOk == 0) {
        echo "Desculpe, o arquivo não foi carregado.";
    // Se tudo estiver OK, tenta carregar o arquivo
    } else {
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
            echo "O arquivo " . basename($_FILES["imagem"]["name"]) . " foi carregado.";
            
        } else {
            echo "Desculpe, houve um erro ao carregar o arquivo.";
        }
    }
}
?>