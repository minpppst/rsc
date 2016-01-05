<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsableAdministrativo */

$this->title = 'Create Proyecto Responsable Administrativo';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Responsable Administrativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-responsable-administrativo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
