<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\date\DatePicker;

$columns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'codigo',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
        'contentOptions' => 
                [
                    'style'=>'max-width: 350px;  word-wrap: break-word;
                    white-space: normal;'
                ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre_variable',
        'contentOptions' => 
                [
                    'style'=>'max-width: 350px;  word-wrap: break-word;
                    white-space: normal;'
                ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'unidad_medida',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Enero',
        'attribute'=>'enero',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return $model['enero']!=null ? $model['enero'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Enero',
        'attribute'=>'enero',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return $model['enero']!=null ? $model['enero'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Enero',
        'attribute'=>'enero_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return $model['enero_eje']!=null ? $model['enero_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Enero',
        'attribute'=>'enero_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return $model['enero_eje']!=null ? $model['enero_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Enero',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return ($model['enero']-$model['enero_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Enero Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return ($model['enero']!=0) ? number_format(($model['enero_eje']/$model['enero'])*100,2,',','.') : '0';
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Enero',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return ($model['enero']-$model['enero_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Enero Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==1 ? true : false,
        'value' => function($model)
                    {
                        return ($model['enero']!=0) ? number_format(($model['enero_eje']/$model['enero'])*100,2,',','.') : '0';
                    }
    ],

    
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Febrero',
        'attribute'=>'febrero',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return $model['febrero']!=null ? $model['febrero'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Febrero',
        'attribute'=>'febrero_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return $model['febrero_acu']!=null ? $model['febrero_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Febrero',
        'attribute'=>'febrero_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return $model['febrero_eje']!=null ? $model['febrero_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Febrero',
        'attribute'=>'febrero_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return $model['febrero_acu_eje']!=null ? $model['febrero_acu_eje'] : 0;
                    }
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Febrero',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return ($model['febrero']-$model['febrero_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Febrero Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return ($model['febrero']!=0) ? number_format(($model['febrero_eje']/$model['febrero'])*100,2,',','.') : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Febrero',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return ($model['febrero_acu']-$model['febrero_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Febrero Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==2 ? true : false,
        'value' => function($model)
                    {
                        return ($model['febrero_acu']!=0) ? number_format(($model['febrero_acu_eje']/$model['febrero_acu'])*100,2,',','.') : '0';
                    }
    ],



    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Marzo',
        'attribute'=>'marzo',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return $model['marzo']!=null ? $model['marzo'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Marzo',
        'attribute'=>'marzo_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return $model['marzo_acu']!=null ? $model['marzo_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Marzo',
        'attribute'=>'marzo_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return $model['marzo_eje']!=null ? $model['marzo_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Marzo',
        'attribute'=>'marzo_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return $model['marzo_acu_eje']!=null ? $model['marzo_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Marzo',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return ($model['marzo']-$model['marzo_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Marzo Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return ($model['marzo']!=0) ? ($model['marzo_eje']/$model['marzo'])*100 : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Marzo',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return ($model['marzo_acu']-$model['marzo_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Marzo Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==3 ? true : false,
        'value' => function($model)
                    {
                        return ($model['marzo_acu']!=0) ? number_format(($model['marzo_acu_eje']/$model['marzo_acu'])*100,2,',','.') : '0';
                    }
    ],


    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Abril',
        'attribute'=>'abril',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return $model['abril']!=null ? $model['abril'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Abril',
        'attribute'=>'abril_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return $model['abril_acu']!=null ? $model['abril_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Abril',
        'attribute'=>'abril_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return $model['abril_eje']!=null ? $model['abril_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado abril',
        'attribute'=>'abril_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return $model['abril_acu_eje']!=null ? $model['abril_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Abril',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return ($model['abril']-$model['abril_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Abril Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return ($model['abril']!=0) ? ($model['abril_eje']/$model['abril'])*100 : '0';
                    }
    ],


    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Abril',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return ($model['abril_acu']-$model['abril_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Abril Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==4 ? true : false,
        'value' => function($model)
                    {
                        return ($model['abril_acu']!=0) ? number_format(($model['abril_acu_eje']/$model['abril_acu'])*100,2,',','.') : '0';
                    }
    ],

    
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Mayo',
        'attribute'=>'mayo',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return $model['mayo']!=null ? $model['mayo'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Mayo',
        'attribute'=>'mayo_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return $model['mayo_acu']!=null ? $model['mayo_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Mayo',
        'attribute'=>'mayo_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return $model['mayo_eje']!=null ? $model['mayo_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Mayo',
        'attribute'=>'mayo_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return $model['mayo_acu_eje']!=null ? $model['mayo_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Mayo',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return ($model['mayo']-$model['mayo_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Mayo Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return ($model['mayo']!=0) ? ($model['mayo_eje']/$model['mayo'])*100 : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Mayo',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return ($model['mayo_acu']-$model['mayo_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Mayo Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==5 ? true : false,
        'value' => function($model)
                    {
                        return ($model['mayo_acu']!=0) ? number_format(($model['mayo_acu_eje']/$model['mayo_acu'])*100,2,',','.') : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Junio',
        'attribute'=>'junio',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return $model['junio']!=null ? $model['junio'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Junio',
        'attribute'=>'junio_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return $model['junio']!=null ? $model['junio_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Junio',
        'attribute'=>'junio_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return $model['junio_eje']!=null ? $model['junio_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Junio',
        'attribute'=>'junio_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return $model['junio_acu_eje']!=null ? $model['junio_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Junio',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return ($model['junio']-$model['junio_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Junio Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return ($model['junio']!=0) ? ($model['junio_eje']/$model['junio'])*100 : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Junio',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return ($model['junio_acu']-$model['junio_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Junio Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==6 ? true : false,
        'value' => function($model)
                    {
                        return ($model['junio_acu']!=0) ? number_format(($model['junio_acu_eje']/$model['junio_acu'])*100,2,',','.') : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Julio',
        'attribute'=>'julio',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return $model['julio']!=null ? $model['julio'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Julio',
        'attribute'=>'julio_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return $model['julio_acu']!=null ? $model['julio_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Julio',
        'attribute'=>'julio_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return $model['julio_eje']!=null ? $model['julio_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Julio',
        'attribute'=>'julio_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return $model['julio_acu_eje']!=null ? $model['julio_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Julio',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return ($model['julio']-$model['julio_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Julio Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return ($model['julio']!=0) ? ($model['julio_eje']/$model['julio'])*100 : '0';
                    }
    ],


    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Julio',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return ($model['julio_acu']-$model['julio_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Julio Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==7 ? true : false,
        'value' => function($model)
                    {
                        return ($model['julio_acu']!=0) ? number_format(($model['julio_acu_eje']/$model['julio_acu'])*100,2,',','.') : '0';
                    }
    ],

    
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Agosto',
        'attribute'=>'agosto',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return $model['agosto']!=null ? $model['agosto'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Agosto',
        'attribute'=>'agosto_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return $model['agosto_acu']!=null ? $model['agosto_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Agosto',
        'attribute'=>'agosto_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return $model['agosto_eje']!=null ? $model['agosto_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Agosto',
        'attribute'=>'agosto_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return $model['agosto_acu_eje']!=null ? $model['agosto_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Agosto',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return ($model['agosto']-$model['agosto_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Agosto Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return ($model['agosto']!=0) ? ($model['agosto_eje']/$model['agosto'])*100 : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Agosto',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return ($model['agosto_acu']-$model['agosto_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Agosto Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==8 ? true : false,
        'value' => function($model)
                    {
                        return ($model['agosto_acu']!=0) ? number_format(($model['agosto_acu_eje']/$model['agosto_acu'])*100,2,',','.') : '0';
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Septiembre',
        'attribute'=>'septiembre',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return $model['septiembre']!=null ? $model['septiembre'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Septiembre',
        'attribute'=>'setiembre_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return $model['septiembre_acu']!=null ? $model['septiembre_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Septiembre',
        'attribute'=>'septiembre_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return $model['septiembre_eje']!=null ? $model['septiembre_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Septiembre',
        'attribute'=>'septiembre_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return $model['septiembre_acu_eje']!=null ? $model['septiembre_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Septiembre',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return ($model['septiembre']-$model['septiembre_eje']);
                    }
    ],

    
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Septiembre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return ($model['septiembre']!=0) ? ($model['septiembre_eje']/$model['septiembre'])*100 : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Septiembre',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return ($model['septiembre_acu']-$model['septiembre_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Septiembre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==9 ? true : false,
        'value' => function($model)
                    {
                        return ($model['septiembre_acu']!=0) ? number_format(($model['septiembre_acu_eje']/$model['septiembre_acu'])*100,2,',','.') : '0';
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Octubre',
        'attribute'=>'octubre',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return $model['octubre']!=null ? $model['octubre'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Octubre',
        'attribute'=>'octubre_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return $model['octubre_acu']!=null ? $model['octubre_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Octubre',
        'attribute'=>'octubre_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return $model['octubre_eje']!=null ? $model['octubre_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Octubre',
        'attribute'=>'octubre_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return $model['octubre_acu_eje']!=null ? $model['octubre_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Octubre',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return ($model['octubre']-$model['octubre_eje']);
                    }
    ],

    
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Octubre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return ($model['octubre']!=0) ? ($model['octubre_eje']/$model['octubre'])*100 : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Octubre',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return ($model['octubre_acu']-$model['octubre_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Octubre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==10 ? true : false,
        'value' => function($model)
                    {
                        return ($model['octubre_acu']!=0) ? number_format(($model['octubre_acu_eje']/$model['octubre_acu'])*100,2,',','.') : '0';
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Noviembre',
        'attribute'=>'noviembre',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return $model['noviembre']!=null ? $model['noviembre'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Noviembre',
        'attribute'=>'noviembre_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return $model['noviembre_acu']!=null ? $model['noviembre_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Noviembre',
        'attribute'=>'noviembre_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return $model['noviembre_eje']!=null ? $model['noviembre_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado Noviembre',
        'attribute'=>'noviembre_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return $model['noviembre_acu_eje']!=null ? $model['noviembre_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Noviembre',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return ($model['noviembre']-$model['noviembre_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Noviembre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return ($model['noviembre']!=0) ? number_format(($model['noviembre_eje']/$model['noviembre'])*100,2,',','.') : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Noviembre',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return ($model['noviembre_acu']-$model['noviembre_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Noviembre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==11 ? true : false,
        'value' => function($model)
                    {
                        return ($model['noviembre_acu']!=0) ? number_format(($model['noviembre_acu_eje']/$model['noviembre_acu'])*100,2,',','.') : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Programado Diciembre',
        'attribute'=>'diciembre',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return $model['diciembre']!=null ? $model['diciembre'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Programado Diciembre',
        'attribute'=>'diciembre_acu',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return $model['diciembre_acu']!=null ? $model['diciembre_acu'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Ejecutado Diciembre',
        'attribute'=>'diciembre_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return $model['diciembre_eje']!=null ? $model['diciembre_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Acumulado Ejecutado diciembre',
        'attribute'=>'diciembre_acu_eje',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return $model['diciembre_acu_eje']!=null ? $model['diciembre_acu_eje'] : 0;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Absoluta Diciembre',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return ($model['diciembre']-$model['diciembre_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Trimestre Diciembre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return ($model['diciembre']!=0) ? number_format(($model['diciembre_eje']/$model['diciembre'])*100,2,',','.') : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Absoluta Dciembre',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return ($model['diciembre_acu']-$model['diciembre_acu_eje']);
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Variaccion Acumulada Octubre Relativa %',
        'visible' => $meses['id']=='x999' || $meses['id']==12 ? true : false,
        'value' => function($model)
                    {
                        return ($model['diciembre_acu']!=0) ? number_format(($model['diciembre_acu_eje']/$model['diciembre_acu'])*100, 2,',','.') : '0';
                    }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Unidad Ejecutora',
        'attribute'=>'unidad_ejecutora',
        'contentOptions' => 
        [
            'style'=>'max-width: 450px;  word-wrap: break-word;
            white-space: normal;'
        ],
    ],
    
    
    
];




return $columns;   