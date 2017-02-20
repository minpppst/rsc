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
        'attribute'=>'nombrePais',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombreEstado',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombreMunicipio',
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombreParroquia',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'visibleButtons' => 
        [
            'update' => function ($model, $key, $index) 
            {
                return \Yii::$app->user->can('proyecto-localizacion/update', ['id' => $model->id_proyecto]) ? true : false;
                
            },
            
            'delete' => function ($model, $key, $index) 
            {
                return \Yii::$app->user->can('proyecto-localizacion/delete', ['id' => $model->id_proyecto]) ? true : false;
                
            }

        ],
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(['proyecto-localizacion/'.$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   