


const ocultarSidebar = () => {
    
    const btnSidebar = document.getElementById("btn-sidebar");
    const sidebar = document.getElementById("sidebar");
    const contenido = document.getElementById("contenido");
  
    let sidebarVisible = true;
  
    btnSidebar.addEventListener("click", () => {
      sidebarVisible = !sidebarVisible;
  
      if (sidebarVisible) {
        // Mostrar la barra lateral
        sidebar.classList.remove("d-none");
        contenido.classList.remove("col-lg-12");
        contenido.classList.add("col-lg-10");
      } else {
        // Ocultar la barra lateral
        sidebar.classList.add("d-none");
        contenido.classList.remove("col-lg-10");
        contenido.classList.add("col-lg-12");
      }
    });
  };
  
  document.addEventListener("DOMContentLoaded", ocultarSidebar);
