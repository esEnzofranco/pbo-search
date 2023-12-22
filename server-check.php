<?php

add_action('cron_server_check', 'request_and_save');

if (!wp_next_scheduled('cron_server_check')) {
    wp_schedule_event(time(), 'daily', 'cron_server_check');
}

function request_and_save() {

    function get_and_save_version() {
        $version = http_request();
        update_option('version', $version);
    }

function http_request() {

    $response = wp_remote_get('https://syspbo.com/api/rutas/puntos_afiliados?emp_id=' . esc_attr(get_option('emp_id')) . '&afiliado_id=' . esc_attr(get_option('afiliado_id')) . '&version=7&sec=' . esc_attr(get_option('sec')) . '');
        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body);

            if ($data) {
                return $data->version;
            }
        }
    }
}


