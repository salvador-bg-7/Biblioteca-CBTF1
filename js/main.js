function buscar_datos(consulta){
    $.ajax({
        URL: 'buscar.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
    .donde(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    })
}





