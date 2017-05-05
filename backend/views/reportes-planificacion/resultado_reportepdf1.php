<?php
use backend\models\ReportePlanificacion;
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
    $salto=0;
    if($meses['id']!='x999')
    {
        $meses['id']=ReportePlanificacion::Nombremes($meses['id']);
        $mes=strtolower($meses['id']);
        //foreach ($model as $key => $value)
        while (($value = current($model)) !== false)
        {
            # code...
            //print_r($value); exit();
            if($proyecto!=$value['nombre'])
            {
                $proyecto=$value['nombre'];
                echo
                "
                    <tr>
                        <td colspan='12'>
                            ".$value['nombre']."
                        </td>
                    </tr>
                    <tr>
                        <td colspan='12'>
                            Mes: ".$meses['id']."
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
                        ".$meses['id']."
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        ".$meses['id']."
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
                    <td align='right'>
                        ".number_format($value[$mes],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value[$mes.'_acu'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value[$mes.'_eje'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value[$mes.'_acu_eje'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format(($value[$mes]-$value[$mes.'_eje']),0,',','.')."
                    </td >
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value[$mes]!=0 ? number_format(($value[$mes.'_eje']/$value[$mes])*100,2,',','.') : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".number_format(($value[$mes.'_acu']-$value[$mes.'_acu_eje']),0,',','.')."
                    </td>
                    <td align='center'>
                        ";
                        $trimestre_acu=$value[$mes.'_acu']!=0 ? number_format(($value[$mes.'_acu_eje']/$value[$mes.'_acu'])*100,2,',','.') : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>
                ";
                $nombreactual=$value['nombre_variable'];
                $value=next($model);

                if($salto>0 && (strlen($nombreactual)>140) && (isset($value['nombre_variable'])))
                {
                    echo 
                    "</table>
                    <br>
                    <table style='page-break-after:always;'>
                    </br>
                    </table>
                    <br>
                    <table border='1' width='100%' style='border-collapse: collapse;  margin:auto; font-size: 12px;'>
                    ";
                    $salto=0;
                }
                elseif($salto>1 && (isset($value['nombre_variable'])))
                {
                    echo 
                    "</table>
                    <br>
                    <table style='page-break-after:always;'>
                    </br>
                    </table>
                    <br>
                    <table border='1' width='100%' style='border-collapse: collapse;  margin:auto; font-size: 12px;'>
                    ";
                    $salto=0;
                    

                }else
                {
                    $salto++;
                }

                echo "
                <tr>
                    <td colspan='12'>
                    &nbsp;
                    </td>
                </tr>

            ";

        };//fin del for
    }
    else
    {
        $meses=ReportePlanificacion::meses();
        
        echo "<tbody>";
        //foreach ($model as $key => $value) 

        while (($value = current($model)) !== false)
        {
            for($i=0; $i<12; $i++) 
            {
                if($proyecto!=$value['nombre'])
                {
                    $proyecto=$value['nombre'];
                    echo 
                    "
                        <tr>
                            <td colspan='12'>
                                ".$value['nombre']."
                            </td>
                        </tr>
                        <tr>
                            <td colspan='12'>
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
                    <tr >
                        <td align='center'>
                            ".$value['codigo']."
                        </td>
                        <td align='center'>
                            ".$value['nombre_variable']."
                        </td>
                        <td align='center'>
                            ".$value['unidad_medida']."
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
                        <td align='center' >
                            ".$value['unidad_ejecutora']."
                        </td>
                    </tr>
                ";
                    $nombreactual=$value['nombre_variable'];
                    $value=next($model);

                    if($salto>0 && (strlen($nombreactual)>140) && (isset($value['nombre_variable'])))
                    {
                        echo 
                        "</table>
                        <br>
                        <table style='page-break-after:always;'>
                        </br>
                        </table>
                        <br>
                        <table border='1' width='100%' style='border-collapse: collapse;  margin:auto; font-size: 12px;'>
                        ";
                        $salto=0;
                    }
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
                        ";
                        $salto=0;
                        

                    }else
                    {
                        $salto++;
                    }
                    
                    if(isset($value['nombre_variable']))
                    {
                        $value=prev($model);    
                    }
                    else
                    {
                        $value=end($model);
                    }
                    

            }//primer for
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
        echo "</tbody>
            </table>
        ";
    }
?>
</table>
