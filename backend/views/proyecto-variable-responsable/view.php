<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableResponsable */
?>
<div class="proyecto-variable-responsable-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'cedula',
            'email:email',
            'telefono',
            [
                'attribute' => 'oficina',
                'value' => $model->oficina0->nombre,
            ],
        ],
    ]) ?>

</div>
