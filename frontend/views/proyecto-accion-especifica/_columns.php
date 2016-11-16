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
    
    /*[
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
    ],*/
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