<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadEjecutora */
?>
<div class="unidad-ejecutora-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigo_ue',
            'nombre:ntext',
        ],
    ]) ?>

</div>
