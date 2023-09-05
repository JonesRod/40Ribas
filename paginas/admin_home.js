// Captura o botão e o menu
// Captura o botão e o menu
var menuBtn = document.getElementById('menuBtn');
var menu = document.getElementById('menu');

// Adiciona um evento de clique ao botão
menuBtn.addEventListener('click', function() {
    // Alterna a visibilidade do menu
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
});
