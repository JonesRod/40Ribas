<!DOCTYPE html>
<html>
<head>
    <title>Exemplo</title>
    <style>
        html, body, #minhaDiv {
            height: 95%;
            margin: 0;
        }
    </style>
    
    <script>
        function abrirNaDiv(link) {
            var div = document.getElementById('minhaDiv');
            div.innerHTML = '<object type="text/html" data="' + link + '" style="width:85%; height:100%;">';
        }
    </script>
</head>
<body>
    <ul>
        <li><a href="#" onclick="abrirNaDiv('../login/lib/paginas/administrativo/admin_config.php')">Configurações</a></li>
    </ul>
    <div id="minhaDiv"></div>
</body>
</html>
