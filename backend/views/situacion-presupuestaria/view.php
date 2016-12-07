<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SituacionPresupuestaria */
?>
<div class="situacion-presupuestaria-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'situacion',
        ],
    ]) ?>

</div>
