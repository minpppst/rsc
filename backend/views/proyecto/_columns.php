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
        'attribute'=>'codigo_proyecto',
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
        'attribute' => 'fecha_inicio',
        'value' => function($model) {
            return date('d/m/Y',strtotime($model->fecha_inicio));
        },
        'filterType' => '\kartik\date\DatePicker',
        'filterWidgetOptions' => [
            'readonly' => true,
            'pluginOptions' => [
                'todayHighlight' => false,
                'todayBtn' => true,
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'fecha_fin',
        'value' => function($model) {
            return date('d/m/Y',strtotime($model->fecha_fin));
        },
        'filterType' => '\kartik\date\DatePicker',
        'filterWidgetOptions' => [
            'readonly' => true,
            'pluginOptions' => [
                'todayHighlight' => false,
                'todayBtn' => true,
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]
    ],
    
    [
        'class' => '\kartik\grid\DataColumn',
        'width' => '50px',
        'attribute' => 'nombreEstatus',
        //Lista desplegable
        'filter' => [1 => 'Activo', 0 => 'Inactivo'],
        'value' => function ($model) {
            if ($model->estatus == 1) {
                return Html::a($model->nombreEstatus, ['toggle-activo', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'role' => 'modal-remote',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                ]);
            } else {
                return Html::a($model->nombreEstatus, ['toggle-activo', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-warning btn-block',
                            'role' => 'modal-remote',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea activar este elemento?'),
                ]);
            }
        },
        'format' => 'raw',                    
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item',
                          'class' => 'text-danger'], 
    ],

];   