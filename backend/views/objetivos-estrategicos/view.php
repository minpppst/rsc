<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ObjetivosEstrategicos */
?>
<div class="objetivos-estrategicos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'objetivo_estrategico:ntext',
            'objetivo_nacional',
        ],
    ]) ?>

</div>
