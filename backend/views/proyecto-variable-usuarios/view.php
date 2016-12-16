<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableUsuarios */
?>
<div class="proyecto-variable-usuarios-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_variable',
            'id_usuario',
            'estatus',
            'fecha_creacion',
            'fecha_eliminacion',
        ],
    ]) ?>

</div>
