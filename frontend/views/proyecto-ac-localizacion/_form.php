<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProyectoAcLocalizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-ac-localizacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_proyecto_ac')->textInput() ?>

    <?= $form->field($model, 'id_pais')->textInput() ?>

    <?= $form->field($model, 'id_estado')->textInput() ?>

    <?= $form->field($model, 'id_municipio')->textInput() ?>

    <?= $form->field($model, 'id_parroquia')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
