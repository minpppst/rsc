<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProyectoAcLocalizacion */
?>
<div class="proyecto-ac-localizacion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_proyecto_ac',
            'id_pais',
            'id_estado',
            'id_municipio',
            'id_parroquia',
        ],
    ]) ?>

</div>
