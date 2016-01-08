<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

use app\models\EstatusProyecto;
use app\models\SituacionPresupuestaria;
use app\models\Sector;
use app\models\SubSector;
use app\models\PlanOperativo;
use app\models\ObjetivosHistoricos;
use app\models\ObjetivosNacionales;
use app\models\ObjetivosEstrategicos;
use app\models\ObjetivosGenerales;

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
];

CrudAsset::register($this);

?>

<!-- BOTONES -->
<p>
    <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Está seguro que desea eliminar el Proyecto? (Todos los datos asociados serán eliminados)',
            'method' => 'post',
        ],
    ]) ?>
</p>

<!-- Widget con los datos -->
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'codigo_proyecto',
        'codigo_sne',
        'nombre',
        [
            'label' => 'Estatus del Proyecto',
            'value' => $model->nombreEstatus,
        ],
        [
            'label' => 'Situación Presupuestaria',
            'value' => SituacionPresupuestaria::find()->where(['id'=>$model->situacion_presupuestaria])->one()->situacion,
        ],
        'monto_proyecto',
        'descripcion:ntext',
        [
            'label' => 'Sector',
            'value' => Sector::find()->where(['id'=>$model->sector])->one()->sector,
        ],
        [
            'label' => 'Sub-sector',
            'value' => SubSector::find()->where(['id'=>$model->sub_sector])->one()->sub_sector,
        ],
        [
            'label' => 'Plan Operativo',
            'value' => PlanOperativo::find()->where(['id'=>$model->plan_operativo])->one()->plan_operativo,
        ],
        [
            'label' => 'Objetivo Historico',
            'value' => $historico->objetivo_historico,
        ],
        [
            'label' => 'Objetivo Nacional',
            'value' => $nacional->objetivo_nacional,
        ], 
        [
            'label' => 'Objetivo Estratégico',
            'value' => $estrategico->objetivo_estrategico,
        ],            
        [
            'label' => 'Objetivo General',
            'value' => ObjetivosGenerales::find()->where(['id'=>$model->objetivo_general])->one()->objetivo_general,
        ],            
        'objetivo_estrategico_institucional',
        [
            'label' => 'Ámbito',
            'value' => $model->idAmbito->ambito,
        ]
    ],
]) ?>

<!-- LOCALIZACION -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Localización</h3>
    </div>
    <div class="panel-body">
        <div id="ajaxCrudDatatable">
            <?= GridView::widget([
                    'id' => 'crud-datatable',
                    'dataProvider'=>$localizacion,
                    'pjax'=>true,
                    'columns' => require(__DIR__.'/_localizacion.php'),
                    'toolbar'=> [
                        ['content'=>
                            Html::a('<i class="glyphicon glyphicon-plus">Agregar</i>', ['proyecto-localizacion/create', 'proyecto' => $model->id, 'ambito' => $model->ambito],
                            ['role'=>'modal-remote','title'=> 'Create new Proyecto Localizacions','class'=>'btn btn-default']).
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                            ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                            '{toggleData}'.
                            '{export}'
                        ],
                    ],          
                    'striped' => true,
                    'condensed' => true,
                    'responsive' => true,          
                    'panel' => [
                        'type' => 'primary', 
                        'heading' => '<i class="glyphicon glyphicon-list"></i> Proyecto Localización listing',
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
            ]) ?>
        </div>            
    </div>
</div>  

<!-- RESPONSABLES -->
<div class="panel panel-info" >
    <div class="panel-heading">
        <h3 class="panel-title">Responsables</h3>
    </div>
    <div class="panel-body">

        <!-- Responsable -->
        <div id="responsable">
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->responsable,
                'url' => 'proyecto-responsable',
                'proyecto' => $model->id, 
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

        <!-- Responsable Administrativo -->
        <div id="administrativo">
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->responsableAdministrativo,
                'url' => 'proyecto-responsable-administrativo',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable Administrativo',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono',
                    'unidad_administradora'
                ]
            ]) ?>
        </div>

        <!-- Responsable Tecnico -->
        <div id="tecnico">
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->responsableTecnico,
                'url' => 'proyecto-responsable-tecnico',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable Técnico',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono',
                    'unidad_tecnica'
                ]
            ]) ?>
        </div>

        <!-- Registrador -->
        <div id="registrador">
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->registrador,
                'url' => 'proyecto-registrador',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Registrador',
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