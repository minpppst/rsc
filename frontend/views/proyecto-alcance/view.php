<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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

    <?php
    if(Yii::$app->user->can('proyecto-alcance/delete', ['id' => $model->id_proyecto]))
    {
    ?>
        <p>
            <?= Html::a($icons['editar'].' Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a($icons['eliminar'].' Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php }?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'relacion_instituciones',
            'empleos_directos_nuevos_femeninos',
            'empleos_directos_nuevos_masculino',
            'empleos_directos_sostenidos_femeninos',
            'empleos_directos_sostenidos_masculino',
            'beneficiarios_masculinos',
            'beneficiarios_femeninos',
            'beneficiarios',
            'objetivo_estrategico_institucional',
            'objetivo_especifico_proyecto',
            'causas_criticas_proyecto',
            'problemas_aborda_proyecto',
            'consecuencias_problema',
            'justificacion_proyecto',
            'alcance_proyecto',
            'descripcion_situacion_actual',
            'formula_indicador',
            'fuente_indicador',
            'fecha_ultima_data',
            'situacion_objetivo',
            'meta_proyecto',
            'tiempo_impacto',
            'servicio_bien',
            [
                'label' => 'Unidad de Medida',
                'value' => $model->unidadMedida->unidad_medida,
            ],
            [
                'label' => 'Tipo De Impacto Ambiental',
                'value' => $model->tipoImpacto->descripcion,
            ],
            'cualitativa_efectos',
            'importancia',
            'mitigar_impacto_ambiental',
            'balance_servicio_energetico',
            'programacion_anual_consumidor'
        ],
    ]) ?>

</div>
