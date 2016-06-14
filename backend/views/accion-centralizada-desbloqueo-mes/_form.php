<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaDesbloqueoMes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-centralizada-desbloqueo-mes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ejecucion')->textInput() ?>

    <?= $form->field($model, 'mes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
