<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Es */
?>
<div class="es-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_ge',
            'codigo_es',
            'nombre',
            'estatus',
        ],
    ]) ?>

</div>
