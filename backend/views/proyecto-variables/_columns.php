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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'codigoProyecto',
        'label' => 'Código Proyecto',
        'contentOptions' => 
            [
                'style'=>'width: 50px;  word-wrap: break-word;
                white-space: normal;'
            ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombreProyecto',
        'contentOptions' => 
            [
                'style'=>'max-width: 450px;  word-wrap: break-word;
                white-space: normal;'
            ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombreAccion',
        'label' => 'Proyecto Acción Específica',
        'contentOptions' => 
            [
                'style'=>'max-width: 450px;  word-wrap: break-word;
                white-space: normal;'
            ]
    ],
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