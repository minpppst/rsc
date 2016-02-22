<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_partida')->dropDownList(ArrayHelper::map($partida, 'id','partida'),['prompt' => 'Seleccione']) ?>

    <?= $form->field($model, 'codigo_ge')->textInput(['placeholder' => 'Escriba un número entre 00 y 99', 'maxlength' => 2]) ?>

    <?= $form->field($model, 'nombre_ge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo', 0=>'Inactivo'], ['prompt' => 'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
