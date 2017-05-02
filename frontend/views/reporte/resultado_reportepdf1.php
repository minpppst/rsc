<?php
use frontend\models\Reporte;
?>

<!--<b style='color:red'>bold</b>-->
            
<!--<a href='http://latcoding.com'>Latcoding.com</a>-->
<table  width="100%">
    <tr>
        <td width="100%;" align="center">
           <b> Ejecución Fisica Mensual</b>
        </td>
    </tr>
</table>
<br>
<!--aqui se recorre el arreglo de las variables-->
<table border="1" width="100%" style="border-collapse: collapse;  margin:auto;">

<?php  

    $proyecto="";
    
    //else
    //{
        

        $meses=Reporte::meses();
        //print_r($meses); exit();
        foreach ($model as $key => $value) 
        {
            for($i=0; $i<12; $i++) 
            {
            
                # code...
                if($proyecto!=$value['nombre'])
                {
                    $proyecto=$value['nombre'];
                    echo 
                    "
                        <tr>
                            <td colspan='14'>
                                ".$value['nombre']."
                            </td>
                        </tr>
                        <tr>
                            <td colspan='14'>
                                Mes: Todos
                            </td>
                        </tr>
                    ";
                    
                }
                echo 
                "
                    <tr bgcolor='#cccccc'>
                        <td rowspan='2' align='center'>
                            C&oacute;digo
                        </td>
                        <td rowspan='2' align='center'>
                            Denominaci&oacute;n
                        </td>
                        <td rowspan='2' align='center'>
                            Unidad Medida
                        </td>
                        <td rowspan='2' align='center'>
                            Estado
                        </td>
                        <td colspan='2' align='center'>
                            Meta Programada
                        </td>
                        <td colspan='2' align='center'>
                            Ejecución
                        </td>
                        <td colspan='2' align='center'>
                            Variación Mensual
                        </td>
                        <td colspan='2' align='center'>
                            Variaci&oacute;n Acumulada
                        </td>
                        <td rowspan='2' align='center'>
                            Unidad Ejecutora
                        </td>
                    </tr>
                    <tr bgcolor='#cccccc'>
                        <td align='center'>
                            ".$meses[$i]['nombre']."
                        </td>
                        <td align='center'>
                            Acumulada
                        </td>
                        <td align='center'>
                            ".$meses[$i]['nombre']."
                        </td>
                        <td align='center'>
                            Acumulada
                        </td>
                        <td align='center'>
                            Absoluta
                        </td>
                        <td align='center'>
                            Relativa (%)
                        </td>
                        <td align='center'>
                            Absoluta
                        </td>
                        <td align='center'>
                            Relativa (%)
                        </td>
                    </tr>
                    <tr>
                        <td align='center'>
                            ".$value['codigo']."
                        </td>
                        <td align='center'>
                            ".$value['nombre_variable']."
                        </td>
                        <td align='center'>
                            ".$value['unidad_medida']."
                        </td>
                        <td align='center'>
                            ".$value['estado']."
                        </td>
                        <td align='right'>
                            ".number_format($value[strtolower($meses[$i]['nombre'])],0,',','.')."
                        </td>
                        <td align='right'>
                            ".number_format($value[strtolower($meses[$i]['nombre']).'_acu'],0,',','.')."
                        </td>
                        <td align='right'>
                            ".number_format($value[strtolower($meses[$i]['nombre']).'_eje'],0,',','.')."
                        </td>
                        <td align='right'>
                            ".number_format($value[strtolower($meses[$i]['nombre']).'_acu_eje'],0,',','.')."
                        </td>
                        <td align='right'>
                            ".number_format(($value[strtolower($meses[$i]['nombre'])]-$value[strtolower($meses[$i]['nombre']).'_eje']),0,',','.')."
                        </td>
                        <td align='center'>
                            "; 
                            //se calcula el trimestral Relativa (%)
                            $trimestre=$value[strtolower($meses[$i]['nombre'])]!=0 ? number_format(($value[strtolower($meses[$i]['nombre']).'_eje']/$value[strtolower($meses[$i]['nombre'])])*100,2,',','.') : '-';
                            echo $trimestre."
                        </td>
                        <td align='right'>
                            ".number_format(($value[strtolower($meses[$i]['nombre']).'_acu']-$value[strtolower($meses[$i]['nombre']).'_acu_eje']),0,',','.')."
                        </td>
                        <td align='center'>
                            ";
                            $trimestre_acu=$value[strtolower($meses[$i]['nombre']).'_acu']!=0 ? number_format(($value[strtolower($meses[$i]['nombre']).'_acu_eje']/$value[strtolower($meses[$i]['nombre']).'_acu'])*100,2,',','.') : '-';
                            echo $trimestre_acu."
                        </td>
                        <td align='center'>
                            ".$value['unidad_ejecutora']."
                        </td>
                    </tr>";
                }
      echo "

                <tr>
                    <td colspan='12'>
                    &nbsp;
                    </td>
                </tr>

            ";

        };
    //}
?>
</table>
