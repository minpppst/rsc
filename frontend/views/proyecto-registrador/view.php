<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoRegistrador */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Registradors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-registrador-view">

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
