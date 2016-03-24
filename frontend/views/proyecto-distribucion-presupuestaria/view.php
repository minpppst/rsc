<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoDistribucionPresupuestaria */
?>
<div class="proyecto-distribucion-presupuestaria-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_accion_especifica',
            'id_partida',
            'cantidad',
        ],
    ]) ?>

</div>
