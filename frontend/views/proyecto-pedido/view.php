<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
?>
<div class="proyecto-pedido-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombreMaterial',
            'precioBolivar',
            'iva',
            'trimestre1',
            'trimestre2',
            'trimestre3',
            'trimestre4',
            'totalTrimestre',
            'subTotal',
            'ivaTotal',
            'total',
            'fecha_creacion',
            'nombreEstatus',
        ],
    ]) ?>

</div>
