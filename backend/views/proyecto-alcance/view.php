<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\detail\DetailView;

use common\models\UnidadMedida;
use common\models\TipoImpacto;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAlcance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Alcances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'
];

?>
<div class="proyecto-alcance-view">
    
    <?= DetailView::widget([
        'model' => $model,
        'mode' => 'view',
        'fadeDelay' => 0,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'id' => 'alcance',
        'deleteOptions'=>[ // your ajax delete parameters
            'params' => ['id' => $model->id, 'kvdelete'=>true],
        ],
        'attributes' => [
            [
                'attribute' => 'relacion_instituciones',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'empleos_directos_nuevos_femeninos',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'empleos_directos_nuevos_masculino',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'empleos_directos_sostenidos_femeninos',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'empleos_directos_sostenidos_masculino',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'beneficiarios_masculinos',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'beneficiarios_femeninos',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'beneficiarios',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'objetivo_estrategico_institucional',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'objetivo_especifico_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'causas_criticas_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'problemas_aborda_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'consecuencias_problema',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'justificacion_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'alcance_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'descripcion_situacion_actual',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'formula_indicador',
                'type' => DetailView::INPUT_TEXT,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'fuente_indicador',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'label' => $model->getAttributeLabel('fecha_ultima_data'),
                'attribute' => 'fecha_ultima_data',
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
                'attribute' => 'situacion_objetivo',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'meta_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'tiempo_impacto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'servicio_bien',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'unidad_medida',
                'value' => $model->unidadMedida->unidad_medida,
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map(unidadMedida::find()->all(), 'id', 'unidad_medida'),
                    'options' => ['placeholder' => 'Seleccione'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
                ]

            ],
            [
                'attribute' => 'tipo_impacto',
                'value' => $model->tipoImpacto->descripcion,
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map(TipoImpacto::find()->all(), 'id', 'descripcion'),
                    'options' => ['placeholder' => 'Seleccione'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
                ]
            ],
            [
                'attribute' => 'cualitativa_efectos',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'importancia',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'mitigar_impacto_ambiental',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'balance_servicio_energetico',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'programacion_anual_consumidor',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],

        ],
        'panel' => [
            'type' => 'primary', 
            'heading' => '<i class="fa fa-list"></i> Alcance e Impacto',
        ],
    ]) ?>

</div>
