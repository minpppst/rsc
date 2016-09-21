<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */
?>
<div class="feedback-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'id_usuario_destino',
            'mensaje:ntext',
            'img:ntext',
            'date',
        ],
    ]) ?>

</div>
