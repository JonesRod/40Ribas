// Função para exibir ou esconder o menu
/*function toggleMenu() {
    //console.log('oii');
    var menu = document.getElementById('imenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

}*/
function toggleMenu() {
    var menu = document.getElementById('imenu');
    menu.classList.toggle('aberto');
    console.log('oii'); 
}

function abrirNaDiv(link) {
    var div = document.getElementById('iconteudo');
    div.innerHTML = '<object type="text/html" data="' + link + '" style="width:100%; height:100%;">';
}