<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\BulkButtonWidget;
use johnitvn\ajaxcrud\CrudAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acción Centralizada';
$this->params['breadcrumbs'][] = $this->title;
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'importar'=>'<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
CrudAsset::register($this);
?>
<div class="accion-centralizada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   
<div id="ajaxCrudDatatable">
    <?= GridView::widget([
        'id'=>'crud-datatable',
         'pjax'=>true,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'width' => '20px',
            ],
            ['class' => 'kartik\grid\SerialColumn'],

            'codigo_accion',
            'codigo_accion_sne',
            'nombre_accion',

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
                'class' => '\kartik\grid\DataColumn',
                'width' => '50px',
                'attribute' => 'estatus',
                
                'value' => function ($model) {
                    if ($model->estatus == 1) {

                        
                        return Html::a($model->nombreEstatus, ['/accion-centralizada/toggle-activo', 'id' => $model->id],[
                                    'class' => 'btn btn-xs btn-success btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                                   ]);
                    } else { 
                        return Html::a($model->nombreEstatus, ['/accion-centralizada/toggle-activo', 'id' => $model->id],[
                                    'class' => 'btn btn-xs btn-warning btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea activar este elemento?'),
                                    
                                        
                        ]);
                    }
                },
                 'format' => 'raw'
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign'=>'middle',
                'urlCreator' => function($action, $model, $key, $index) { 
                        return Url::to([$action,'id'=>$key]);
                },
                'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>'Are you sure?',
                    'data-confirm-message'=>'Are you sure want to delete this item',
                    'class' => 'text-danger'], 
            ],
        ],
        'toolbar'=> [
            [ 
                'content'=>                  
                    Html::a($icons['crear'].' Nuevo', ['create'], ['class' => 'btn btn-default']).
                    '{toggleData}'.
                    '{export}'.
                    Html::a($icons['importar'].' Importar', ['importar'],
                    ['title'=> 'Importar Acciones Centralizadas','class'=>'btn btn-default'])
            ],
        ],
        'panel' => [
            'type' => 'default', 
            'heading' => '<i class="glyphicon glyphicon-folder-open"></i> Acciones Centralizadas',
            'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
            'after'=>BulkButtonWidget::widget([
                'buttons'=>
                    Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar',
                    ["bulk-delete"] ,
                    [
                        "class"=>"btn btn-danger btn-xs",
                        'role'=>'modal-remote-bulk',
                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        'data-request-method'=>'post',
                        'data-confirm-title'=>'¿Está seguro?',
                        'data-confirm-message'=>'¿Está seguro que desea eliminar los elementos seleccionados?'
                    ]).' '.
                    Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                        ["bulk-estatusdesactivo"] ,
                        [
                            "class"=>"btn btn-warning btn-xs",
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'¿Está seguro?',
                            'data-confirm-message'=>'¿Está seguro que desea desactivar los elementos seleccionados?'
                        ]).' '.
                    Html::a('<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; Activar',
                        ["bulk-estatusactivo"] ,
                        [
                            "class"=>"btn btn-success btn-xs",
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'¿Está seguro?',
                            'data-confirm-message'=>'¿Está seguro que desea activar los elementos seleccionados?'
                        ]),
                    ]).                       
                    '<div class="clearfix"></div>',
            ]

    ]); ?>

</div>
</div>
<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
