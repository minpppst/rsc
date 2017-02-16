<?php

use yii\helpers\Html;
use yii\helpers\Url;
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

$this->title = "Variable Accion Centralizada #".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variables', 'url' => ['accion-centralizada-variables/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="accion-centralizada-variables-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
      
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'mode' => 'view',
        'fadeDelay' => 0,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'enableEditMode' => false,
        'attributes' => 
        [
              
            'nombre_variable:ntext',
            [
                'attribute' => 'unidad_medida',
                'value' =>$model->unidadMedida->unidad_medida,
            ],

              
            'definicion:ntext',
            'base_calculo:ntext',
            'fuente_informacion:ntext',
                
            [
                'attribute' => 'unidad_ejecutora',
                'value' =>$model->unidadEjecutora->nombre,
            ],
                
            [
                'attribute' => 'localizacion',
                'value' => $model->nombreLocalizacion,
            ],
            [
                'attribute' => 'acc_accion_especifica',
                'value' => $model->accAccionEspecifica->nombre,
            ],
            [
                'label' => 'Usuarios Responsables',
                'value' => $usuarios,
            ],
        ],
        'panel' => 
        [
            'type' => 'primary',
            'heading' => '<i class="fa fa-list"></i> Datos Básicos Variables',
        ],
        ]) ?>

</div>

    <!-- LOCALIZACION -->
<div class="panel panel-info" id="localizacion" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-map-marker"></i> Localización y Programación Mensual</h3>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'id' => 'crud-datatable', //IMPORTANTE
            'dataProvider'=>$localizacion,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_localizacion.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a($icons['crear'].' Nuevo', ['localizacion-acc-variable/create', 'variable' => $model->id, 'localizacion' => $model->localizacion,],  
                    ['role'=>'modal-remote','title'=> 'Nuevo','class'=>'btn btn-default']).

                    Html::a($icons['recargar'].' Recargar', ['/accion-centralizada-variables/view', 'id' => $model->id],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Recargar']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Borrar Todo',
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
        <div id="responsable" data-pjax-container data-pjax-timeout="5">
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
    </div>
</div>

<div class="btn-group">
    <?= Html::a('<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Volver', ['accion-centralizada-variables/index'], ['class' => 'btn btn-primary']) ?>
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
