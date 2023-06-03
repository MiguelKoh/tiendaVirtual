


const obtenerImagenMedidas = async (id) => {
   
   try {
    let imagen = '';
    const imagenContainer = document.getElementById("medidas"); 
    const rutaImagen = await fetch(`http://localhost/tienda-virtual/obtenerImagenMedidas.php?idTamano=${id}`);
    const respuestaRutaImagen = await rutaImagen.json();
    imagen = `<img class="w-75" src="imagenes/productos/${respuestaRutaImagen[0].rutaImagen}" alt="Card image cap">`
    console.log(imagen);
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












