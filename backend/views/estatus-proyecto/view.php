<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EstatusProyecto */
?>
<div class="estatus-proyecto-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'estatus',
        ],
    ]) ?>

</div>
