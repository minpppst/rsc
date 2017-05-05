<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UnidadMedidaProductos */
?>
<div class="unidad-medida-productos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'unidad_medida',
            'tipo',
            'estatus',
        ],
    ]) ?>

</div>
