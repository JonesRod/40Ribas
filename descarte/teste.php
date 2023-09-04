<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Escolha o tipo de login:</h2>
    <form id="escolherLoginForm">
        <label>
            <input type="radio" name="tipoLogin" value="admin"> Admin
        </label>
        <label>
            <input type="radio" name="tipoLogin" value="usuario"> Usuário
        </label>
        <button type="button" onclick="mostrarFormulario()">Escolher</button>
    </form>

    <!-- Formulário de login para admin -->
    <form id="adminLoginForm" style="display: none;">
        <h2>Login de Admin</h2>
        <label for="adminUsuario">Nome de Usuário:</label>
        <input type="text" id="adminUsuario" name="adminUsuario">
        <label for="adminSenha">Senha:</label>
        <input type="password" id="adminSenha" name="adminSenha">
        <button type="submit">Login</button>
    </form>

    <!-- Formulário de login para usuário -->
    <form id="usuarioLoginForm" style="display: none;">
        <h2>Login de Usuário</h2>
        <label for="usuarioEmail">Email:</label>
        <input type="email" id="usuarioEmail" name="usuarioEmail">
        <label for="usuarioSenha">Senha:</label>
        <input type="password" id="usuarioSenha" name="usuarioSenha">
        <button type="submit">Login</button>
    </form>

    <script>
        function mostrarFormulario() {
            var escolha = document.querySelector('input[name="tipoLogin"]:checked').value;
            if (escolha === "admin") {
                document.getElementById("adminLoginForm").style.display = "block";
                document.getElementById("usuarioLoginForm").style.display = "none";
            } else if (escolha === "usuario") {
                document.getElementById("adminLoginForm").style.display = "none";
                document.getElementById("usuarioLoginForm").style.display = "block";
            }
        }
    </script>
</body>
</html>
