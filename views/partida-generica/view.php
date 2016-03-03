<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ge */
?>
<div class="ge-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigoPartida',
            'generica',
            'nombre',
            'nombreEstatus'
        ],
    ]) ?>

</div>
