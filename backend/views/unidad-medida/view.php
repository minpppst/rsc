<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedida */
?>
<div class="unidad-medida-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'unidad_medida',
        ],
    ]) ?>

</div>
