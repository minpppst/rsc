<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ObjetivosNacionales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetivos-nacionales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'objetivo_nacional')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objetivo_historico')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
