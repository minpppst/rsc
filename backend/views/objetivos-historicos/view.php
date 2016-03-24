<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ObjetivosHistoricos */
?>
<div class="objetivos-historicos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'objetivo_historico:ntext',
        ],
    ]) ?>

</div>
