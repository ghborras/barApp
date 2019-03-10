var tipos = ['image/jpeg', 'image/png'];

function validarTipos(file){
    for(var i=0; i<tipos.length; i++){
        if(file.type===tipos[i]){
            return true;
        } 
    }
    return false;
}

function onChange(event){
    var file=event.target.files[0];
    if(validarTipos(file)){
        var tapaMini=document.getElementById('tapaThumb');
        tapaThumb.src=window.URL.createObjectURL(file);
    }
}