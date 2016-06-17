<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\detail\DetailView;
use johnitvn\ajaxcrud\CrudAsset;
use yii\widgets\Pjax;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use yii\bootstrap\Button;
/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariables */
CrudAsset::register($this);
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'recargar' => '<span class="glyphicon glyphicon-repeat"></span>'
];

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="accion-centralizada-variables-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'mode' => 'view',
        'fadeDelay' => 0,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'attributes' => [
            'id',
            'nombre_variable:ntext',
            //'unidad_medida',
            [
                //'label' => 'unidad_ejecutora',
                'attribute' => 'unidad_medida',
                'value' =>$model->unidadMedida->unidad_medida,
                
            ],

            //'localizacion',
            'definicion:ntext',
            'base_calculo:ntext',
            'fuente_informacion:ntext',
            
            //'meta_programada_variable',
            [
                //'label' => 'unidad_ejecutora',
                'attribute' => 'unidad_ejecutora',
                'value' =>$model->unidadEjecutora->nombre,
                
            ],
            
            'localizacion',
            [
                //'label' => 'acc_accion_especifica',
                'attribute' => 'acc_accion_especifica',
                //'value' =>echo $model->accAccionEspecifica->nombre,
                
            ],
        ],
         'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="fa fa-list"></i> Datos Básicos Variables',
            ],
    ]) ?>

</div>

    <!-- LOCALIZACION -->
<div class="panel panel-info" id="localizacion" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-map-marker"></i> Localización</h3>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'id' => 'crud-datatable', //IMPORTANTE
            'dataProvider'=>$localizacion,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_localizacion.php'),
            'toolbar'=> [
                ['content'=>
                
                    (($model->local_variable==false && $model->localizacion==0) || ($model->local_variable_estados==false && $model->localizacion==1)  ?  
                    Html::a($icons['crear'].' Nuevo', ['localizacion-acc-variable/create', 'variable' => $model->id, 'localizacion' => $model->localizacion,],  
                    ['role'=>'modal-remote','title'=> 'Nuevo','class'=>'btn btn-default']) : '').


                    Html::a($icons['recargar'].' Refrescar', ['/accion-centralizada-variables/view', 'id' => $model->id],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                //'heading' => '<i class="glyphicon glyphicon-map-marker"></i>',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["localizacion-acc-variable/bulk-delete"] ,
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
        ]) ?>          
    </div>
</div>

<!-- RESPONSABLES -->
<div class="panel panel-info" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Responsable</h3>
    </div>
    <div class="panel-body">

        <!-- Responsable -->
        <div id="responsable" data-pjax-container data-pjax-timeout="1000">
            <?= Yii::$app->controller->renderPartial('_responsables', [
                'model' => $model->responsable,
                'url' => 'responsable-acc-variable',
                'variable' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono'
                ]
            ]) ?>
        </div>

<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
    "options" => [
        "tabindex" => false //importante para Select2
    ]
])?>
<?php Modal::end(); ?>
