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
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_ac_centr',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cod_ac_espe',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],

    

    [
        'class' => 'kartik\grid\ActionColumn',
        'template'      => '{active}&nbsp;{view}&nbsp;{update}&nbsp;{delete}', 
        'dropdown' => false,
        'vAlign'=>'middle',

        'buttons'       => [
   "activeOptions" => function ($url, $model) {
        if ($model->active == 1) $icon = "create1";
        else $icon = "create";

        return Html::a(\kartik\helpers\Html::icon($icon), $url, [
        'title'              => Yii::t('app', 'Toogle Active'),
        'data-pjax'          => '1',
        'data-toggle-active' => $model->id
    ]);
   },
],



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
                          'data-confirm-message'=>'Are you sure want to delete this item',
                          'class' => 'text-danger'],


    ],

];   