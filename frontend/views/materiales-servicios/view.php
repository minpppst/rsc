<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['site/configuracion']];
$this->params['breadcrumbs'][] = ['label' => 'Materiales y Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
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
<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['materiales-servicios/index'], ['class' => 'btn btn-primary']) ?>        
</div>