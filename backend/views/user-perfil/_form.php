<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserPerfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-perfil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    if($model->isNewRecord)
    {
        echo $form->field($model, 'nombres')->textInput(['maxlength' => true]);
        echo $form->field($model, 'apellidos')->textInput(['maxlength' => true]);
    }
    else
    {
        echo $form->field($model, 'nombres')->textInput(['maxlength' => true, 'readonly' => 'readonly']); 
        echo $form->field($model, 'apellidos')->textInput(['maxlength' => true, 'readonly' => 'readonly']);
    }
    ?>
    
    <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_oficina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_celular')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model_user, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model_user, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
    
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
