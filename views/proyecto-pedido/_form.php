<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use kartik\select2\Select2Asset;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="proyecto-pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
         <?= Select2::widget([
            'model' => $model,
            'name' => 'material',
            'attribute' => 'id_material',
            'data' => $materiales,
            'options' => ['placeholder' => 'Escriba para buscar'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>
    </div>

    <?= $form->field($model, 'enero')->input('number') ?>

    <?= $form->field($model, 'febrero')->input('number') ?>

    <?= $form->field($model, 'marzo')->input('number') ?>

    <?= $form->field($model, 'abril')->input('number') ?>

    <?= $form->field($model, 'mayo')->input('number') ?>

    <?= $form->field($model, 'junio')->input('number') ?>

    <?= $form->field($model, 'julio')->input('number') ?>

    <?= $form->field($model, 'agosto')->input('number') ?>

    <?= $form->field($model, 'septiembre')->input('number') ?>

    <?= $form->field($model, 'octubre')->input('number') ?>

    <?= $form->field($model, 'noviembre')->input('number') ?>

    <?= $form->field($model, 'diciembre')->input('number') ?>

    <?= $form->field($model, 'precio')->input('number',['maxlength' => true]) ?>

    <?= $form->field($model, 'asignado')->textInput() ?>

    <?= $form->field($model, 'estatus')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>