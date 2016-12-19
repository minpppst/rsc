<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableDesbloqueoMes */
?>
<div class="proyecto-variable-desbloqueo-mes-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_ejecucion',
            'mes',
            'fecha_creacion',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
