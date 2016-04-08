<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use kartik\grid\GridView;
use kartik\detail\DetailView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

use common\models\EstatusProyecto;
use common\models\SituacionPresupuestaria;
use common\models\Sector;
use common\models\SubSector;
use common\models\PlanOperativo;
use common\models\ObjetivosHistoricos;
use common\models\ObjetivosNacionales;
use common\models\ObjetivosEstrategicos;
use common\models\ObjetivosGenerales;
use common\models\Ambito;

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'recargar' => '<span class="glyphicon glyphicon-repeat"></span>'
];

CrudAsset::register($this);

?>

<!-- Widget con los datos -->
<?= DetailView::widget([
    'model' => $model,
    'mode' => 'view',
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'kvdelete'=>true],
    ],
    'attributes' => [
        'id',
        'codigo_proyecto',
        'codigo_sne',
        [
            'attribute' => 'nombre',
            'type' => DetailView::INPUT_TEXTAREA,
            'options' => [
                'rows'=>'6',
                'style' => 'width:50%'
            ],
        ],
        [
            'label' => $model->getAttributeLabel('fecha_inicio'),
            'attribute' => 'fecha_inicio',
            'type' => DetailView::INPUT_DATE,
            'options' => [
                'style' => 'width:47%'
            ],
            'widgetOptions' => [
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy'
                ]
            ],

        ],
        [
            'label' => $model->getAttributeLabel('fecha_fin'),
            'attribute' => 'fecha_fin',
            'type' => DetailView::INPUT_DATE,
            'options' => [
                'style' => 'width:47%'
            ],
            'widgetOptions' => [
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy'
                ]
            ],

        ],
        [
            'label' => $model->getAttributeLabel('estatus_proyecto'),
            'attribute' => 'estatus_proyecto',
            'value' => $model->nombreEstatusProyecto,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(EstatusProyecto::find()->all(), 'id', 'estatus'),
                'options' => ['placeholder' => 'Seleccione'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
            ]
        ],
        [
            'label' => $model->getAttributeLabel('situacion_presupuestaria'),
            'attribute' => 'situacion_presupuestaria',
            'value' => SituacionPresupuestaria::find()->where(['id'=>$model->situacion_presupuestaria])->one()->situacion,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(SituacionPresupuestaria::find()->all(), 'id', 'situacion'),
                'options' => ['placeholder' => 'Seleccione'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
            ]
        ],
        [
            'label' => $model->getAttributeLabel('monto_proyecto'),
            'attribute' => 'monto_proyecto',
            'value' => $model->bolivarMonto,
            'type' => DetailView::INPUT_MONEY,
            'widgetOptions' => [
            ]
        ],
        [
            'attribute' => 'descripcion',
            'type' => DetailView::INPUT_TEXTAREA,
            'options' => [
                'rows'=>'6',
                'style' => 'width:50%'
            ],
        ],
        [
            'label' => $model->getAttributeLabel('sector'),
            'attribute' => 'sector',
            'value' => $model->nombreSector,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(Sector::find()->all(), 'id', 'sector'),
                'options' => ['placeholder' => 'Seleccione'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
            ]

        ],
        [
            'label' => $model->getAttributeLabel('sub_sector'),
            'attribute' => 'sub_sector',
            'value' => $model->nombreSubSector,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(SubSector::find()->all(), 'id', 'sub_sector'),
                'options' => ['placeholder' => 'Seleccione'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
            ]

        ],
        [
            'label' => $model->getAttributeLabel('plan_operativo'),
            'attribute' => 'plan_operativo',
            'value' => PlanOperativo::find()->where(['id'=>$model->plan_operativo])->one()->plan_operativo,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(PlanOperativo::find()->all(), 'id', 'plan_operativo'),
                'options' => ['placeholder' => 'Seleccione'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
            ]
        ],
        [
            'label' => 'Objetivo Historico',
            'value' => $historico->objetivo_historico,
            'options' => [
                'style' => 'width:50%'
            ],
        ],
        [
            'label' => 'Objetivo Nacional',
            'value' => $nacional->objetivo_nacional,
            'options' => [
                'style' => 'width:50%'
            ],
        ], 
        [
            'label' => 'Objetivo Estratégico',
            'value' => $estrategico->objetivo_estrategico,
            'options' => [
                'style' => 'width:50%'
            ],
        ],            
        [
            'label' => $model->getAttributeLabel('objetivo_general'),
            'attribute' => 'objetivo_general',
            'value' => ObjetivosGenerales::find()->where(['id'=>$model->objetivo_general])->one()->objetivo_general,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(ObjetivosGenerales::find()->all(), 'id', 'objetivo_general'),
                'options' => ['placeholder' => 'Seleccione'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
            ]
        ],
        [
            'attribute' => 'objetivo_estrategico_institucional',
            'type' => DetailView::INPUT_TEXTAREA,
            'options' => [
                'rows'=>'6',
                'style' => 'width:50%'
            ],
        ],
        [
            'label' => $model->getAttributeLabel('ambito'),
            'attribute' => 'ambito',
            'value' => $model->idAmbito->ambito,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(Ambito::find()->all(), 'id', 'ambito'),
                'options' => ['placeholder' => 'Seleccione'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
            ]
        ]
    ],
    'panel' => [
            'type' => 'primary', 
            'heading' => '<i class="fa fa-list"></i> Datos Básicos',
        ],
]) ?>

<!-- LOCALIZACION -->
<div class="panel panel-info">
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
                    Html::a($icons['crear'].' Agregar', ['proyecto-localizacion/create', 'proyecto' => $model->id, 'ambito' => $model->ambito],
                    ['role'=>'modal-remote','title'=> 'Agregar','class'=>'btn btn-default']).
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

<!-- RESPONSABLES -->
<div class="panel panel-info" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Responsables</h3>
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