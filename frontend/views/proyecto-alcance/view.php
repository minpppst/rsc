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
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'enunciado_problema:ntext',
            'poblacion_afectada:ntext',
            'indicador_situacion:ntext',
            'formula_indicador:ntext',
            'fuente_indicador',
            [
            'label' => $model->getAttributeLabel('fecha_indicador_inicial'),
            'value' => \Yii::$app->formatter->asDate($model->fecha_indicador_inicial)

            ],
            
            'enunciado_situacion_deseada:ntext',
            'poblacion_objetivo:ntext',
            'indicador_situacion_deseada:ntext',
            'resultado_esperado:ntext',
            [
                'label' => 'Unidad de Medida',
                'value' => $model->unidadMedida->unidad_medida,
            ],
            'meta_proyecto:ntext',
            'benficiarios_femeninos',
            'beneficiarios_masculinos',
            'denominacion_beneficiario',
            'total_empleos_directos_femeninos',
            'total_empleos_directos_masculino',
            'empleos_directos_nuevos_femeninos',
            'empleos_directos_nuevos_masculino',
            'empleos_directos_sostenidos_femeninos',
            'empleos_directos_sostenidos_masculino',
            'requiere_accion_no_financiera',
            'especifique_con_cual',
            'requiere_nombre_institucion',
            'requiere_nombre_instancia',
            'requiere_mencione_acciones:ntext',
            'contribuye_complementa',
            'especifique_complementa_cual',
            'contribuye_nombre_institucion',
            'contribuye_nombre_instancia',
            'contribuye_mencione_acciones:ntext',
            'vinculado_otro',
            'vinculado_especifique',
            'vinculado_nombre_institucion',
            'vinculado_nombre_instancia',
            'vinculado_nombre_proyecto:ntext',
            'vinculado_medida:ntext',
            'obstaculos:ntext',
        ],
    ]) ?>

</div>
