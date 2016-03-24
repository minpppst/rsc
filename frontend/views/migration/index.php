<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = 'Migraciones';
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['site/configuracion']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="list-group">
    <?= ListView::widget([
    	'dataProvider' => $dataProvider,
    	'itemView' => '_migrations'
    ]) ?>
</div>

<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['site/configuracion'], ['class' => 'btn btn-primary']) ?>
</div>
