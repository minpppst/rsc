<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcVariable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ac-variable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_u_ej')->textInput() ?>

    <?= $form->field($model, 'nombre_variable')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
