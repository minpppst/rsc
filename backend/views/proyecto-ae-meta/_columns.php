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
        'attribute'=>'id_proyecto_accion_especifica',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'enero',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'febrero',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'marzo',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'abril',
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
        'template' => '{view} {update} {prg} {delete}',
        'buttons' => 
        [
            'prg' => function($model, $key, $index){
                return 
                    Html::a('<span class="glyphicon glyphicon-calendar"></span>', 
                    Url::to(['proyecto-ae-meta/create', 'idLocalizacion' => $index]), 
                    [
                        'role'=>'modal-remote',
                        'title'=>'Programación',
                        'data-toggle'=>'tooltip'
                    ]
                   
                    );
            }
        ]
    ],

];   