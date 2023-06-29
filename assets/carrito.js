

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



function bindQuantityInputChangeListener(quantityInput) {
        quantityInput.change(function () {
            if (isPositiveInteger(quantityInput.val())) {
                var parentRow = quantityInput.closest(".row");
                parentRow.append('<div class="col-lg-9 col-sm-12 px-0 d-flex mt-sm-2">' +
                       '<button class="update btn btn-default btn-sm" type="button">Actualizar</button>' +
                      '</div>');
                quantityInput.off('change');
            } else {
                quantityInput.val('');
            }
        });
    }

    function isPositiveInteger(value) {
        if (value.match('^[1-9][0-9]*$')) {
            return true;
        }

        return false;
    }

    $(document).ready(function () {
        
        $('input[name=cantidad]').change(function () {
            if (isPositiveInteger($(this).val())) {
                var parentTD = $(this).closest(".row");
                parentTD.append('<div class="col-lg-9 col-sm-12 px-0 d-flex mt-sm-2">' +
                       '<button class="update btn btn-default btn-sm" type="button">Actualizar</button>' +
                      '</div>');
                $(this).off('change');
            } else {
                $(this).val('');
            }
        });

        $('.delete-item').click(function (event) {
            event.preventDefault();
            var parentTR = $(this).closest('tr');
            $.ajax({
                url: './tienda_eliminar_producto.php',
                method: 'post',
                data: {id: parentTR.attr('id')},
                success: function (result) {
                    // Checar si el resultado contiene algo.
                    if ($.trim(result)) {
                        parentTR.remove();
                        $('#total').html(result);
                        changeCounter();
                    } else {
                        $('#panel-productos').html('Carrito vac&iacute;o. <a href="tienda.php">Ir a tienda para agregar productos.</a>');
                        changeCounter();
                        $('#generar-ficha').addClass('disabled');
                    }
                }
            });
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
                        changeCounter();
                        $('#total').html('<strong class="text-primary">&dollar;' + result.precioTotal + '</strong>');
                        productPrize.html('&dollar;' + result.precioTotalProducto);
                    }
                });
            } else {
                quantityInput.val('');
            }

            bindQuantityInputChangeListener(quantityInput);
            updateButton.closest('.update').remove();
        });
    })
    




