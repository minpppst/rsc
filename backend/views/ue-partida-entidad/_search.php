<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UePartidaEntidadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ue-partida-entidad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cuenta') ?>

    <?= $form->field($model, 'partida') ?>

    <?= $form->field($model, 'id_ue') ?>

    <?= $form->field($model, 'id_tipo_entidad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
