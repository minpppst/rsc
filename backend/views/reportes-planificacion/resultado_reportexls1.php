<?php
use backend\models\ReportePlanificacion;
?>
<table  width="800px">
    
    <tr>
        <td width="800px;" align="center" colspan="12">
           <b> 'Ejecuci&oacute;n Fisica Mensual </b>
        </td>

    </tr>
</table>
<br>
<!--aqui se recorre el arreglo de las variables-->
<table border="1" width="800px" style="border-collapse: collapse;">

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
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        ".$meses['id']."
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        ".$meses['id']."
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value[$mes]."
                    </td>
                    <td>
                        ".$value[$mes.'_acu']."
                    </td>
                    <td>
                        ".$value[$mes.'_eje']."
                    </td>
                    <td>
                        ".$value[$mes.'_acu_eje']."
                    </td>
                    <td>
                        ".($value[$mes]-$value[$mes.'_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value[$mes]!=0 ? ($value[$mes.'_eje']/$value[$mes])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value[$mes.'_acu']-$value[$mes.'_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value[$mes.'_acu']!=0 ? ($value[$mes.'_acu_eje']/$value[$mes.'_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".($value['unidad_ejecutora'])."
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
        $i=1;
        $meses=ReportePlanificacion::meses();
        foreach ($model as $key => $value) 
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
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Enero
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Enero
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['enero']."
                    </td>
                    <td>
                        ".$value['enero_acu']."
                    </td>
                    <td>
                        ".$value['enero_eje']."
                    </td>
                    <td>
                        ".$value['enero_acu_eje']."
                    </td>
                    <td>
                        ".($value['enero']-$value['enero_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['enero']!=0 ? ($value['enero_eje']/$value['enero'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['enero_acu']-$value['enero_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['enero_acu']!=0 ? ($value['enero_acu_eje']/$value['enero_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>

                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Febrero
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Febrero
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['febrero']."
                    </td>
                    <td>
                        ".$value['febrero_acu']."
                    </td>
                    <td>
                        ".$value['febrero_eje']."
                    </td>
                    <td>
                        ".$value['febrero_acu_eje']."
                    </td>
                    <td>
                        ".($value['febrero']-$value['febrero_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['febrero']!=0 ? ($value['febrero_eje']/$value['febrero'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['febrero_acu']-$value['febrero_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['febrero_acu']!=0 ? ($value['febrero_acu_eje']/$value['febrero_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Marzo
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Marzo
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['marzo']."
                    </td>
                    <td>
                        ".$value['marzo_acu']."
                    </td>
                    <td>
                        ".$value['marzo_eje']."
                    </td>
                    <td>
                        ".$value['marzo_acu_eje']."
                    </td>
                    <td>
                        ".($value['marzo']-$value['marzo_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['marzo']!=0 ? ($value['marzo_eje']/$value['marzo'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['marzo_acu']-$value['marzo_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['marzo_acu']!=0 ? ($value['marzo_acu_eje']/$value['marzo_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Abril
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Abril
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['abril']."
                    </td>
                    <td>
                        ".$value['abril_acu']."
                    </td>
                    <td>
                        ".$value['abril_eje']."
                    </td>
                    <td>
                        ".$value['abril_acu_eje']."
                    </td>
                    <td>
                        ".($value['abril']-$value['abril_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['abril']!=0 ? ($value['abril_eje']/$value['abril'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['abril_acu']-$value['abril_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['abril_acu']!=0 ? ($value['abril_acu_eje']/$value['abril_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        mayo
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        mayo
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['mayo']."
                    </td>
                    <td>
                        ".$value['mayo_acu']."
                    </td>
                    <td>
                        ".$value['mayo_eje']."
                    </td>
                    <td>
                        ".$value['mayo_acu_eje']."
                    </td>
                    <td>
                        ".($value['mayo']-$value['mayo_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['mayo']!=0 ? ($value['mayo_eje']/$value['mayo'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['mayo_acu']-$value['mayo_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['mayo_acu']!=0 ? ($value['mayo_acu_eje']/$value['mayo_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Junio
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Junio
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['junio']."
                    </td>
                    <td>
                        ".$value['junio_acu']."
                    </td>
                    <td>
                        ".$value['junio_eje']."
                    </td>
                    <td>
                        ".$value['junio_acu_eje']."
                    </td>
                    <td>
                        ".($value['junio']-$value['junio_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['junio']!=0 ? ($value['junio_eje']/$value['junio'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['junio_acu']-$value['junio_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['junio_acu']!=0 ? ($value['junio_acu_eje']/$value['junio_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Julio
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Julio
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['julio']."
                    </td>
                    <td>
                        ".$value['julio_acu']."
                    </td>
                    <td>
                        ".$value['julio_eje']."
                    </td>
                    <td>
                        ".$value['julio_acu_eje']."
                    </td>
                    <td>
                        ".($value['julio']-$value['julio_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['julio']!=0 ? ($value['julio_eje']/$value['julio'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['julio_acu']-$value['julio_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['julio_acu']!=0 ? ($value['julio_acu_eje']/$value['julio_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Agosto
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Agosto
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['agosto']."
                    </td>
                    <td>
                        ".$value['agosto_acu']."
                    </td>
                    <td>
                        ".$value['agosto_eje']."
                    </td>
                    <td>
                        ".$value['agosto_acu_eje']."
                    </td>
                    <td>
                        ".($value['agosto']-$value['agosto_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['agosto']!=0 ? ($value['agosto_eje']/$value['agosto'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['agosto_acu']-$value['agosto_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['agosto_acu']!=0 ? ($value['agosto_acu_eje']/$value['agosto_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        septiembre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        septiembre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['septiembre']."
                    </td>
                    <td>
                        ".$value['septiembre_acu']."
                    </td>
                    <td>
                        ".$value['septiembre_eje']."
                    </td>
                    <td>
                        ".$value['septiembre_acu_eje']."
                    </td>
                    <td>
                        ".($value['septiembre']-$value['septiembre_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['septiembre']!=0 ? ($value['septiembre_eje']/$value['septiembre'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['septiembre_acu']-$value['septiembre_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['septiembre_acu']!=0 ? ($value['septiembre_acu_eje']/$value['septiembre_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Octubre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Octubre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['octubre']."
                    </td>
                    <td>
                        ".$value['octubre_acu']."
                    </td>
                    <td>
                        ".$value['octubre_eje']."
                    </td>
                    <td>
                        ".$value['octubre_acu_eje']."
                    </td>
                    <td>
                        ".($value['octubre']-$value['octubre_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['octubre']!=0 ? ($value['octubre_eje']/$value['octubre'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['octubre_acu']-$value['octubre_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['octubre_acu']!=0 ? ($value['octubre_acu_eje']/$value['octubre_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Noviembre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Noviembre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['noviembre']."
                    </td>
                    <td>
                        ".$value['noviembre_acu']."
                    </td>
                    <td>
                        ".$value['noviembre_eje']."
                    </td>
                    <td>
                        ".$value['noviembre_acu_eje']."
                    </td>
                    <td>
                        ".($value['noviembre']-$value['noviembre_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['noviembre']!=0 ? ($value['noviembre_eje']/$value['noviembre'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['noviembre_acu']-$value['noviembre_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['noviembre_acu']!=0 ? ($value['noviembre_acu_eje']/$value['noviembre_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


                <tr bgcolor='#cccccc'>
                    <td rowspan='2'>
                        C&oacute;digo
                    </td>
                    <td rowspan='2'>
                        Denominaci&oacute;n
                    </td>
                    <td rowspan='2'>
                        Unidad Medida
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Programadas
                    </td>
                    <td colspan='2'>
                        Metas del Proyecto Ejecutodas
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Trimestre
                    </td>
                    <td colspan='2'>
                        Variaci&oacute;n Acumulada
                    </td>
                    <td rowspan='2'>
                        Unidad Ejecutora
                    </td>
                </tr>
                <tr bgcolor='#cccccc'>
                    <td>
                        Diciembre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Diciembre
                    </td>
                    <td>
                        Acumulada
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                    <td>
                        Absoluta
                    </td>
                    <td>
                        Relativa
                    </td>
                </tr>
                <tr>
                    <td>
                        ".$value['codigo']."
                    </td>
                    <td>
                        ".$value['nombre_variable']."
                    </td>
                    <td>
                        ".$value['unidad_medida']."
                    </td>
                    <td>
                        ".$value['diciembre']."
                    </td>
                    <td>
                        ".$value['diciembre_acu']."
                    </td>
                    <td>
                        ".$value['diciembre_eje']."
                    </td>
                    <td>
                        ".$value['diciembre_acu_eje']."
                    </td>
                    <td>
                        ".($value['diciembre']-$value['diciembre_eje'])."
                    </td>
                    <td>
                        "; 
                        //se calcula el trimestral relativa
                        $trimestre=$value['diciembre']!=0 ? ($value['diciembre_eje']/$value['diciembre'])*100 : '0';
                        echo $trimestre."
                    </td>
                    <td>
                        ".($value['diciembre_acu']-$value['diciembre_acu_eje'])."
                    </td>
                    <td>
                        ";
                        $trimestre_acu=$value['diciembre_acu']!=0 ? ($value['diciembre_acu_eje']/$value['diciembre_acu'])*100 : '0';
                        echo $trimestre_acu."
                    </td>
                    <td>
                        ".$value['unidad_ejecutora']."
                    </td>
                </tr>


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
