<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Presentacion */
?>
<div class="presentacion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
        ],
    ]) ?>

</div>
