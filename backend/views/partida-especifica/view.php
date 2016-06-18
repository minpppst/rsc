<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Es */
?>
<div class="es-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cuenta',
            'partida',
            'generica',
            'especifica',
            'nombre',
            'estatus',
        ],
    ]) ?>

</div>
