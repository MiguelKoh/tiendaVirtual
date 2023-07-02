

<div class="col-lg-2 col-md-2 col-sm-12 fondoSidebar h-lg-100 h-sm-50" id="sidebar">
    <div>
        <div class="row mt-5 mb-4">
            <div class="col-12 px-0 d-flex justify-content-center">
                <img src="imagenes/banners/logo-uady-blanco.png" alt="Mountain View"
                    class="d-none d-xl-block d-lg-block d-md-block img-fluid w-50">
            </div>
        </div>
        
        <ul>

            <li>
                <p class="mb-0">ALUMNO: <span class="font-weight-normal"><?= $nombre_completo_alumno ?></span></p>

            </li>


              <a href="escolares.php" class="link">
                  <li>Escolares</li>
              </a>
              
              <a href="seleccionados.php" class="link">
                <li>Seleccionados</li>
              </a>

              <a href="tienda_carrito.php" class="link">
                <li>
                    <div>
                        <div>
                            <span><i class="fas fa-shopping-cart"></i></span>
                            <span>Mi carrito</span>
                            <span class="badge badge-pill badge-light" id="counter">
                                <?= $cantidadProductos?></span>
                        </div>
                    </div>
                </li>
            </a>
            
            
            <a href="salir.php" class="link">
                <li>
                    <div>
                        <div>
                            <span><i class="fas fa-sign-out-alt" aria-hidden="true"></i></span>
                            <span>Salir</span>
                        </div>
                    </div>
                </li>
            </a>


        
        </ul>

    </div>

</div>
