<?php
use \kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use common\models\AcAcEspecSearch;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AcAcEspecSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

\kartik\select2\Select2Asset::register($this);

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'importar'=>'<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
];
$url_borrar= Url::to(['ac-ac-espec/bulkdelete', "$('#especifica-pjax').yiiGridView('getSelectedRows')"]);
$searchModel= new AcAcEspecSearch(['id_ac_centr'=>$model->id]);
$dataProvider=$searchModel->search(Yii::$app->request->queryParams);

?>

<?= GridView::widget([
    'id'=>'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pjax'=>true,           
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
            'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]
        ],

        /*[
            'class' => '\kartik\grid\DataColumn',
            'width' => '50px',
            'attribute' => 'estatus',
            'value' => function ($model) {
                if ($model->estatus == 1) {

                    
                    return Html::a($model->nombreEstatus, ['/ac-ac-espec/toggle-activo', 'id' => $model->id],[
                                'class' => 'btn btn-xs btn-success btn-block',
                                'role' => 'modal-remote',
                                'data-confirm' => false, 'data-method' => false, // for overide yii data api
                               
                                'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                               ]);
                } else { 
                    return Html::a($model->nombreEstatus, ['/ac-ac-espec/toggle-activo', 'id' => $model->id],[
                                'class' => 'btn btn-xs btn-warning btn-block',
                                'role' => 'modal-remote',
                                'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                
                                'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                'data-confirm-message' => Yii::t('user', '¿Está seguro que desea activar este elemento?'),
                                
                                    
                    ]);
                }
            },
            'format' => 'raw'
        ],*/
        [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'fecha_inicio',
        'value' => function($model) {
            return date('d/m/Y',strtotime($model->fecha_inicio));
        },
        'filterType' => '\kartik\date\DatePicker',
        'filterWidgetOptions' => [
            'readonly' => true,
            'pluginOptions' => [
                'todayHighlight' => false,
                'todayBtn' => true,
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'fecha_fin',
        'value' => function($model) {
            return date('d/m/Y',strtotime($model->fecha_fin));
        },
        'filterType' => '\kartik\date\DatePicker',
        'filterWidgetOptions' => [
            'readonly' => true,
            'pluginOptions' => [
                'todayHighlight' => false,
                'todayBtn' => true,
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]
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
            //'probandoOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
            'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
            'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
            'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar', 
                              'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                              'data-request-method'=>'post',
                              'data-toggle'=>'tooltip',
                              'data-confirm-title'=>'Are you sure?',
                              'data-confirm-message'=>'Are you sure want to delete this item',
                              'class' => 'text-danger'], 
        ],
    ],
    'toolbar'=> [
        ['content'=>                  
            Html::a($icons['crear'].' Nuevo', ['/ac-ac-espec/create','ac_centralizada' => $searchModel['id_ac_centr']],
            ['role'=>'modal-remote','title'=> 'Crear Nueva  Accion Especifica','class'=>'btn btn-default']).
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
    'type' => 'info', 
    'heading' => '<i class="glyphicon glyphicon-list"></i> Accion Centralizada Acciones Especificas listing',
    'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
    'after'=>BulkButtonWidget::widget([
            'buttons'=>
                Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar',
                ["/ac-ac-espec/bulk-delete"] ,
                [
                    "class"=>"btn btn-danger btn-xs",
                    'role'=>'modal-remote-bulk',
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-confirm-title'=>'¿Está seguro?',
                    'data-confirm-message'=>'¿Está seguro que desea eliminar los elementos seleccionados?'
                ]),/*.' '.
                Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                    ["/ac-ac-espec/bulk-estatusdesactivo"] ,
                    [
                        "class"=>"btn btn-warning btn-xs",
                        'role'=>'modal-remote-bulk',
                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        'data-request-method'=>'post',
                        'data-confirm-title'=>'¿Está seguro?',
                        'data-confirm-message'=>'¿Está seguro que desea desactivar los elementos seleccionados?'
                    ]).' '.
                Html::a('<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; Activar',
                    ["/ac-ac-espec/bulk-estatusactivo"] ,
                    [
                        "class"=>"btn btn-success btn-xs",
                        'role'=>'modal-remote-bulk',
                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        'data-request-method'=>'post',
                        'data-confirm-title'=>'¿Está seguro?',
                        'data-confirm-message'=>'¿Está seguro que desea activar los elementos seleccionados?'
                    ]),*/
        ]).                       
        '<div class="clearfix"></div>',
    ]
]);     
    