<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosHistoricos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objetivos Históricos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'
];

?>
<div class="objetivos-historicos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($icons['editar'].' Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($icons['eliminar'].' Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'objetivo_historico:ntext',
        ],
    ]) ?>

</div>
