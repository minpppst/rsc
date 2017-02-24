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
        'attribute'=>'cod_proyecto_central',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre_proyecto_central',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cod_especifica',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre_especifica',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre_unidad_ejecutora',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'partida',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'material',
        'visible' => $agrupar_partida,
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'unidad_medida',
        'visible' => $agrupar_partida,
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'presentacion',
        'visible' => $agrupar_partida,
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'precio',
        'visible' => $agrupar_partida,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'iva',
        'visible' => $agrupar_partida,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'trim1',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total_trim1',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'trim2',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total_trim2',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'trim3',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total_trim3',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'trim4',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total_trim4',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total_iva',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total',
    ],
    
    
];




return $columns;   