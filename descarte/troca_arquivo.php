<?php
        if (isset($_FILES['novo_estatuto']) && $_FILES['novo_estatuto']['error'] != 4) {
            $arq = $_FILES['novo_estatuto'];
            $pathEstatuto = enviarArquivoEstatuto($arq['error'], $arq['name'], $arq['tmp_name']);
            echo $pathEstatuto.'0';
            if ($pathEstatuto !== false) {
               
                $estatuto_int = $pathEstatuto;
                echo $estatuto_int.'1';
                //if(isset($_POST['estatuto'])) {
                   $estatuto = $_POST['estatuto'].'2';
                   echo $estatuto;
                    unlink($estatuto);
                //} 
            } else {
                if(isset($_POST['estatuto']) && $_POST['estatuto'] !== '') {
                    $estatuto_int = $mysqli->escape_string($_POST['estatuto']);
                    echo $estatuto_int.'3';
                }else{
                    $estatuto_int = '';
                }
            }
        } else {
            if(isset($_POST['estatuto']) && $_POST['estatuto'] !== '') {
                $estatuto_int = $mysqli->escape_string($_POST['estatuto']);
                echo $estatuto_int.'3';
            }else{
                $estatuto_int = '';
            }
        }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <p>
            <label for="iEst">Estatuto interno:</label><br>
            <input type="text" name="estatuto" id="iEst" value="">
            <input type="file" accept=".pdf, .doc, .docx" name="novo_estatuto" id="inovo_estatuto"></p>
        </p>
    </form>

</body>
</html>