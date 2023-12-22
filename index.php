<?php
/**
 * Plugin Name: PBO Search
 * Plugin URI: 
 * Description: incorpore o mecanismo de pesquisa PBO em seu site usando um [shortcode].
 * Version: 1.0.0
 * Author: Enzo Franco
 * Author URI: https://www.linkedin.com/in/enzo-franco/
 * License: GPL2
 */

 // Registro de la función de activación
register_activation_hook(__FILE__, 'plugin_activation');

// Función que se ejecuta al activar el plugin
function plugin_activation() {
    // Verifica si la opción ya existe antes de agregarla
    if (!get_option('version')) {
        // Agrega la opción con el valor inicial (0)
        add_option('version', 0);
    }
}

// Función para mostrar el formulario
include plugin_dir_path(__FILE__) . 'search-form.php';

// Función para agregar una página de configuración
function agregar_pagina_configuracion() {
    add_menu_page(
        'Configuración de mis datos de afiliado',    // Título que aparecerá en el menú
        'PBO search',                // Texto en el menú
        'manage_options',                         // Capacidad requerida para acceder a esta página (en este caso, administradores)
        'configuracion-datos-afiliado',                   // Slug único de la página
        'mostrar_configuracion'            // Función que mostrará el contenido de la página de configuración
    );
}
add_action('admin_menu', 'agregar_pagina_configuracion');

include plugin_dir_path(__FILE__) . 'config-page.php';



