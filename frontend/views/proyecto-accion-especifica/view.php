<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */
?>
<div class="proyecto-accion-especifica-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'id_proyecto',
            'codigo_accion_especifica',
            'nombre:ntext',
            'nombreUnidadEjecutora',
        ],
    ]) ?>

</div>
