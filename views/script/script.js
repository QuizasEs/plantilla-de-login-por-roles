



// ===================================================
// 📊 GRÁFICO DE INGRESOS Y EGRESOS (ECharts)
// ===================================================
(function () {
    const graphyc = document.getElementById('graphyc');

    if (graphyc && typeof echarts !== 'undefined') {
        const myChart = echarts.init(graphyc);

        const option = {
            title: { text: 'INGRESOS EGRESOS' },
            tooltip: {},
            legend: { data: ['egresos', 'ingresos'] },
            xAxis: {
                data: ['LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO']
            },
            yAxis: {},
            series: [
                {
                    name: 'egresos',
                    type: 'bar',
                    data: [5, 25, 36, 10, 10, 34, 1]
                },
                {
                    name: 'ingresos',
                    type: 'bar',
                    data: [1, 20, 56, 10, 13, 20, 1]
                }
            ]
        };

        myChart.setOption(option);
    } else if (!graphyc) {
        console.warn("⚠️ No se encontró el elemento #graphyc, se omite la carga del gráfico.");
    } else {
        console.warn("⚠️ ECharts no está definido. Asegúrate de cargar la librería antes de este script.");
    }
})();




// ===================================================
// 📄 PAGINACIÓN SIN RECARGAR PÁGINA
// ===================================================
(function () {
    // Delegar eventos para los enlaces de paginación
    document.addEventListener('click', function (e) {
        const target = e.target.closest('.pagination-link');
        if (target) {
            e.preventDefault();
            const page = target.getAttribute('data-page');
            if (page) {
                handlePagination(page);
            }
        }
    });

    // Función para manejar la paginación
    function handlePagination(page) {
        // Obtener la URL base de la página actual
        const currentUrl = window.location.href;
        const baseUrl = currentUrl.split('?')[0].split('#')[0];
        
        // Construir la nueva URL
        const newUrl = baseUrl.replace(/\/\d+\/?$/, '') + '/' + page + '/';
        
        // Realizar la solicitud AJAX
        fetch(newUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.text();
        })
        .then(html => {
            // Crear un contenedor temporal para analizar el HTML
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Obtener el contenido de la tabla y la paginación
            const newTable = doc.querySelector('.table-container');
            const newPagination = doc.querySelector('.pagination-container');
            
            if (newTable && newPagination) {
                // Actualizar el contenido
                document.querySelector('.table-container').innerHTML = newTable.innerHTML;
                document.querySelector('.pagination-container').innerHTML = newPagination.innerHTML;
                
                // Actualizar la URL sin recargar la página
                history.pushState({ page: page }, '', newUrl);
                
                // Mostrar mensaje de éxito
                showNotification('Página ' + page + ' cargada exitosamente', 'success');
            } else {
                throw new Error('No se encontró contenido de tabla o paginación en la respuesta');
            }
        })
        .catch(error => {
            console.error('Error en la paginación:', error);
            showNotification('Error al cargar la página: ' + error.message, 'error');
        });
    }

    // Función para mostrar notificaciones
    function showNotification(message, type) {
        // Crear el elemento de notificación
        const notification = document.createElement('div');
        notification.className = 'notification notification-' + type;
        notification.textContent = message;
        
        // Estilos básicos para la notificación
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.padding = '15px 25px';
        notification.style.borderRadius = '5px';
        notification.style.zIndex = '9999';
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease';
        
        // Colores según el tipo
        if (type === 'success') {
            notification.style.backgroundColor = '#28a745';
            notification.style.color = '#fff';
        } else if (type === 'error') {
            notification.style.backgroundColor = '#dc3545';
            notification.style.color = '#fff';
        }
        
        // Añadir al DOM
        document.body.appendChild(notification);
        
        // Animar aparición
        setTimeout(() => {
            notification.style.opacity = '1';
        }, 10);
        
        // Eliminar después de 3 segundos
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Manejar el botón de retroceso del navegador
    window.addEventListener('popstate', function (event) {
        if (event.state && event.state.page) {
            // Si el estado tiene información de página, podrías recargar el contenido
            // Por ahora, simplemente recargamos la página para asegurar consistencia
            location.reload();
        }
    });
})();
