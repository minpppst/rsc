<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoLocalizacion */
?>
<div class="proyecto-localizacion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_proyecto',
            'id_estado',
            'id_municipio',
            'id_parroquia',
        ],
    ]) ?>

</div>
