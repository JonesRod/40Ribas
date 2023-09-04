<!DOCTYPE html>
<html>
<head>
    <title>Exemplo de Ícone de Menu Hambúrguer</title>
    <style>
        /* Estilos para o botão de menu */
        .menu-button {
            display: inline-block;
            cursor: pointer;
        }

        /* As três barrinhas horizontais */
        .menu-bar {
            width: 30px;
            height: 3px;
            background-color: #333;
            margin: 6px 0;
        }
    </style>
</head>
<body>
    <div class="menu-button" onclick="mostrarMenu()">
        <div class="menu-bar"></div>
        <div class="menu-bar"></div>
        <div class="menu-bar"></div>
   

    <!-- Conteúdo do menu (inicialmente oculto) -->
    <div id="menu" style="display: none;">
        <ul>
            <li><a href="#">Configuração</a></li>
            <li><a href="#">Sair</a></li>
        </ul>
    </div>
 </div>
    <script>
        function mostrarMenu() {
            var menu = document.getElementById("menu");
            if (menu.style.display === "none") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }
    </script>
</body>
</html>

