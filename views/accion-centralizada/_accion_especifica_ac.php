<?php
use \kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\models\AcAcEspecSearch;
use kartik\select2\Select2;
\kartik\select2\Select2Asset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcAcEspecSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'importar'=>'<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
];

$searchModel= new AcAcEspecSearch(['id_ac_centr'=>$model->id]);
$dataProvider=$searchModel->search(Yii::$app->request->queryParams);



            
            echo GridView::widget([
            'id'=>'especifica',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'pjaxSettings' => [
            'options' => [
                'id' => 'especifica-pjax',
            ],
        ],
            'columns' =>[
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
        
        'value' => function ($model) {
            if ($model->estatus == 1) {
                return Html::a($model->nombreEstatus, ['/ac-ac-espec/toggle-activo', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'role' => 'modal-remote',
                            //'data-pjax' => '0',
                            'data-confirm' => false, 'data-method' =>'false', // for overide yii data api
                            //'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                ]);
            } else {
                return Html::a($model->nombreEstatus, ['/ac-ac-espec/toggle-activo', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-warning btn-block',
                            'role' => 'modal-remote',

                            'data-confirm' => false, 'data-method' => 'false', // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('yii', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('yii', '¿Está seguro que desea activar este elemento?'),
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
                return Url::to(['ac-ac-espec/'.$action,'id'=>$key]);
        },
                'template' => '{view}{update} {delete}{crear-uej}{editar-uej}',
                /*'buttons' => [
                    

                    'crear-uej' => function ($url, $model) {
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
                    },

           
                ],*/
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

            ]


            ,
            'toolbar'=> [
                ['content'=>                  
                    Html::a($icons['crear'].' Agregar', ['/ac-ac-espec/create','ac_centralizada' => $searchModel['id_ac_centr']],
                    ['role'=>'modal-remote','title'=> 'Crear Nueva  Accion Especifica','class'=>'btn btn-success']).
                    '{toggleData}'.
                    '{export}'.
                    Html::a($icons['importar'].' Importar', ['/ac-ac-espec/importar','accion_central' => $searchModel['id_ac_centr']],
                    ['title'=> 'Importar Acciones Centralizadas','class'=>'btn btn-default'])
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
            'heading' => '<i class="glyphicon glyphicon-list"></i> Proyecto Accion Especificas listing',
            'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Are you sure?',
                                    'data-confirm-message'=>'Are you sure want to delete this item'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ]);
      
    