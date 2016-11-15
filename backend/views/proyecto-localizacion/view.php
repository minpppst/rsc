<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoLocalizacion */
?>
<div class="proyecto-localizacion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombreProyecto',
                'label' => 'Proyecto'
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombreEstado',
                'label' => 'Estado'
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombreMunicipio',
                'label' => 'Municipio'
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombreParroquia',
                'label' => 'Parroquia'
            ],
        ],
    ]) ?>

</div>
