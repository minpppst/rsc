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
        'attribute'=>'key',
        'label' => 'Tipo',
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_origin',
        'label' => 'Usuario Origen',
        'value' => function($model)
        {
            return $model->idUserOrigin->username;
        },
                
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_id',
        'label' => 'Usuario Destino',
        'value' => function($model)
        {
            return $model->idUser->username;
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'key_id',
        'label' => 'Resumen',
        'value' => function($model){
            return $model->resumen;
        },
        'filter' => false,

    ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_id',
    ],*/

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'seen',
        'label' => 'Visto',
        'value' => function($model){
            return $model->seen==1 ? 'Visto' : 'No visto';
        },
        'filter' => false,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_at',
        'value' => function($model){
            return $model->created_at ? date('d/m/Y h:i',strtotime($model->created_at)) : '';
        },
        'filter' => false,
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template'=>'{view}',
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