<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;

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
        'attribute'=>'usuario',
    ],
    */
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Proyecto',
        'value' => function($model){
            return StringHelper::truncateWords($model->proyectoEspecifica->idProyecto->nombre,10);
        }
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Acción Específica',
        'attribute'=>'proyectoEspecifica.nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Unidad Ejecutora',
        'attribute'=>'proyectoEspecifica.idUnidadEjecutora.nombre',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'width' => '50px',
        'attribute' => 'estatus',
        //Lista desplegable
        'filter' => [1 => 'Activo', 0 => 'Inactivo'],
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
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'header' => 'Acciones',
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
    ],

];   