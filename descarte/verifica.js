const formulario = document.querySelector("#idados");

formulario.onsubmit = evento => {
    //recebe os valores
    var nasc = new Date(document.querySelector('#inascimento').value);
    var inicio = new Date('1900-01-01');

    //console.log(nasc);
    //console.log(date1 > date2);
    //console.log(date1 >= date2);
    //evento.preventDefault();

    if(nasc.length < 10){
        evento.preventDefault();
        document.getElementById("imgAlerta").innerHTML = "Data invalida!"
        return;
    }

    if(nasc.length > 10){
        evento.preventDefault();
        document.getElementById("imgAlerta").innerHTML = "Data invalida!"
        return;
    }

    if(inicio > nasc){     
        evento.preventDefault();
        document.getElementById("imgAlerta").innerHTML = "Data invalida!"
        return;
    }

}