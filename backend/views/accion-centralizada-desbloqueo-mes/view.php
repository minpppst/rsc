<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaDesbloqueoMes */
?>
<div class="accion-centralizada-desbloqueo-mes-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_ejecucion',
            'mes',
        ],
    ]) ?>

</div>
