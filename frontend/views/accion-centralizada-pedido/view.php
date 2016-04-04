<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
?>
<div class="proyecto-pedido-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombreMaterial',
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre',
            'precioBolivar',
            'fecha_creacion',
            'asignado',
            'nombreEstatus',
        ],
    ]) ?>

</div>
