<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableProgramacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-variable-programacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_localizacion')->textInput() ?>

    <?= $form->field($model, 'enero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'febrero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marzo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abril')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mayo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'junio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'julio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agosto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'septiembre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'octubre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noviembre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diciembre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput() ?>

    <?= $form->field($model, 'fecha_eliminacion')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
