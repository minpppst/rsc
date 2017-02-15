<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\date\DatePicker;

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
        'attribute'=>'codigo_accion_especifica',
        'label' => 'Código',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
        'value' => function ($model)
                    {
                        return $model->nombre;
                    },
        'contentOptions' => 
        [
        'style'=>'max-width: 350px;  word-wrap: break-word;
        white-space: normal;'
        ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombreUnidadEjecutora',
        'value' => function ($model)
                    {
                        return $model->nombreUnidadEjecutora;
                    },
        'contentOptions' => 
        [
        'style'=>'max-width: 350px;  word-wrap: break-word;
        white-space: normal;'
        ]
    ],
    [
                'class' => '\kartik\grid\DataColumn',
                'width' => '50px',
                'attribute' => 'nombreEstatus',
                'value' => function ($model) {
                    if ($model->estatus == 1) {
                        return Html::a($model->nombreEstatus, ['proyecto-accion-especifica/toggle-activo', 'id' => $model->id], [
                                    'class' => 'btn btn-xs btn-success btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                        ]);
                    } else {
                        return Html::a($model->nombreEstatus, ['proyecto-accion-especifica/toggle-activo', 'id' => $model->id], [
                                    'class' => 'btn btn-xs btn-warning btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea activar este elemento?'),
                        ]);
                    }
                },
                'format' => 'raw'
            ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Borrar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item',
                          'class' => 'text-danger'], 
    ],

];   