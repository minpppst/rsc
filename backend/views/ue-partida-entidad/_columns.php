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
        'attribute'=>'cuenta',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'partida',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Nombre',
        'value' => function ($model, $key, $index){
        return $model->partidaPartida->nombre;
        },
    ],
   /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_ue',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_tipo_entidad',
    ],*/
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                         'data-request-method'=>'post',
                         'data-toggle'=>'tooltip',
                         'data-confirm-title'=>'Are you sure?',
                         'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   