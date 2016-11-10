<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsableTecnico */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Responsable Tecnicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-responsable-tecnico-view">

    <?php if (!Yii::$app->request->isAjax){ ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'cedula',
            'email:email',
            'telefono',
            [
                'label' => 'Unidad Técnica',
                'value' => $model->idUEjecutora->nombre
            ],
        ],
    ]) ?>

</div>
