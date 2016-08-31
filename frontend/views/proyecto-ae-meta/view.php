<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProyectoAeMeta */
?>
<div class="proyecto-ae-meta-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_proyecto_accion_especifica',
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
            'status',
            'fecha_creacion',
        ],
    ]) ?>

</div>
