<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAsignar */
?>
<div class="proyecto-asignar-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',            
            'nombreProyecto',
            'nombreEspecifica',
            'nombreEstatus'
        ],
    ]) ?>

</div>
