<?php
use yii\helpers\Url;
use yii\helpers\Html;

$columnas = [
    [
    'class' => 'kartik\grid\CheckboxColumn',
    'width' => '20px',
    ],

    [
    'class' => 'kartik\grid\SerialColumn',
    'width' => '30px',
    ],

    [

    'attribute' => 'nombreMaterial',
    'contentOptions' => 
    [
    'style'=>'max-width: 350px;  word-wrap: break-word;
    white-space: normal;'
    ]
    ],
    'trimestre1',
    'trimestre2',
    'trimestre3',
    'trimestre4',
    'fecha_creacion',
];
//Si es admin
if(\Yii::$app->authManager->getAssignment('sysadmin',\Yii::$app->user->id) != null)
{
    $columnas [] = [
        'class' => '\kartik\grid\DataColumn',
        'width' => '50px',
        'attribute' => 'nombreEstatus',
        'label'=>'Estatus',
        'value' => function ($model) {
            if ($model->estatus == 0) {
                return Html::a(Yii::t('user', 'Inactivo'), ['toggle-activo', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-warning btn-block',
                            'role' => 'modal-remote',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este usuario?'),
                ]);
            } else {
                return Html::a(Yii::t('user', 'Activo'), ['toggle-activo', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'role' => 'modal-remote',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea activar este usuario?'),
                ]);
            }
        },
        'format' => 'raw',
    ];
}

$columnas[] =
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
    ];

return $columnas;