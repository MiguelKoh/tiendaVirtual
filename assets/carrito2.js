
const changeCounter = async ()=>{
 
    try {
       const counter = document.getElementById("counter");
       const respuesta = await fetch("./mostrar_total_carrito.php");
       const data = await respuesta.json();
       counter.innerHTML = data[0].cantidadTotalCarrito;
   
     } catch(error){
       console.log(error);
     }
   }//fin de changeCounter
   


   function isPositiveInteger(value) {
    var regex = /^[1-9][0-9]*$/;
    if (value.match(regex)) {
      return true;
    }
    return false;
  }//fin de isPositiveInteger
  

   function bindQuantityInputChangeListener(quantityInput) {
    quantityInput.addEventListener('change', function() {
      if (isPositiveInteger(quantityInput.value)) {
        var parentRow = quantityInput.closest('.row');
        var newCol =  '<div class="col-lg-9 col-sm-12 px-0 d-flex mt-sm-2">' +
                       '<button class="update btn btn-default btn-sm" type="button">Actualizar</button>' +
                      '</div>';
                      
        parentRow.insertAdjacentHTML('beforeend', newCol);
        quantityInput.removeEventListener('change', arguments.callee);
      } else {
        quantityInput.value = '';
      }
    });
  }//fin de funcion
  


const quantityInputs = document.getElementsByName("cantidad");
quantityInputs.forEach((quantityInput) => {
  bindQuantityInputChangeListener(quantityInput);
});




















/* 
 const quantityInputs = document.getElementsByName('cantidad');

 for (let i = 0; i < quantityInputs.length; i++) {
   quantityInputs[i].addEventListener('change', function() {
     alert('prueba');
   });
 }

 quantityInputs.forEach((quantityInput)=>{
    quantityInput.addEventListener('change',()=>{
        alert('prueba2')
    })
 }) */