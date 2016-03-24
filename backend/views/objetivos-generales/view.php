<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ObjetivosGenerales */
?>
<div class="objetivos-generales-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'objetivo_general:ntext',
            'objetivo_estrategico',
        ],
    ]) ?>

</div>
