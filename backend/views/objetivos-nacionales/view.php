<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ObjetivosNacionales */
?>
<div class="objetivos-nacionales-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'objetivo_nacional:ntext',
            'objetivo_historico',
        ],
    ]) ?>

</div>
