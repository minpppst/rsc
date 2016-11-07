<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

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
    'crear'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'recargar' => '<span class="glyphicon glyphicon-repeat"></span>'
];

CrudAsset::register($this);

?>

<!-- BOTONES -->
<?php
    if(Yii::$app->user->can('proyecto/update', ['id' => $model->id]))
    {
?>
    <p>
        <?= Html::a($icons['editar'].' Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($icons['eliminar'].' Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea eliminar el Proyecto? (Todos los datos asociados serán eliminados)',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php
    }   
?>

    

<!-- Widget con los datos -->
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'codigo_proyecto',
        'nombre',
        'descripcion_proyecto',
        [
            'label' => $model->getAttributeLabel('fecha_inicio'),
            'value' => \Yii::$app->formatter->asDate($model->fecha_inicio)

        ],
        [
            'label' => $model->getAttributeLabel('fecha_fin'),
            'value' => \Yii::$app->formatter->asDate($model->fecha_fin)

        ],
        [
            'label' => $model->getAttributeLabel('estatus_proyecto'),
            'value' => $model->nombreEstatusProyecto,
        ],
        [
            'label' => $model->getAttributeLabel('situacion_presupuestaria'),
            'value' => SituacionPresupuestaria::find()->where(['id'=>$model->situacion_presupuestaria])->one()->situacion,
        ],
        [
            'label' => $model->getAttributeLabel('nombrePlurianual'),
            'value' => $model->nombrePlurianual,
        ],
        [
            'label' => $model->getAttributeLabel('monto_proyecto_actual'),
            'value' => $model->bolivarMontos($model->monto_proyecto_actual),
        ],
        [
            'label' => $model->getAttributeLabel('monto_proyecto_anio_anteriores'),
            'value' => $model->bolivarMontos($model->monto_proyecto_anio_anteriores),
        ],
                [
            'label' => $model->getAttributeLabel('monto_total_proyecto_proximo_anios'),
            'value' => $model->bolivarMontos($model->monto_total_proyecto_proximo_anios),
        ],
        [
            'label' => $model->getAttributeLabel('monto_proyecto'),
            'value' => $model->bolivarMonto,
        ],
                [
            'label' => $model->getAttributeLabel('monto_financiar'),
            'value' => $model->bolivarMontos($model->monto_financiar),
        ],
        [
            'label' => $model->getAttributeLabel('sector'),
            'value' => $model->nombreSector,
        ],
        [
            'label' => $model->getAttributeLabel('sub_sector'),
            'value' => $model->nombreSubSector,
        ],
        [
            'label' => $model->getAttributeLabel('plan_operativo'),
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
            'label' => $model->getAttributeLabel('objetivo_general'),
            'value' => ObjetivosGenerales::find()->where(['id'=>$model->objetivo_general])->one()->objetivo_general,
        ],            
        'politicas_ministeriales',
        [
            'label' => $model->getAttributeLabel('ambito'),
            'value' => $model->idAmbito->ambito,
        ]
    ],
]) ?>

<!-- LOCALIZACION -->
<div class="panel panel-default">
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
                    (Yii::$app->user->can('proyecto-localizacion/create', ['id' => $model->id]))
                    
                    ?
                    
                    Html::a($icons['crear'].' Agregar', ['proyecto-localizacion/create', 'proyecto' => $model->id, 'ambito' => $model->ambito],
                        ['role'=>'modal-remote','title'=> 'Agregar','class'=>'btn btn-default']).
                        Html::a($icons['recargar'].' Refrescar', ['proyecto/view', 'id' => $model->id],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                        '{toggleData}'.
                        '{export}'
                    
                    :

                    Html::a($icons['recargar'].' Refrescar', ['proyecto/view', 'id' => $model->id],
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
                'after'=> (Yii::$app->user->can('proyecto-localizacion/create', ['id' => $model->id]))

                        ?
                            BulkButtonWidget::widget([
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
                            '<div class="clearfix"></div>'
                        :
                        '<div class="clearfix"></div>',
            ]
        ]) ?>          
    </div>
</div>  

<!-- RESPONSABLES -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Responsables</h3>
    </div>
    <div class="panel-body">

        <!-- Responsable -->
        <div id="responsable" data-pjax-container data-pjax-timeout="1000">
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->responsable,
                'url' => 'proyecto-responsable',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable Gerente',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono'
                ]
            ]) ?>
        </div>

        <!-- Responsable Administrativo -->
        <div id="administrativo" data-pjax-container data-pjax-timeout="1000">
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
                    [
                        'label' => 'Unidad Técnica',
                        'value' => $model->responsableAdministrativo ? ($model->responsableAdministrativo->idUEjecutora->nombre) : ''
                    ],
              
                ]
            ]) ?>
        </div>

        <!-- Responsable Tecnico -->
        <div id="tecnico" data-pjax-container data-pjax-timeout="1000">
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
                    [
                        'label' => 'Unidad Técnica',
                        'value' => $model->responsableTecnico ? $model->responsableTecnico->idUEjecutora->nombre : ''
                    ],
                ]
            ]) ?>
        </div>

        <!-- Registrador -->
        <div id="registrador" data-pjax-container data-pjax-timeout="1000">
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->registrador,
                'url' => 'proyecto-registrador',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable Registrador',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono',
                    [
                        'label' => 'Unidad Técnica',
                        'value' => $model->registrador ? $model->registrador->idUEjecutora->nombre : ''
                    ],
                ]
            ]) ?>
        </div>

    </div>
</div>