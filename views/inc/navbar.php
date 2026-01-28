<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <!-- Sidebar Toggle Button -->
        <button class="btn btn-light me-3" type="button" id="sidebar-toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </button>
        
        <!-- Dynamic Page Title -->
        <div class="navbar-brand d-none d-sm-flex">
            <div class="brand-icon">
                <ion-icon name="grid-outline"></ion-icon>
            </div>
            <div class="brand-text">
                <h6 id="page-title">Dashboard</h6>
                <small>Panel de Control</small>
            </div>
        </div>
        
        <!-- Right side content -->
        <div class="navbar-nav ms-auto align-items-center flex-row">
            <!-- Notifications -->
            <div class="dropdown me-2">
                <button class="btn btn-light position-relative d-flex align-items-center justify-content-center p-2 rounded-circle" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" style="width: 40px; height: 40px;">
                    <ion-icon name="notifications-outline" style="font-size: 1.4rem;"></ion-icon>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem; padding: 0.35em 0.6em;">3</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm border-0" style="min-width: 220px; max-width: 300px; position: absolute; transform: translate3d(0, 40px, 0); top: 100%; right: 0; left: auto; will-change: transform;">
                    <li class="dropdown-header d-flex justify-content-between align-items-center">
                        <span>Notificaciones</span>
                        <span class="badge bg-primary rounded-pill">3</span>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center py-2" href="#"><ion-icon name="mail-outline" class="me-2"></ion-icon> Mensaje nuevo</a></li>
                    <li><a class="dropdown-item d-flex align-items-center py-2" href="#"><ion-icon name="cube-outline" class="me-2"></ion-icon> Producto actualizado</a></li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li><a class="dropdown-item text-primary text-center py-2" href="#">Ver todas</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pageTitle = document.getElementById('page-title');
        const currentPath = window.location.pathname.toLowerCase();
        
        const pageTitles = {
            'dashboard': 'Dashboard',
            'productos': 'Productos',
            'servicios': 'Servicios',
            'noticias': 'Noticias',
            'mensaje': 'Mensajes',
            'pagina': 'Página',
            'perfil': 'Perfil'
        };
        
        let title = 'Dashboard';
        for (const [key, value] of Object.entries(pageTitles)) {
            if (currentPath.includes(key)) {
                title = value;
                break;
            }
        }
        
        if (pageTitle) pageTitle.textContent = title;
    });
</script>
