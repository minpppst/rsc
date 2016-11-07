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
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    /*
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_proyecto',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'codigo_accion_especifica',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
        'value' => function($model){
            //Cortar el nombre
            return StringHelper::truncateWords($model->nombre,10);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombreUnidadEjecutora',
        'value' => function($model){
            //Cortar el nombre de la UE
            return StringHelper::truncateWords($model->nombreUnidadEjecutora,6);
        }
    ],
    /*
    [
        'class' => '\kartik\grid\DataColumn',
        'width' => '50px',
        'attribute' => 'nombreEstatus',
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
        'format' => 'raw'
    ],
    */
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
        'class' => 'kartik\grid\ActionColumn',
        'visibleButtons' => 
        [
            'update' => function ($model, $key, $index) 
            {
                return Yii::$app->user->can('proyecto-accion-especifica/update', ['id' => $model->id]) ? true : false;
                
            },
            'delete' => function ($model, $key, $index) 
            {
                return Yii::$app->user->can('proyecto-accion-especifica/delete', ['id' => $model->id]) ?  true : false;
                
            },

            'prg' => function ($model, $key, $index) 
            {
                return Yii::$app->user->can('proyecto-accion-especifica/update', ['id' => $model->id]) ?  true : false;
                
            }

        ],
        'header' => 'Acciones',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'¿Está seguro?',
                          'data-confirm-message'=>'¿Está seguro que desea eliminar este item?',
                          'class' => 'text-danger'], 
        
        
    ],

];   