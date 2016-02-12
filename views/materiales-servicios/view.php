<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */
?>
<div class="materiales-servicios-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_se',
            'nombre',
            'unidad_medida',
            'presentacion',
            'precio',
            'iva',
            'estatus',
        ],
    ]) ?>

</div>
