<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AcAcEspec */
?>
<div class="ac-ac-espec-view">

    <?= DetailView::widget([
        'model' => $model,

        'attributes' => [
            
            [
            'attributes' => 'id_ac_centr',
            'label' => 'Nombre de Acción Central',
            'value' => $model->idAcCentr->nombre_accion,
            ],
            'cod_ac_espe',
            'nombre:ntext',
            [
                'label' => 'Estatus',
                'value' => $model->nombreEstatus,
            ],
            
            [
                'label' => $model->getAttributeLabel('fecha_inicio'),
                'value' => \Yii::$app->formatter->asDate($model->fecha_inicio)

            ],

           
            [
                'label' => $model->getAttributeLabel('fecha_fin'),
                'value' => \Yii::$app->formatter->asDate($model->fecha_fin)

            ],

             [
            'label' => 'Unidades Ejecutoras',
            //'value' => (!empty($rows)) ?  $rows : 'NULL' 
            'value' => $rows
            ],
        ],
    ]) ?>

</div>
