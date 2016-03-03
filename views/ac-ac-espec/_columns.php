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
    'class' => '\kartik\grid\DataColumn',
        'width' => '50px',
        'attribute' => 'estatus',
        
        'value' => function ($model) {$url= Url::to(['ac-ac-espec/toggle-activo', 'id' => $model->id]);
            if ($model->estatus == 1) {

                
                return Html::a($model->nombreEstatus, ['/ac-ac-espec/toggleactivo', 'id' => $model->id],[
                            /*'class' => 'btn btn-xs btn-success btn-block',
                             'role' => 'modal-remote',
                            
                            //'data-pjax' => true,
                            
                            'pjax-container'=>'especifica-pjax',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'id' => 'bulk-status',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                            'data-request-method' => 'post',
                            'data-pjax' => '0',
                          */'class' => 'btn btn-xs btn-success btn-block',
                            'onclick' => "
                                if (confirm('¿Está seguro que desea Desactivar este elemento?')) {
                                $.ajax('$url', {
                                type: 'POST'
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                ",
                                
                

                            ]);
            } else { 
                return Html::a($model->nombreEstatus, ['/ac-ac-espec/toggle-activo', 'id' => $model->id],
                           
                             [
                            'class' => 'btn btn-xs btn-warning btn-block',
                            'onclick' => "
                                if (confirm('¿Está seguro que desea activar este elemento?')) {
                                $.ajax('$url', {
                                type: 'POST'
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                ",
                                
                ]);
            }
        },
         'format' => 'raw'

    ],





    

    

    [
               'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
        'vAlign'=>'middle',
        'width'=>'100px',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
                'template' => '{view}{update} {delete}{crear-uej}{editar-uej}',
                'buttons' => [
                    

                   /* 'crear-uej' => function ($url, $model) {
                        return  $model->existe_uej()==0 ? Html::a(
                            '<span class="glyphicon glyphicon-plus"></span>',
                           Url::to(['ac-esp-uej/create', 'accion_central' => $model->id_ac_centr, 'accion_especifica'=>$model->id]), 
                            [
                                'title' => 'Agregar Unidades Ejecutoras',
                                'role'=>'modal-remote',
                                'data-toggle'=>'tooltip'

                            ]
                        ) : '';
                    },
                    'editar-uej' => function ($url, $model) {
                        return $model->existe_uej()==1 ? Html::a(
                            '<span class="glyphicon glyphicon-edit"></span>',
                           Url::to(['ac-esp-uej/update', 'id'=>$model->id , 'accion_centralizada'=>$model->id_ac_centr]), 
                            [
                                'title' => 'Editar Unidades Ejecutoras',
                                'role'=>'modal-remote',
                                'data-toggle'=>'tooltip'

                            ]
                        ) : '';
                    },*/

           
                ],
        //'probandoOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
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