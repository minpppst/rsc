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
  
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
         'template' => '{view} &nbsp; {update}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'','title'=>'Update', 'data-toggle'=>'tooltip'],
        
    ],

];   