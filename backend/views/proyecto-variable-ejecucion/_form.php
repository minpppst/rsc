<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableEjecucion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-variable-ejecucion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_programacion')->textInput() ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'enero')->textInput() ?>

    <?= $form->field($model, 'febrero')->textInput() ?>

    <?= $form->field($model, 'marzo')->textInput() ?>

    <?= $form->field($model, 'abril')->textInput() ?>

    <?= $form->field($model, 'mayo')->textInput() ?>

    <?= $form->field($model, 'junio')->textInput() ?>

    <?= $form->field($model, 'julio')->textInput() ?>

    <?= $form->field($model, 'agosto')->textInput() ?>

    <?= $form->field($model, 'septiembre')->textInput() ?>

    <?= $form->field($model, 'octubre')->textInput() ?>

    <?= $form->field($model, 'noviembre')->textInput() ?>

    <?= $form->field($model, 'diciembre')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
