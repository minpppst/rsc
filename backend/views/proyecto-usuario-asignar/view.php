<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAsignar */
?>
<div class="proyecto-asignar-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'usuario',
            'proyectoEspecifica.nombre',
            'proyectoEspecifica.idUnidadEjecutora.nombre',
            'nombreEstatus'
        ],
    ]) ?>

</div>
