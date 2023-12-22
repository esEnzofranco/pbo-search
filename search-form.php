<?php

function mostrar_formulario($atts, $content) {

    $points_list = get_option('points_list');
    
    if (!empty($points_list)) {

        $points_html = '';
            
        foreach ($points_list as $point) {
            $point_name = $point->pto;
            $point_id = $point->pto_id;
            $type = $point->tipo;
            
            $img_path = '';


            if ($type === "TERMINAL DE OMNIBUS") {
                $img_path = "autobus.png";
            } elseif ($type === "HOTEL/POSADA") {
                $img_path = "hotel.png";
            } elseif ($type === "AEROPUERTO") {
                $img_path = "avion.png";
            } elseif ($type === "PUERTO") {
                $img_path = "embarcacion.png";  
            } else {
                $img_path = "";
            }

                    // Crear una opción para el punto
            $points_html .= '<div class="custom-option" data-value="' . $point_id . '"
                style="font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Verdana, sans-serif;">
                <img src="' . esc_url(plugins_url('icons/' . $img_path, __FILE__)) . '" style="width:25px;height:25px">
                ' . $point_name . '
                </div>';
                
            
        }
    }



    
// Obtener los valores almacenados en la configuración
$emp_id = get_option('emp_id', '3'); // Valor predeterminado '3'
$afiliado_id = get_option('afiliado_id', '308'); // Valor predeterminado '308'
$sec = get_option('sec', 'f61c48fb-ac60-475e-8dd9-4a61c386b801'); // Valor predeterminado 'f61c48fb-ac60-475e-8dd9-4a61c386b801'


$container_background_color = get_option('container_background_color', '#FAE3B1');
$form_background_color = get_option('form_background_color', '#fc0');
$button_background_color = get_option('button_background_color', '#4d4d4d');
$button_hover_background_color = get_option('button_hover_background_color', '#808080');
$button_font_color = get_option('button_font_color', '#ffffff');

$separacion_superior = get_option('separacion_superior', 0);
echo "<script> var separacionSuperior = $separacion_superior; </script>";

$enable_adhesion = get_option('enable_adhesion', '0');
echo "<script> var enableAdhesion = $enable_adhesion; </script>";


$output = '  <form action="https://syspbo.com/api/rutas/rutasdet" method="POST">
<div id="main-main" style="width:100%; margin-bottom: 100px; background-color: ' . esc_attr($container_background_color) . '">
    <div id="formulario-container" class="Pbo-main-container" style="
            max-width: 100%;
            cursor: pointer;
            margin: 0;
            display: flex;
            justify-content: center;
            background-color: ' . esc_attr($container_background_color) . ';
            z-index:10001;
            padding-top:0;
            padding-bottom:0">
                
                <div class="Pbo-inputs-container" id="inputs-container" style="
                    display: inline-flex;
                    flex-wrap: wrap;
                    align-items: center;
                    justify-content: center;
                    background-color: ' . esc_attr($form_background_color) . ';
                    padding:10px;
                    gap: 3px; 
                    width: 100%;
                    border-radius:5px">

                    <div class="Pbo-selects-container" style="
                            min-width:100px;
                            display: flex;
                            flex-grow: 1;">

                        <div class="Pbo-individual-select-container" id="Pbo-individual-select-container" style="
                                background-color: white;
                                width: 50%;
                                height: 70px;
                                border-top-left-radius: 4px;
                                border-bottom-left-radius: 4px;
                                border-right: solid 1px lightgray">

                            <div class="origin-destination" 
                            style=
                            width:100%;">

                                <p
                                    style="
                                    padding: 0 0 0 5px;
                                    height: 30px;
                                    margin: 0;
                                    font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Verdana, sans-serif;">
                                    Saliendo de:</p>
                            </div>

                            <div class="Pbo-select-custom" id="pto_origen_id-custom"
                            style="
                            height: 40px;">

                                <input class="pbo-point" id="pto_origen_id" type="hidden" name="pto_origen_id">


                                <div class="custom-selected" 
                                style="
                                height: 40px; 
                                padding: 0 0 0 5px;
                                line-height: 3;
                                overflow: hidden"></div>

                                <div class="custom-options" 
                                    style="z-index:9999; overflow:scroll; height:250px">
                                    
                                    ' . $points_html . '

                                </div>
                            </div>
                        </div>
                        <div class="Pbo-individual-select-container" id="Pbo-individual-select-container" style="
                                background-color: white;
                                width: 50%;
                                height: 70px;
                                border-top-right-radius: 5px;
                                border-bottom-right-radius: 5px;">

                            <div class="origin-destination" 
                            style="
                            width: 100%">

                                <p
                                    style="
                                padding: 0 0 0 5px;
                                height: 30px;
                                margin: 0;
                                font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Verdana, sans-serif;">
                                    Llegando a:</p>
                            </div>

                            <div class="Pbo-select-custom" id="pto_destino_id-custom"
                            style="
                            height: 40px;">

                                <input class="pbo-point" id="pto_destino_id" type="hidden" name="pto_destino_id">

                                <div class="custom-selected" 
                                style="
                                height: 40px; 
                                padding: 0 0 0 5px;
                                line-height: 3;
                                overflow: hidden"></div>

                                <div class="custom-options" 
                                style="z-index:9999; overflow:scroll; height:250px">

                                ' . $points_html . '
                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Pbo-date-passengers-container" style="
                        display: flex;
                        min-width: 210px;
                        flex-grow: 1;">

                        <div
                        style="
                            flex-grow: 1;
                            height: 70px;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            border-right: solid 1px lightgray;
                            border-top-left-radius: 4px;
                            border-bottom-left-radius: 4px;">

                            <p style="
                                flex-grow: 1;
                                margin: 0;
                                text-align: center;
                                font-family: `Lucida Sans`, `Lucida Sans Regular`, `Lucida Grande`, `Lucida Sans Unicode`, Verdana, sans-serif;">
                                Fecha</p>
                            <input class="Pbo-date" type="date" placeholder="Data" name="fecha" 
                            style="
                                flex-grow: 1;
                                border: none;
                                font-size: 16px;
                                text-align: center;
                                padding: 0 10px 0 0;
                                min-width: 150px;" />
                        </div>
                        
                        <div 
                            style="
                            flex-grow: 1;
                            height: 70px;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            padding: 0 5px 0 5px;
                            border-top-right-radius: 4px;
                            border-bottom-right-radius: 4px;">
                            <p 
                                style="
                                flex-grow: 1;
                                margin: 0;
                                text-align: center;
                                font-family: `Lucida Sans`, `Lucida Sans Regular`, `Lucida Grande`, `Lucida Sans Unicode`, Verdana, sans-serif;">
                            Pasajeros</p>
                            <input class="Pbo-passengers" type="number" placeholder="Passageiros" name="mayores" min="0"
                            max="48" value="0" style="
                                flex-grow: 1;
                                border: none;
                                text-align: center;
                                font-size: 15px;
                                padding:0;
                                min-width:55px;" />
                        </div>
                        

                    </div>                                                                                                                  
                        <input id="emp_id" type="hidden" name="emp_id" value="' . esc_attr(get_option('emp_id')) . '">
                        <input id="afiliado_id" type="hidden" name="afiliado_id" value="' . esc_attr(get_option('afiliado_id')) . '">
                        <input id="sec"  type="hidden" name="sec" value="' . esc_attr(get_option('sec')) . '">
                        <input id="menores" type="hidden" name="menores" value="0">
                        <input id="lang" type="hidden" name="lang" value="pt-BR">

                        <button id="pbo-search-button"  class="Pbo-button" type="submit" style="
                            width: 150px;
                            height: 50px;
                            border: none;
                            border-radius: 50px;
                            text-align: center;
                            font-size: medium;
                            background-color: ' . esc_attr($button_background_color) . ';
                            color: ' . esc_attr($button_font_color) . ';
                            margin: 0 5px 0 5px;
                            flex-grow:1;
                            max-width: 300px" 
                            onmouseover="this.style.backgroundColor=`' . esc_attr($button_hover_background_color) . '`"
                            onmouseout="this.style.backgroundColor=`' . esc_attr($button_background_color) . '`">
                            Buscar ⮞
                        </button> 
                    

                       
                    
                </div>

    </div>
</div></form>';
return $output;
}

add_shortcode('pesquisa', 'mostrar_formulario');

function enqueue_jquery() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

function enqueue_plugin_styles() {
    wp_enqueue_style('plugin-styles', plugins_url('styles.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');

function enqueue_my_scripts() {
    // Registrar el script
    wp_register_script('pbo-custom-script', plugins_url('pbo-custom-script.js', __FILE__), array('jquery'), '1.0', true);
    // Encolar el script
    wp_enqueue_script('pbo-custom-script');
}

add_action('wp_enqueue_scripts', 'enqueue_my_scripts');