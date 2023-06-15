
const btnCarrito = document.getElementById("carrito");
const notificacion = document.getElementById("notificacion");




const obtenerImagenMedidas = async (id) => {
   
   try {
    let imagen = '';
    const imagenContainer = document.getElementById("medidas"); 
    const rutaImagen = await fetch(`./obtenerImagenMedidas.php?idTamano=${id}`);
    const respuestaRutaImagen = await rutaImagen.json();
    imagen = `<img class="w-100" src="imagenes/productos/${respuestaRutaImagen[0].rutaImagen}" alt="Card image cap">`
    /*console.log(imagen);*/
    imagenContainer.innerHTML = imagen;

  } catch(error){
    console.log(error);
  }

}//fin funcion

  
  let tallas = document.querySelectorAll('.talla');
  
  tallas.forEach((talla) => {
    
    talla.addEventListener('click',()=>{
      obtenerImagenMedidas(talla.value);
    
    });

 });

/*
 
 const enviarDatos = async () => {
  const datos = {
    nombre: 'Juan',
    edad: 25,
  };

  try {
    const respuesta = await fetch('', {
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

 




 










