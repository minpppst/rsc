<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_partida')->textInput() ?>

    <?= $form->field($model, 'codigo_ge')->textInput() ?>

    <?= $form->field($model, 'nombre_ge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
