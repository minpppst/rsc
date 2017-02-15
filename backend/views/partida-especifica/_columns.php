<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
        'attribute'=>'cuenta',
        'contentOptions' => 
                [
                    'style'=>'width: 50px;  word-wrap: break-word;
                    white-space: normal;'
                ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'partida',
        'contentOptions' => 
                [
                    'style'=>'width: 50px;  word-wrap: break-word;
                    white-space: normal;'
                ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'generica',
        'contentOptions' => 
                [
                    'style'=>'width: 50px;  word-wrap: break-word;
                    white-space: normal;'
                ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'especifica',
        'contentOptions' => 
                [
                    'style'=>'width: 50px;  word-wrap: break-word;
                    white-space: normal;'
                ]
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
        'class' => '\kartik\grid\DataColumn',
        'width' => '50px',
        'attribute' => 'estatus',
        //Lista desplegable
        'filter' => [1 => 'Activo', 0 => 'Inactivo'],
        'value' => function ($model) {
            if ($model->estatus == 1) {
                return Html::a($model->nombreEstatus, ['toggle-activo', 'cuenta' => $model->cuenta, 'partida' => $model->partida, 'generica' => $model->generica, 'especifica' => $model->especifica], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'role' => 'modal-remote',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                ]);
            } else {
                return Html::a($model->nombreEstatus, ['toggle-activo', 'cuenta' => $model->cuenta, 'partida' => $model->partida, 'generica' => $model->generica, 'especifica' => $model->especifica], [
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
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action, 'cuenta' => $model->cuenta, 'partida' => $model->partida, 'generica' => $model->generica, 'especifica' => $model->especifica]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   