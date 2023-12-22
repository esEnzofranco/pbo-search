<?php
$points_list = get_option('points_list');

echo '<div style="padding: 15px 0 15px; gap: 15px; background-color:white; border:solid 1px; display:flex; flex-direction:column; align-items:center; width:100%">';

if (!empty($points_list)) {

    echo '<div style="display:flex; flex-direction:column; align-items:center">
            <strong style="margin-bottom:10px">Pontos disponíveis para a empresa que você escolheu</strong>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Ponto</th>
                            <th>Tipo</th>
                        </tr>
                    </thead> 
                    <tbody>';


                            foreach ($points_list as $point) {
                                $point_name = $point->pto;
                                $type = $point->tipo;

                          echo '<tr>
                                    <td>' . $point_name . '</td>
                                <td>';
    
                                    if ($type === "TERMINAL DE OMNIBUS") {
                                        echo "Rodoviaria";
                                    } elseif ($type === "HOTEL/POSADA") {
                                        echo "Hotel / Pousada";
                                    } elseif ($type === "AEROPUERTO") {
                                        echo "Aeroporto";
                                    } else {
                                        echo "?";
                                    }

                          echo '</td>
                                </tr>';

                        }

              echo '</tbody>
                </table>
          </div>';

} else {
    echo '<div>
            <div style="border:double 4px red; padding: 15px">
                <p style="text-align:center">Não foi possível carregar as informações relacionadas à empresa.</p>
                <p>Certifique-se de que o ID da empresa, o ID do afiliado e o código de segurança estejam corretos</p>
            </div>
          </div>';
}

wp_enqueue_script('update-points-script', plugins_url('update-points.js', __FILE__), array('jquery'), '1.0', true);

echo '<div style="padding:15px"><strong>Importante:</strong> Na primeira vez que você inserir os dados, deverá pressionar o botão “atualizar pontos” para visualizar os pontos. Depois disso, eles serão mantidos atualizados automaticamente.</div>';

echo '<div style="display:flex; padding:15px; gap:20px; border-radius:5px; align-items: center">
        <button id="ejecutarFuncion" style="height: 40px; background-color:#49796B; border-radius:50px; color:white; border:none" onmouseover="this.style.backgroundColor = `#2f6656`"
        onmouseout="this.style.backgroundColor=`#49796B`">Atualizar pontos</button>
      </div>';

echo '</div>';

?>
