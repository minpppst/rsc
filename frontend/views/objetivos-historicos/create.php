<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosHistoricos */

$this->title = 'Create Objetivos Historicos';
$this->params['breadcrumbs'][] = ['label' => 'Objetivos Historicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetivos-historicos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
