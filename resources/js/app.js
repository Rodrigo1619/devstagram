import Dropzone from "dropzone";

//para que no busque el comportamiento de la clase dropzone, sino que nosotros se lo daremos en un endopoint especifico
Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube la imagen aquí",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //leer archivo que se sube para mostrarlo en el dom
    //esta funcion se ejecuta al nomas se crea un dropzone
    init: function(){
        //que se ejecute solamente si value de nuestra imagen en create.blade de post tenga algo
        if(document.querySelector('[name = "imagen"]').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234; //solo se pone valor por llenar, ese valor no importa
            imagenPublicada.name = document.querySelector('[name = "imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            //clases de dropzone
            imagenPublicada.previewElement.classList.add(
                "dz-succes", "dz-complete"
            );


        }
    },
});


dropzone.on("success", function(file, response){
    //console.log(response.imagen); //este valor hay que agregarlo a nuestro input hidden en create.blade de posts
    document.querySelector('[name = "imagen"]').value = response.imagen;
});

dropzone.on("error", function(file, message){
    console.log(message);
});

//si se elimina la imagen, que se elimine el valor de mi formulario tambien
dropzone.on("removedfile", function(){
    //console.log("archivo eliminado");
    document.querySelector('[name = "imagen"]').value = "";
});