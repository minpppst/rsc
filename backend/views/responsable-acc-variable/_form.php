<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResponsableAccVariable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responsable-acc-variable-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
    
        <div class="panel-heading">
             <span>Responsable De Variable</span>
        </div>
        
        <div class="panel-body">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'cedula')->textInput() ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'oficina')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'id_variable')->hiddenInput()->label(false) ?>

            <?php if (!Yii::$app->request->isAjax){ ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php } ?>

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
