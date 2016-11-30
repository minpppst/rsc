<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SubSector */
?>
<div class="sub-sector-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sub_sector',
        ],
    ]) ?>

</div>
