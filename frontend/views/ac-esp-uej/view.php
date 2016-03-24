<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AcEspUej */
?>
<div class="ac-esp-uej-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_ue',
            [
                'label' => 'Accion Especifica',
                'value' => $model->AcEspUejs->nombre,
            ],
        ],
    ]) ?>

</div>
