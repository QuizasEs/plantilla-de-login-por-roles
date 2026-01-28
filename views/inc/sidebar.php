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
    
    <!-- Menú -->
    <div class="sidebar-menu">
        <a href="<?php echo SERVER_URL; ?>dashboard/" class="menu-item" data-page="dashboard">
            <span class="menu-icon"><ion-icon name="speedometer-outline"></ion-icon></span>
            <span>Dashboard</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>productos/" class="menu-item" data-page="productos">
            <span class="menu-icon"><ion-icon name="cube-outline"></ion-icon></span>
            <span>Productos</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>servicios/" class="menu-item" data-page="servicios">
            <span class="menu-icon"><ion-icon name="construct-outline"></ion-icon></span>
            <span>Servicios</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>noticias/" class="menu-item" data-page="noticias">
            <span class="menu-icon"><ion-icon name="newspaper-outline"></ion-icon></span>
            <span>Noticias</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>mensaje/" class="menu-item" data-page="mensaje">
            <span class="menu-icon"><ion-icon name="mail-outline"></ion-icon></span>
            <span>Mensajes</span>
        </a>
        
        <a href="<?php echo SERVER_URL; ?>pagina/" class="menu-item" data-page="pagina">
            <span class="menu-icon"><ion-icon name="globe-outline"></ion-icon></span>
            <span>Página</span>
        </a>
        
        <div class="separator"></div>
        
        <div class="menu-footer">
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
                } else {
                    // Mobile view: toggle off-canvas
                    sidebar.classList.toggle('show');
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
