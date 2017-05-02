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
        'label' => 'Nombre',
        'contentOptions' => 
                [
                    'style'=>'max-width: 350px;  word-wrap: break-word;
                    white-space: normal;'
                ],
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
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'','title'=>'Editar', 'data-toggle'=>'tooltip'],
        
    ],

];   