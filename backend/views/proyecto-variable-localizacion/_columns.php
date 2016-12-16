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
                        return $modelLocalizacion->idEstado->nombre;
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_municipio',
        'label' => 'Municipio',
        'value' => function ($modelLocalizacion)
                    {
                        return $modelLocalizacion->idMunicipio->nombre;
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_parroquia',
        'label' => 'Parroquia',
        'value' => function ($modelLocalizacion)
                    {
                        return $modelLocalizacion->idParroquia->nombre;
                    },
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(['/proyecto-variable-localizacion/'.$action,'id'=>$key]);
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