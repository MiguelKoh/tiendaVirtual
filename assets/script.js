
const tallas = document.querySelectorAll('.talla');
const tamano = document.getElementById("idTamano");
const btnGuardar = document.getElementById("enviar");
const cantidad = document.getElementById("cantidad");



const obtenerImagenMedidas = async (id) => {
   
   try {
     
     let imagen = '';
     const imagenContainer = document.getElementById("medidas"); 
     const rutaImagen = await fetch(`./archivosAjax/obtenerImagenMedidas.php?idTamano=${id}`);
     const respuestaRutaImagen = await rutaImagen.json();
     imagen = `<img class="w-85" src="imagenes/productos/${respuestaRutaImagen[0].rutaImagen}" alt="Imagen no disponible">`
     imagenContainer.innerHTML = imagen;

  } catch(error){
    console.log(error);
  }

}//fin obtenerImagenMedidas


  
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
    const respuesta = await fetch('./archivosAjax/tienda_agregar_carrito.php', {
      method: 'POST',
      body: data
    });

    if (respuesta.ok) {
      const data = await respuesta.json();
      return data[0].cantidadTotalCarrito;
    
    } else {
      throw new Error('Error en la solicitud. Estado: ' + respuesta.status);
    }
  } catch (error) {
    console.error('Error:' + error.message);
    return false; // Indica que hubo un error al enviar los datos
  }
};


const resetFields = () => {

  const elementosRadio = document.getElementsByName("idTamanos");
  const cantidad = document.getElementById("cantidad");

  cantidad.value = 1;

  for (let i = 0; i < elementosRadio.length; i++) {
    elementosRadio[i].checked = false;
  }
};



const form = document.getElementById("myForm");
const notificacion = document.getElementById("notificacion");

form.addEventListener("submit", async (event) => {
  event.preventDefault(); // Evita que el formulario se envíe

  // Validación de talla seleccionada
  const tallaSeleccionada = document.querySelector(
    'input[name="idTamanos"]:checked'
  );
  if (!tallaSeleccionada) {
    alert("Debe seleccionar una talla");
    return;
  }

  // Validación de cantidad ingresada
  const cantidadValue = parseInt(document.getElementById("cantidad").value);
  if (isNaN(cantidadValue) || cantidadValue < 1) {
    alert("Debe ingresar una cantidad válida");
    return;
  }

  const datosEnviados = await enviarDatos(
    tallaSeleccionada.value,
    cantidadValue
  );

  if (datosEnviados) {
    const counter = document.getElementById("counter");
    counter.innerHTML = datosEnviados;

    resetFields();
  
    notificacion.classList.add("notificacion--active");

    setTimeout(() => {
      notificacion.classList.remove("notificacion--active");
    }, 8000);


  }
});

