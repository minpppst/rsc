<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcAcEspec */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ac-ac-espec-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ac_centr')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'cod_ac_espe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
