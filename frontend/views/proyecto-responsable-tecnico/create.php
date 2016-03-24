<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsableTecnico */

$this->title = 'Create Proyecto Responsable Tecnico';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Responsable Tecnicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-responsable-tecnico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
