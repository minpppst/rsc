<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\BulkButtonWidget;
use johnitvn\ajaxcrud\CrudAsset;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaVariablesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada Variables';
$this->params['breadcrumbs'][] = $this->title;
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'importar'=>'<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
CrudAsset::register($this);
?>

<div class="accion-centralizada-variables-index">
<div id="ajaxCrudDatatable">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         //'model' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'columns' => [
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'width' => '20px',
            ],
            ['class' => 'kartik\grid\SerialColumn'],

            [
            'attribute' =>'nombre_variable',
            'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]

            ],
            [

            'attribute' => 'unidad_medida',
            'value' => function ($model){
                return $model->unidadMedida->unidad_medida;
            }
            ],
            [
            'attribute' => 'localizacion',
            'value' => function ($model){
                return $model->nombreLocalizacion;
            }
            ],
            [
            'attribute' => 'definicion',
            'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]
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
                    '{export}'
                    
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
                    ]),/*' '.
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
                        ]),*/
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