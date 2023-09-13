/*// Captura o botão e o menu
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
});*/
function abrirNaDiv(link) {
    var div = document.getElementById('icentro');
    div.innerHTML = '<object type="text/html" data="' + link + '" style="width:100%; height:100%;">';
}
document.addEventListener('DOMContentLoaded', function() {
    var menuBtn = document.getElementById('menuBtn');
    var menu = document.getElementById('menu');
    var leftDiv = document.querySelector('.left');

    // Adiciona um evento de clique ao botão
    menuBtn.addEventListener('click', function() {
        // Alterna a visibilidade do menu
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
            leftDiv.style.display = 'none'; // Oculta a div esquerda
        } else {
            menu.style.display = 'block';
            leftDiv.style.display = 'block'; // Exibe a div esquerda
        }
    });
});
