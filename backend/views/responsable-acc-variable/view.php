<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResponsableAccVariable */

$this->title = 'Detalle Responsable #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Responsable  Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsable-acc-variable-view">

    <h3><?= Html::encode($this->title) ?></h3>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nombre',
            'cedula',
            'email:email',
            'telefono',
            [
                'attribute' => 'oficina',
                'value' => $model->idUnidadEjecutora->nombre,
            ],
            //'id_variable',
        ],
    ]) ?>

</div>
