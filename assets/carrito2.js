
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
        let parentRow = quantityInput.closest('.row');
        let newCol =  '<div class="col-lg-9 col-sm-12 px-0 d-flex mt-sm-2">' +
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

$('.cantidad').on('click', '.update', function () {
    var updateButton = $(this);
    var quantityInput = updateButton.closest('.cantidad').find('input');
    var productID = updateButton.closest('tr').attr('id');

    if (isPositiveInteger(quantityInput.val())) {
        productPrize = updateButton.closest('td').siblings().find('.precio-producto');
        $.ajax({
            url: 'tienda_cambiar_cantidad.php',
            method: 'POST',
            dataType: 'json',
            data: {
                id: productID,
                cantidad: quantityInput.val()
            },
            success: function (result) {
                changeCounter()
                $('#total').html('<strong class="text-primary">&dollar;' + result.precioTotal + '</strong>');
                productPrize.html('&dollar;' + result.precioTotalProducto);
            }
        });
    } else {
        quantityInput.val('');
    }

    bindQuantityInputChangeListener(quantityInput);
    updateButton.closest('.col').remove();
});



