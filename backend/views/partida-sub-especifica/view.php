<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Se */
?>
<div class="se-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cuenta',
            'partida',
            'generica',
            'especifica',
            'subespecifica',
            'nombre',
            'estatus',
        ],
    ]) ?>

</div>
