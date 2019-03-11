// documentacion jquey Get
function cambiarCatSelect(){
    $.getJSON("http://localhost:8000/api/listarCategorias", function(data) {
        var ultimaCat = data[data.length-1];
        $(tapa_categoria).append(new Option(ultimaCat["nombre"], ultimaCat["id"]));
    });
}

// documentacion jquey Post
function nuevaCatAdd(){
    var ejecutarNuevaCat = $.post("http://localhost:8000/api/insertarCategoria/" + $(nuevaCat).val(), function(){
        $(nuevaCat).val("");
        cambiarCatSelect();
        alert("Nueva categoria creada");
    })
    .fail(function(){
        alert("Error al crear la categoria")
    });
}
