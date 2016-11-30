<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PlanOperativo */
?>
<div class="plan-operativo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'plan_operativo',
        ],
    ]) ?>

</div>
