<!-- Sidebar -->
<div class="sidebar-wrapper">
    <!-- Brand -->
    <div class="brand">
        <ion-icon name="grid"></ion-icon>
        <h3>Sistema</h3>
        <small>Panel de Control</small>
    </div>
    
    <!-- User Profile Section -->
    <div class="user-profile">
        <img src="<?php echo SERVER_URL; ?>views/image/perfil.png" alt="User Avatar" class="user-avatar">
        <h5><?php echo isset($_SESSION['nombre_smp']) ? $_SESSION['nombre_smp'] : 'Usuario'; ?></h5>
        <small><?php echo isset($_SESSION['apellido_paterno_smp']) ? $_SESSION['apellido_paterno_smp'] : 'Administrador'; ?></small>
    </div>
    
    <!-- Contenido principal del sidebar -->
    <div class="sidebar-content">
        <!-- Menú principal con scroll -->
        <div class="sidebar-menu">
            <a href="<?php echo SERVER_URL; ?>dashboard/" class="menu-item" data-page="dashboard">
                <span class="menu-icon"><ion-icon name="speedometer-outline"></ion-icon></span>
                <span>Dashboard</span>
            </a>
            
        <a href="<?php echo SERVER_URL; ?>index.php?view=productos" class="menu-item" data-page="productos">
            <span class="menu-icon"><ion-icon name="cube-outline"></ion-icon></span>
            <span>Productos</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>index.php?view=servicios" class="menu-item" data-page="servicios">
            <span class="menu-icon"><ion-icon name="construct-outline"></ion-icon></span>
            <span>Servicios</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>noticias/" class="menu-item" data-page="noticias">
            <span class="menu-icon"><ion-icon name="newspaper-outline"></ion-icon></span>
            <span>Noticias</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>index.php?view=mensaje" class="menu-item" data-page="mensaje">
            <span class="menu-icon"><ion-icon name="mail-outline"></ion-icon></span>
            <span>Mensajes</span>
        </a>
            
            <a href="<?php echo SERVER_URL; ?>pagina/" class="menu-item" data-page="pagina">
                <span class="menu-icon"><ion-icon name="globe-outline"></ion-icon></span>
                <span>Página</span>
            </a>
        </div>
        
        <!-- Perfil siempre en la parte inferior -->
        <div class="sidebar-footer">
            <div class="separator"></div>
            <div class="has-submenu">
                <button class="menu-item" id="btn-perfil" data-page="perfil">
                    <span class="menu-icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                    <span>Perfil</span>
                    <ion-icon name="chevron-down-outline" class="menu-arrow"></ion-icon>
                </button>
                <div class="submenu" id="submenu-perfil">
                    <a href="<?php echo SERVER_URL; ?>perfil/" class="menu-item">
                        <span class="menu-icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span>Mi Perfil</span>
                    </a>
                    <a href="<?php echo SERVER_URL; ?>logout/" class="menu-item text-danger">
                        <span class="menu-icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentLocation = window.location.pathname.toLowerCase();
        const navLinks = document.querySelectorAll('.menu-item');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.querySelector('.sidebar-wrapper');
        const body = document.body;

        // Toggle Submenu Perfil
        const btnPerfil = document.getElementById('btn-perfil');
        const submenuPerfil = document.getElementById('submenu-perfil');
        if (btnPerfil && submenuPerfil) {
            btnPerfil.addEventListener('click', function() {
                // Si el sidebar está colapsado en escritorio, expandirlo
                if (window.innerWidth > 991.98 && body.classList.contains('sidebar-collapsed')) {
                    body.classList.remove('sidebar-collapsed');
                }
                
                submenuPerfil.classList.toggle('show');
                btnPerfil.classList.toggle('open');
            });
        }

        // Sidebar toggle
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                if (window.innerWidth > 991.98) {
                    // Desktop view: toggle collapsed class
                    body.classList.toggle('sidebar-collapsed');
                    
                    // Ocultar todos los submenus al colapsar el sidebar
                    if (body.classList.contains('sidebar-collapsed')) {
                        const submenus = document.querySelectorAll('.submenu.show');
                        const menuItems = document.querySelectorAll('.menu-item.open');
                        
                        submenus.forEach(submenu => submenu.classList.remove('show'));
                        menuItems.forEach(item => item.classList.remove('open'));
                    }
                } else {
                    // Mobile view: toggle off-canvas
                    sidebar.classList.toggle('show');
                }
            });
            
            // Detectar cambios de tamaño de ventana para ajustar automáticamente
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 991.98) {
                    // En tablets y móviles, sidebar se oculta automáticamente
                    body.classList.remove('sidebar-collapsed');
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 991.98 && sidebar.classList.contains('show')) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        }
    });
</script>
