<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariablesUsuarios */
?>
<div class="accion-centralizada-variables-usuarios-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_variable',
            'id_usuario',
            'estatus',
        ],
    ]) ?>

</div>
