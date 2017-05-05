<?php
use frontend\models\Reporte;
?>
<table  width="100%">
    <tr>
        <td width="100%;" align="center">
           <b> Ejecución Fisica Mensual</b>
        </td>
    </tr>
</table>
<br>
<!--aqui se recorre el arreglo de las variables-->
<table border="1" width="100%" style="border-collapse: collapse;  margin:auto; font-size: 12px;">
<?php  
    $proyecto="";
    echo "<tbody>";
    $salto=0;
    $meses=Reporte::meses();
    //print_r($meses); exit();
    while (($value = current($model)) !== false)
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
                    <td rowspan='2' align='center' width='5%'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2' align='center' width='12%'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2' align='center' width='10%'>
                        Unidad Medida
                    </td>
                    <td rowspan='2' align='center' width='6%'>
                        Estado
                    </td>
                    <td colspan='2' align='center' width='17%'>
                        Meta Programada
                    </td>
                    <td colspan='2' align='center' width='18%'>
                        Ejecución
                    </td>
                    <td colspan='2' align='center' width='17%'>
                        Variación Mensual
                    </td>
                    <td colspan='2' align='center' width='17%'> 
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2' align='center' width='12%'>
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

                //se guarda el nombre actual de la variable porque se avanzará el indice del arreglo
                $nombreactual=$value['nombre_variable'];
                $value=next($model);
                //verifico si es el string es muy grande de ser asi realizo el salto de linea en el segundo registro
                if($salto==1 && (strlen($nombreactual)>130) && (isset($value['nombre_variable']) || $i!=11))
                {
                    echo 
                    "</table>
                    <br>
                    <table style='page-break-after:always;'>
                    </br>
                    </table>
                    <br>
                    <table border='1' width='100%' style='border-collapse: collapse;  margin:auto; font-size: 12px;'>
                    <tbody>
                    ";
                    $salto=0;
                } //si llevo 3 registros lo mejor es realizar el salto de linea.
                elseif($salto>1 && (isset($value['nombre_variable']) || $i!=11))
                {
                    echo 
                    "</table>
                    <br>
                    <table style='page-break-after:always;'>
                    </br>
                    </table>
                    <br>
                    <table border='1' width='100%' style='border-collapse: collapse;  margin:auto; font-size: 12px;'>
                    <tbody>
                    ";
                    $salto=0;

                }else
                {
                    $salto++;
                }
                //retorno el indice del arreglo
                if(isset($value['nombre_variable']))
                {
                    $value=prev($model);    
                }
                else
                {
                    $value=end($model);
                }

            }//fin del primer for

        $value = next($model);
        if(isset($value['nombre_variable']))
        {
            echo "
            <tr>
                <td colspan='12'>
                    &nbsp;
                </td>
            </tr>
                ";
        }
    };//ultimo for
    echo "  </tbody>
        </table>
    ";

?>
</table>
