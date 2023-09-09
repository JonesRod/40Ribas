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
    <form>
        <textarea id="meuTextarea" rows="4" cols="50">arquivos/64fb658ed01f6.pdf</textarea>
        <br>
        <iframe src="https://docs.google.com/viewer?url=http://../arquivos/Duvidas%20do%20NOVO%20REGIMENTO%20INTERNO%2040A%20RIBAS.pdf&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe><br>
        <input type="file" name="arquivo" accept=".pdf, .doc, .docx"><br>
        <button type="button" onclick="imprimirTexto(event)">Imprimir</button>
        <button type="button" onclick="baixarConteudo()">Baixar</button>
    </form>

    <script>
    function imprimirTexto(event) {
    // console.log('oi');
        // Evita o envio do formulário
        event.preventDefault();
        var conteudo = document.getElementById('meuTextarea').value;
        var janelaImpressao = window.open('', '_blank');
        janelaImpressao.document.write('<pre>' + conteudo + '</pre>');
        //janelaImpressao.document.close();
            // Adicionar um evento para fechar a janela após a impressão
            /*janela.onafterprint = function() {
                janela.close();
            };*/
        janelaImpressao.print();
    }
    function baixarConteudo() {
        // Obter o conteúdo da textarea
        var conteudo = document.getElementById("meuTextarea").value;

        // Criar um link de download
        var link = document.createElement('a');
        link.href = 'data:text/plain;charset=utf-8,' + encodeURIComponent(conteudo);
        link.download = 'meu_arquivo.txt';
        link.click();
    }
    </script>
</body>
</html>

