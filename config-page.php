<?php
// Función para mostrar la página de configuración
function mostrar_configuracion() {
    
    include plugin_dir_path(__FILE__) . 'points-request.php';

    // Verificar si el formulario ha sido enviado y procesar los datos
    if (isset($_POST['submit'])) {
        // Recuperar y validar los datos del formulario
        $emp_id = sanitize_text_field($_POST['emp_id']);
        $afiliado_id = sanitize_text_field($_POST['afiliado_id']);
        $sec = sanitize_text_field($_POST['sec']);
        
        $enable_adhesion = isset($_POST['enable_adhesion']) ? '1' : '0';
    
        // Recuperar y validar la separación superior
        $separacion_superior = intval($_POST['separacion_superior']);

        $container_background_color = sanitize_text_field($_POST['container_background_color']);
        $form_background_color = sanitize_text_field($_POST['form_background_color']);
        $button_background_color = sanitize_text_field($_POST['button_background_color']);
        $button_hover_background_color = sanitize_text_field($_POST['button_hover_background_color']);
        $button_font_color = sanitize_text_field($_POST['button_font_color']);

        
        // Actualizar la configuración en la base de datos o en tu forma de almacenamiento
        update_option('emp_id', $emp_id);
        update_option('afiliado_id', $afiliado_id);
        update_option('sec', $sec);

        // Actualizar la separación superior
        update_option('separacion_superior', $separacion_superior);
        update_option('enable_adhesion', $enable_adhesion);

        update_option('container_background_color', $container_background_color);
        update_option('form_background_color', $form_background_color);
        update_option('button_background_color', $button_background_color);
        update_option('button_hover_background_color', $button_hover_background_color);
        update_option('button_font_color', $button_font_color);

        echo '<div class="updated"><p>configuração salva.</p></div>';
    }

    echo '<div>';
    echo '<h2>Configuración del Plugin</h2>';
    
    // Mostrar el formulario de configuración
    echo '<form style="background-color: #b8d1f2; padding: 10px; width: 95%; margin:auto; display:flex; flex-direction:column; gap:10px; align-items:center" method="post">';
    
    echo '<div style="background-color:white;display:flex; flex-direction:column; align-items:center; width:100%; border: solid 1px;">';
    echo '<p>Insira este shortcode em todas as páginas ou entradas onde deseja que o mecanismo de pesquisa seja exibido.</p>';
    echo '<p><b>[pesquisa]</b></p>';
    echo '</div>';

    //info del afiliado
    echo '<div style="background-color:white; padding:15px 0 15px; width:100%; border: solid 1px; display:flex;flex-direction:column;align-items:center">';   
    echo '<div style="display:flex">';
    echo '<strong style="display:inline-block; width:150px">ID da empresa: </strong>';
    echo '<input type="text" name="emp_id" value="' . esc_attr(get_option('emp_id')) . '">';
    echo '</div>';

    echo '<div style="display:flex">';
    echo '<strong style="display:inline-block; width:150px">ID de afiliado: </strong>';
    echo '<input type="text" name="afiliado_id" value="' . esc_attr(get_option('afiliado_id')) . '">';
    echo '</div>';
    
    echo '<div style="display:flex">';
    echo '<strong style="display:inline-block; width:150px;">Codigo de segurança: </strong>';
    echo '<input type="text" name="sec" value="' . esc_attr(get_option('sec')) . '">';
    echo '</div>';
    echo '</div>';

    //puntos
    include plugin_dir_path(__FILE__) . 'points.php';
    
    echo '<div style="width:100%; display:flex; flex-direction:column; background-color:white; gap:15px; border:solid 1px; padding: 15px; box-sizing:border-box">';
    // habilitar/deshabilitar adherencia
    echo '<div style="display:flex; flex-direction:column; align-items:center">';
    echo '<strong style="display:inline-block; width:150px">Colar a pesquisa acima: </strong>';
    echo '<p>use a caixa de seleção para definir o mecanismo de pesquisa no topo da tela quando o usuário rolar para baixo</p>';

    echo '<input type="checkbox" name="enable_adhesion" value="' . esc_attr(get_option('enable_adhesion')) . '" ' . checked(get_option('enable_adhesion'), '1', false) . '>';

    echo '</div>';
    // separar de arriba
    echo '<div style="display:flex; flex-direction:column; align-items:center">';
    echo '<strong style="display:inline-block">Separação do topo (em pixels): </strong>';
    echo '<p>Caso seu site WordPress já possua um elemento fixado no topo da tela. Separe o mecanismo de pesquisa da parte superior da tela para que não se sobreponha ao outro elemento.</p>';
    echo '<input style="text-align:center; width: 100px" type="number" name="separacion_superior" value="' . esc_attr(get_option('separacion_superior', 0)) . '">';
    echo '</div>';
    echo '</div>';

    //colores
    echo '<div style="width:100%; display:flex; flex-direction:column; align-items:center; background-color:white; gap:15px; border:solid 1px; padding: 15px; box-sizing:border-box">';
    echo '<img style="width:80%" src="' . plugins_url("PBO-search/pesquisa.png") . '" alt="Pesquisa">';

    echo '<p>Você pode definir cores em código hexadecimal (por exemplo: #F31D1D), RGB (por exemplo: rgb(243, 29, 29)) ou simplesmente escrevendo o nome da cor em inglês (por exemplo: red)</p>';

    echo '<div style="display:flex">';
    echo '<strong style="width: 250px;margin-rigth:10px">Cor do container externo:  </strong>';
    echo '<input style="text-align:center; width: 100px" type="text" name="container_background_color" value="' . esc_attr(get_option('container_background_color')) . '">';
    echo '</div>';

    echo '<div style="display:flex">';
    echo '<strong style="width: 250px;margin-rigth:10px">Cor do container interno:  </strong>';
    echo '<input style="text-align:center; width: 100px" type="text" name="form_background_color" value="' . esc_attr(get_option('form_background_color')) . '">';
    echo '</div>';

    echo '<div style="display:flex">';
    echo '<strong style="width: 250px;margin-rigth:10px">Cor do botão:  </strong>';
    echo '<input style="text-align:center; width: 100px" type="text" name="button_background_color" value="' . esc_attr(get_option('button_background_color')) . '">';
    echo '</div>';

    echo '<div style="display:flex">';
    echo '<strong style="width: 250px;margin-rigth:10px">cor do botão ao passar o mouse sobre:  </strong>';
    echo '<input style="text-align:center; width: 100px" type="text" name="button_hover_background_color" value="' . esc_attr(get_option('button_hover_background_color')) . '">';
    echo '</div>';

    echo '<div style="display:flex">';
    echo '<strong style="width: 250px;margin-rigth:10px">cor da letra do botão: </strong>';
    echo '<input style="text-align:center; width: 100px" type="text" name="button_font_color" value="' . esc_attr(get_option('button_font_color')) . '">';
    echo '</div>';
    echo '</div>';

    echo '<div style="width:100%; border: solid 1px; background-color:white; display:flex; justify-content:center; padding: 15px; box-sizing:border-box">';
    echo '<input id="save-config"style="margin: 0 100px 0 100px; padding: 10px; background-color:#3D8AF9; color:white; border-radius: 5px" type="submit" name="submit" value="Salvar Configuraçao">';
    echo '</div>';

    echo '</form>';
    
    echo '</div>';
}

