    
    <script> // funcionamiento del modo oscuro
        const toggle = document.querySelector('#darkModeToggleInput'); // el input real
        const body = document.querySelector('body');

        if (toggle) {
            load();

            // Detectar cambio de estado
            toggle.addEventListener('change', () => {
                body.classList.toggle('dark');
                store(body.classList.contains('dark'));
            });
        }

        // Cargar estado guardado
        function load() {
            const darkmode = localStorage.getItem('dark') === 'true';
            body.classList.toggle('dark', darkmode);
            if (toggle) toggle.checked = darkmode; // refleja el estado en el toggle
        }

        // Guardar estado
        function store(value) {
            localStorage.setItem('dark', value);
        }
    </script>
<!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>