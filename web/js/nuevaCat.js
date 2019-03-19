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

// documentacion jquey Get
function cambiarIngredCheck(){
    $.getJSON("http://localhost:8000/api/listarIngredientes", function(data) {
        var ultimoIngred = data[data.length-1];
        //problemas con el widget checkbox
        $(tapa_ingredientes).append('<p>Añadido</p>');
    });
}

// documentacion jquey Post
function nuevoIngredAdd(){
    var ejecutarNuevaCat = $.post("http://localhost:8000/api/insertarIngrediente/" + $(nuevoIngred).val(), function(){
        $(nuevoIngred).val("");
        cambiarCatSelect();
        alert("Nuevo ingrediente creado");
    })
    .fail(function(){
        alert("Error al crear el ingrediente")
    });
}
