$(document).ready(function() {
    $("#icpf").mask("000.000.000-00")
    $("#irg").mask("000.000.000")
    //$("#inascimento") .mask("00/00/0000")
    $("#icep") .mask("00.000-000")
    $("#icelular1") .mask("(00) 0000-00009")
    $("#icelular1") .blur(function(event){
        if ($(this).val(). length == 15){
            $("#icelular1").mask("(00) 00000-0009")
        }else{
            $("#icelular1").mask("(00) 0000-00009")
        }
    })

    $("#icelular2") .mask("(00) 0000-00009")
    $("#icelular2") .blur(function(event){
        if ($(this).val(). length == 15){
            $("#icelular2").mask("(00) 00000-0009")
        }else{
            $("#icelular2").mask("(00) 0000-00009")
        }
    })
})

function validardataDeNascimento(data){

    dataInicio= new Date('1900-01-01');

    data=new Date(data);

    if (data>dataInicio){
        console.log("Data Válida");
        return true;
    } else {
        console.log("Data Inválida");
        return false;
    }

}


function verificarAceite() {
    var checkbox = document.getElementById('aceito');
    var botaoEnviar = document.getElementById('solicitar');
    
    if (checkbox.checked) {
        botaoEnviar.disabled = false;
    } else {
        botaoEnviar.disabled = true;
    }
}