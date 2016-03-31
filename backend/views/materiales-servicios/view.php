<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */

$this->title = $model->id;

//Iconos
$icons=[
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>
<div class="materiales-servicios-view">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigoPresupuestario',
            ['label' => 'Partida Sub-Específica', 'value' => $model->idSe->nombre],
            'nombre',
            ['label' => 'Unidad de Medida', 'value' => $model->unidadMedida->unidad_medida],
            'nombrePresentacion',
            'precioBolivar',
            'ivaPorcentaje',
            ['label' => 'Estatus', 'value' => $model->estatus? 'Activo' : 'Inactivo'],
        ],
    ]) ?>

</div>