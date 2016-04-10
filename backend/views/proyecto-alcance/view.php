<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\detail\DetailView;

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
                'attribute' => 'enunciado_problema',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'poblacion_afectada',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'indicador_situacion',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'formula_indicador',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            'fuente_indicador',
            [
                'label' => $model->getAttributeLabel('fecha_indicador_inicial'),
                'attribute' => 'fecha_indicador_inicial',
                'type' => DetailView::INPUT_DATE,
                'options' => [
                    //'style' => 'width:47%'
                ],
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ],
            ],
            [
                'attribute' => 'enunciado_situacion_deseada',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'poblacion_objetivo',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'indicador_situacion_deseada',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'resultado_esperado',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'label' => 'Unidad de Medida',
                'attribute' => 'unidad_medida',
                'value' => $model->unidadMedida->unidad_medida,
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map($unidadMedida, 'id', 'unidad_medida'),
                    'options' => ['placeholder' => 'Seleccione'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
                ]
            ],
            [
                'attribute' => 'meta_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            'benficiarios_femeninos',
            'beneficiarios_masculinos',
            'denominacion_beneficiario',
            'total_empleos_directos_femeninos',
            'total_empleos_directos_masculino',
            'empleos_directos_nuevos_femeninos',
            'empleos_directos_nuevos_masculino',
            'empleos_directos_sostenidos_femeninos',
            'empleos_directos_sostenidos_masculino',
            [
                'attribute' => 'requiere_accion_no_financiera',
                'value' => $model->requiere_accion_no_financiera,
                'type' => DetailView::INPUT_DROPDOWN_LIST,
                'items' => [1 => 'Si',  0 => 'No'],
            ],
            'especifique_con_cual',
            'requiere_nombre_institucion',
            'requiere_nombre_instancia',
            [
                'attribute' => 'requiere_mencione_acciones',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'contribuye_complementa',
                'value' => $model->contribuye_complementa,
                'type' => DetailView::INPUT_DROPDOWN_LIST,
                'items' => [1 => 'Si',  0 => 'No'],
            ],
            'especifique_complementa_cual',
            'contribuye_nombre_institucion',
            'contribuye_nombre_instancia',
            [
                'attribute' => 'contribuye_mencione_acciones',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'vinculado_otro',
                'value' => $model->vinculado_otro,
                'type' => DetailView::INPUT_DROPDOWN_LIST,
                'items' => [1 => 'Si',  0 => 'No'],
            ],
            'vinculado_especifique',
            'vinculado_nombre_institucion',
            'vinculado_nombre_instancia',
            [
                'attribute' => 'vinculado_nombre_proyecto',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'vinculado_medida',
                'type' => DetailView::INPUT_TEXTAREA,
                'options' => [
                    'rows'=>'3',
                ],
            ],
            [
                'attribute' => 'obstaculos',
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
