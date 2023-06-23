
const btnCarrito = document.getElementById("carrito");
const tallas = document.querySelectorAll('.talla');
const tamano = document.getElementById("idTamano");
const btnGuardar = document.getElementById("enviar");
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
  

const enviarDatos = async (idTamanos, cantidad) => {
  const data = new FormData();
  data.append('idTamano', idTamanos);
  data.append('cantidad', cantidad);

  try {
    const respuesta = await fetch('./tienda_agregar_carrito.php', {
      method: 'POST',
      body: data
    });

    if (respuesta.ok) {
      const data = await respuesta.json();
      console.log("respuesta de fetch ", data[0].cantidadTotalCarrito);

      // Hacer más acciones con los datos recibidos
      return data[0].cantidadTotalCarrito; // Indica que los datos se enviaron correctamente
    } else {
      throw new Error('Error en la solicitud. Estado: ' + respuesta.status);
    }
  } catch (error) {
    console.error('Error:' + error.message);
    return false; // Indica que hubo un error al enviar los datos
  }
};







const form = document.getElementById('myForm');
const notificacion = document.getElementById('notificacion'); // Asumiendo que tienes un elemento HTML con el id 'notificacion'

form.addEventListener('submit', async (event) => {
  event.preventDefault(); // Evita que el formulario se envíe

  // Ejemplo de validación de talla seleccionada
  const tallaSeleccionada = document.querySelector('input[name="idTamanos"]:checked');
  if (!tallaSeleccionada) {
    alert("Debe seleccionar una talla.");
    return;
  }

  // Ejemplo de validación de cantidad ingresada
  const cantidadValue = parseInt(document.getElementById('cantidad').value);
  if (isNaN(cantidadValue) || cantidadValue < 1) {
    alert("Debe ingresar una cantidad válida.");
    return;
  }

  const datosEnviados = await enviarDatos(tallaSeleccionada.value, cantidadValue);
  if (datosEnviados) {
    const counter = document.getElementById("counter");
    counter.innerHTML = datosEnviados
    notificacion.classList.add('notificacion--active');
  }
});

















































 
 





 



 

 


