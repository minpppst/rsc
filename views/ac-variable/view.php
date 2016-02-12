<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AcVariable */
?>
<div class="ac-variable-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_u_ej',
            'nombre_variable',
        ],
    ]) ?>

</div>
