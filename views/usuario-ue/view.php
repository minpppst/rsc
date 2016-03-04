<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioUe */
?>
<div class="usuario-ue-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'usuario',
            'unidad_ejecutora',
        ],
    ]) ?>

</div>
