<?php

//actualiza desde el boton
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    get_and_save_points_list_in_data_base();
}

// Programa la tarea diaria
function my_custom_cron_schedule() {
    if ( ! wp_next_scheduled( 'my_daily_event' ) ) {
        wp_schedule_event( time(), 'daily', 'my_daily_event' );
    }
}
add_action( 'wp', 'my_custom_cron_schedule' );

// Función que se ejecuta diariamente
function my_daily_function() {
    get_and_save_points_list_in_data_base();

}
add_action( 'my_daily_event', 'my_daily_function' );

function get_and_save_points_list_in_data_base() {

    $data = http_request();
    $points_list = $data->puntos;
    $new_version = $data->version;
    if ($points_list) {
        update_option('points_list', $points_list);
        update_option('version', $new_version);
    }
}

function http_request() {
    $response = wp_remote_get('https://syspbo.com/api/rutas/puntos_afiliados?emp_id=' . esc_attr(get_option('emp_id')) . '&afiliado_id=' . esc_attr(get_option('afiliado_id')) . '&version=' . esc_attr(get_option('version')) . '&sec=' . esc_attr(get_option('sec')) . '');

    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        if ($data) {
            return $data;
        }
    }
}
