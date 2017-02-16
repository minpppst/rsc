<?php
use yii\helpers\Url;
use yii\helpers\Html;
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'recargar' => '<span class="glyphicon glyphicon-repeat"></span>'
];

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
        'dropdown' => false,
        'template' => '{view}{update}{delete}{desbloqueo}', 
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(['localizacion-acc-variable/'.$action,'id'=>$key, 'variable' => $model->id_variable, 'localizacion' => $model->idVariable->localizacion]);
        },
        'buttons' => [
        'desbloqueo' => function ($url, $model, $key) {
         return $model->obtener_ejecucion ?   html::a(' <span class="glyphicon glyphicon-lock"></span>',['accion-centralizada-desbloqueo-mes/index', 'id'=>$model->id,], ['role'=>'modal-remote','title'=>'Desbloquear Mes','data-toggle'=>'tooltip']) : '';
        },
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Borrar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'¿Esta de querer eliminar este items?'], 
    ],

];   