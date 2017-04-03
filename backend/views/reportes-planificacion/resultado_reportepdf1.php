<?php
use backend\models\ReportePlanificacion;
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
    if($meses['id']!='x999')
    {
        $meses['id']=ReportePlanificacion::Nombremes($meses['id']);
        $mes=strtolower($meses['id']);
        foreach ($model as $key => $value) 
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
                    <td rowspan='2' align='center'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2' align='center'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2' align='center'>
                        Unidad Medida
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
                        <td rowspan='2' align='center'>
                            C&oacute;digo
                        </td>
                        <td rowspan='2' align='center'>
                            Denominaci&oacute;n
                        </td>
                        <td rowspan='2' align='center'>
                            Unidad Medida
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
                
                /*
                
                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2' align='center'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2' align='center'>
                        Unidad Medida
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
                        Febrero
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Febrero
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
                        ".number_format($value['febrero'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value['febrero_acu'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value['febrero_eje'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value['febrero_acu_eje'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format(($value['febrero']-$value['febrero_eje']),0,',','.')."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['febrero']!=0 ? number_format(($value['febrero_eje']/$value['febrero'])*100,2,',','.') : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".number_format(($value['febrero_acu']-$value['febrero_acu_eje']),0,',','.')."
                    </td>
                    <td align='center'>
                        ";
                        $trimestre_acu=$value['febrero_acu']!=0 ? number_format(($value['febrero_acu_eje']/$value['febrero_acu'])*100,2,',','.') : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Marzo
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Marzo
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
                        ".$value['marzo']."
                    </td>
                    <td align='right'>
                        ".$value['marzo_acu']."
                    </td>
                    <td align='right'>
                        ".$value['marzo_eje']."
                    </td>
                    <td align='right'>
                        ".$value['marzo_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['marzo']-$value['marzo_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['marzo']!=0 ? ($value['marzo_eje']/$value['marzo'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['marzo_acu']-$value['marzo_acu_eje'])."
                    </td>
                    <td align='center'>
                        ";
                        $trimestre_acu=$value['marzo_acu']!=0 ? ($value['marzo_acu_eje']/$value['marzo_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Abril
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Abril
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
                        ".$value['abril']."
                    </td>
                    <td align='right'>
                        ".$value['abril_acu']."
                    </td>
                    <td align='right'>
                        ".$value['abril_eje']."
                    </td>
                    <td align='right'>
                        ".$value['abril_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['abril']-$value['abril_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['abril']!=0 ? ($value['abril_eje']/$value['abril'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['abril_acu']-$value['abril_acu_eje'])."
                    </td>
                    <td align='center'>
                        ";
                        $trimestre_acu=$value['abril_acu']!=0 ? ($value['abril_acu_eje']/$value['abril_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        mayo
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        mayo
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
                        ".$value['mayo']."
                    </td>
                    <td align='right'>
                        ".$value['mayo_acu']."
                    </td>
                    <td align='right'>
                        ".$value['mayo_eje']."
                    </td>
                    <td align='right'>
                        ".$value['mayo_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['mayo']-$value['mayo_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['mayo']!=0 ? ($value['mayo_eje']/$value['mayo'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['mayo_acu']-$value['mayo_acu_eje'])."
                    </td>
                    <td align='center'>
                        ";
                        $trimestre_acu=$value['mayo_acu']!=0 ? ($value['mayo_acu_eje']/$value['mayo_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Junio
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Junio
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
                        ".$value['junio']."
                    </td>
                    <td align='right'>
                        ".$value['junio_acu']."
                    </td>
                    <td align='right'>
                        ".$value['junio_eje']."
                    </td>
                    <td align='right'>
                        ".$value['junio_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['junio']-$value['junio_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['junio']!=0 ? ($value['junio_eje']/$value['junio'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['junio_acu']-$value['junio_acu_eje'])."
                    </td>
                    <td align='center'>
                        ";
                        $trimestre_acu=$value['junio_acu']!=0 ? ($value['junio_acu_eje']/$value['junio_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Julio
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Julio
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
                    <td>
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
                        ".$value['julio']."
                    </td>
                    <td align='right'>
                        ".$value['julio_acu']."
                    </td>
                    <td align='right'>
                        ".$value['julio_eje']."
                    </td>
                    <td align='right'>
                        ".$value['julio_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['julio']-$value['julio_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['julio']!=0 ? ($value['julio_eje']/$value['julio'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['julio_acu']-$value['julio_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['julio_acu']!=0 ? ($value['julio_acu_eje']/$value['julio_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Agosto
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Agosto
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
                        ".$value['agosto']."
                    </td>
                    <td align='right'>
                        ".$value['agosto_acu']."
                    </td>
                    <td align='right'>
                        ".$value['agosto_eje']."
                    </td>
                    <td align='right'>
                        ".$value['agosto_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['agosto']-$value['agosto_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['agosto']!=0 ? ($value['agosto_eje']/$value['agosto'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['agosto_acu']-$value['agosto_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['agosto_acu']!=0 ? ($value['agosto_acu_eje']/$value['agosto_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Septiembre
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Septiembre
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
                        ".$value['septiembre']."
                    </td>
                    <td align='right'>
                        ".$value['septiembre_acu']."
                    </td>
                    <td align='right'>
                        ".$value['septiembre_eje']."
                    </td>
                    <td align='right'>
                        ".$value['septiembre_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['septiembre']-$value['septiembre_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['septiembre']!=0 ? ($value['septiembre_eje']/$value['septiembre'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['septiembre_acu']-$value['septiembre_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['septiembre_acu']!=0 ? ($value['septiembre_acu_eje']/$value['septiembre_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Octubre
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Octubre
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
                        ".number_format($value['octubre'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value['octubre_acu'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value['octubre_eje'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format($value['octubre_acu_eje'],0,',','.')."
                    </td>
                    <td align='right'>
                        ".number_format(($value['octubre']-$value['octubre_eje']),0,',','.')."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['octubre']!=0 ? number_format(($value['octubre_eje']/$value['octubre'])*100,2,',','.') : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".number_format(($value['octubre_acu']-$value['octubre_acu_eje']),2,',','.')."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['octubre_acu']!=0 ? number_format(($value['octubre_acu_eje']/$value['octubre_acu'])*100,2,',','.') : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Noviembre
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Noviembre
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
                        ".$value['noviembre']."
                    </td>
                    <td align='right'>
                        ".$value['noviembre_acu']."
                    </td>
                    <td align='right'>
                        ".$value['noviembre_eje']."
                    </td>
                    <td align='right'>
                        ".$value['noviembre_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['noviembre']-$value['noviembre_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['noviembre']!=0 ? ($value['noviembre_eje']/$value['noviembre'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['noviembre_acu']-$value['noviembre_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['noviembre_acu']!=0 ? ($value['noviembre_acu_eje']/$value['noviembre_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
                        Diciembre
                    </td>
                    <td align='center'>
                        Acumulada
                    </td>
                    <td align='center'>
                        Diciembre
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
                        ".$value['diciembre']."
                    </td>
                    <td align='right'>
                        ".$value['diciembre_acu']."
                    </td>
                    <td align='right'>
                        ".$value['diciembre_eje']."
                    </td>
                    <td align='right'>
                        ".$value['diciembre_acu_eje']."
                    </td>
                    <td align='right'>
                        ".($value['diciembre']-$value['diciembre_eje'])."
                    </td>
                    <td align='center'>
                        "; 
                        //se calcula el trimestral Relativa (%)
                        $trimestre=$value['diciembre']!=0 ? ($value['diciembre_eje']/$value['diciembre'])*100 : '-';
                        echo $trimestre."
                    </td>
                    <td align='right'>
                        ".($value['diciembre_acu']-$value['diciembre_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['diciembre_acu']!=0 ? ($value['diciembre_acu_eje']/$value['diciembre_acu'])*100 : '-';
                        echo $trimestre_acu."
                    </td>
                    <td align='center'>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>
*/ echo "

                <tr>
                    <td colspan='12'>
                    &nbsp;
                    </td>
                </tr>

            ";

        };
    }
?>
</table>
