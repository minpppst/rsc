<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcEspUej */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ac-esp-uej-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ue')->textInput() ?>

    <?= $form->field($model, 'id_ac_esp')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
