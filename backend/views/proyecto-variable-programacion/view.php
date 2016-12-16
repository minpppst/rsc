<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableProgramacion */
?>
<div class="proyecto-variable-programacion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_localizacion',
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
            'fecha_creacion',
            'fecha_modificacion',
            'fecha_eliminacion',
        ],
    ]) ?>

</div>
