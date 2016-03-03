<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Partida */
?>
<div class="partida-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'partida',
            'nombre',
            'nombreEstatus'
        ],
    ]) ?>

</div>
