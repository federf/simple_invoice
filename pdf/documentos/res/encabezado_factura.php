<?php
	if ($con) {
?>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../<?php echo get_row('perfil','logo_url', 'id_perfil', 1);?>" alt="Logo"><br>
            </td>
            <td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <!-- <span>
                    Factura
                </span>
                <br> -->
                <span style="color: #34495e;font-size:30px;font-weight:bold">
                    X
                </span>
                <br>
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo get_row('perfil','nombre_empresa', 'id_perfil', 1);?></span>
                <br>
                <?php echo get_row('perfil','direccion', 'id_perfil', 1).", ". get_row('perfil','ciudad', 'id_perfil', 1)." ".get_row('perfil','estado', 'id_perfil', 1);?>
                <br>
                Teléfono: <?php echo get_row('perfil','telefono', 'id_perfil', 1);?>
            </td>

        </tr>
    </table>
	<?php }?>