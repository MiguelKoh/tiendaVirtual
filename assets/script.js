
const btnCarrito = document.getElementById("carrito");
const notificacion = document.getElementById("notificacion");
const tallas = document.querySelectorAll('.talla');
const tamano = document.getElementById("idTamano");
const btnGuardar = document.getElementById("carrito");
const cantidad = document.getElementById("cantidad");

const obtenerImagenMedidas = async (id) => {
   
   try {
    let imagen = '';
    const imagenContainer = document.getElementById("medidas"); 
    const rutaImagen = await fetch(`./obtenerImagenMedidas.php?idTamano=${id}`);
    const respuestaRutaImagen = await rutaImagen.json();
    imagen = `<img class="w-75" src="imagenes/productos/${respuestaRutaImagen[0].rutaImagen}" alt="Card image cap">`
    /*console.log(imagen);*/
    imagenContainer.innerHTML = imagen;

  } catch(error){
    console.log(error);
  }

}//fin funcion


  
const mostrarMedidas = ()=>{
  tallas.forEach((talla) => {
      
      talla.addEventListener('click',()=>{
        obtenerImagenMedidas(talla.value);
      
      });

   });

}//fin de mostrarMedidas

document.addEventListener("DOMContentLoaded",mostrarMedidas());
  





btnGuardar.addEventListener("click", ()=>{
 
  tallas.forEach((talla)=>{
    if(talla.checked){
    console.log(talla.value);
    }
    
  })
    console.log(cantidad.value);


})





/*
 
 const enviarDatos = async () => {
  const datos = {
    idTamano: 'Juan',
    cantidad: 25,
  };

  try {
    const respuesta = await fetch('./tienda_agregar_carrito.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(datos),
    });

    const data = await respuesta.json();
    console.log(data);
    // Hacer más acciones con los datos recibidos
  } catch (error) {
    console.error('Error:', error);
    // Manejar errores
  }
};

enviarDatos();

*/


btnCarrito.addEventListener("click",()=>{

 notificacion.classList.add('notificacion--active');

});

 

 


