<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
        'attribute'=>'id_pais',
        'label' => 'Pais',
        'value' => function ($modelLocalizacion)
                    {
                        return $modelLocalizacion->idPais->nombre;
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_estado',
        'label' => 'Estado',
        'value' => function ($modelLocalizacion)
                    {
                        return ($modelLocalizacion->idEstado)!=null ? $modelLocalizacion->idEstado->nombre : '';
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_municipio',
        'label' => 'Municipio',
        'value' => function ($modelLocalizacion)
                    {
                        return ($modelLocalizacion->idMunicipio)!=null ? $modelLocalizacion->idMunicipio->nombre : '';
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_parroquia',
        'label' => 'Parroquia',
        'value' => function ($modelLocalizacion)
                    {
                          return ($modelLocalizacion->idParroquia)!=null ? $modelLocalizacion->idParroquia->nombre : '';
                    },
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'template' => '{view}{update}{delete}{desbloqueo}', 
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(['/proyecto-variable-localizacion/'.$action,'id'=>$key]);
        },
        'buttons' => [
        'desbloqueo' => function ($url, $model, $key) {
         return $model->obtenerEjecucion ?   html::a(' <span class="glyphicon glyphicon-lock"></span>',['proyecto-variable-desbloqueo-mes/index', 'id'=>$model->id,], ['role'=>'modal-remote','title'=>'Desbloquear Mes','data-toggle'=>'tooltip']) : '';
        },
        ],
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