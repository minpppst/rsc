<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre_variable',
        'contentOptions' => 
            [
            'style'=>'max-width: 450px;  word-wrap: break-word;
            white-space: normal;'
            ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'unidad_medida',
        'value' => function($model){
                        return $model->unidadMedida->unidad_medida;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'localizacion',
        'value' => function($model){
                        return $model->ambito->ambito;
                    }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'definicion',
        'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'base_calculo',
        'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fuente_informacion',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'unidad_ejecutora',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'accion_especifica',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'impacto',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_creacion',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_modificacion',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_eliminacion',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Borrar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   