<?php

//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Html;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariables */
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
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-variables-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'mode' => 'view',
        'fadeDelay' => 0,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'enableEditMode' => false,
        'attributes' => [
            'nombre_variable:ntext',
            [
                'attribute' => 'unidad_medida',
                'value' => $model->unidadMedida->unidad_medida,
            ],
            [
                'attribute' => 'localizacion',
                'value' => $model->ambito->ambito,
            ],
            'definicion:ntext',
            'base_calculo:ntext',
            'fuente_informacion:ntext',
            [
                'attribute' => 'unidad_ejecutora',
                'value' => $model->unidadEjecutora->nombre,
            ],
            [
                'attribute' => 'accion_especifica',
                'value' => $model->accionEspecifica->nombre,
            ],
            [
                'attribute' => 'impacto',
                'value' => $model->impacto0->descripcion,
            ],
            [
                'label' => 'Usuarios Responsables',
                'value' => $usuarios,
            ],
            //'fecha_creacion',
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
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $localizacion,
            'pjax'=>true,
            'columns' => require(__DIR__.'\..\proyecto-variable-localizacion/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/proyecto-variable-localizacion/create', 'id_variable' => $model->id],
                    ['role'=>'modal-remote','title'=> 'Create new Proyecto Variable Localizacions','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/proyecto-variables/view', 'id' => $model->id],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Refrescar']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["/proyecto-variable-localizacion/bulk-delete"] ,
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
        ])?>
    </div>
</div>

<!-- RESPONSABLES -->
<div class="panel panel-info" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Responsable</h3>
    </div>
    <div class="panel-body">
        <!-- Responsable -->

        <div id="responsable-data" data-pjax-container="" data-pjax-timeout="5000">
        
            <?= Yii::$app->controller->renderPartial('_responsables', [
                'model' => $model->proyectoVariableResponsables,
                'url' => 'proyecto-variable-responsable',
                'variable' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono',
                    
                ]
            ]) ?>
        
        </div>
        
    </div>
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

