<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use johnitvn\ajaxcrud\CrudAsset; 
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AcEspUej */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ac-esp-uej-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::hiddenInput('accion_central',$accion_central)?>
    <?= $form->field($model, 'id_ue')->hiddenInput()->label(false); ?>

<div>
    <label class="control-label" for="acespuej-id_ue">Unidad Ejecutora</label>
  <?php  
  // Multiple select without model
  if(empty($precarga))
    $precarga="";
  echo $filterwidget=\kartik\select2\Select2::widget([
        'name' => 'id_ue',
        'value' => $precarga,
        'data' => $unidades_ejecutoras,
        'options' => ['multiple' => true, 'placeholder' => 'Seleccione la Unidad Ejecutora ...', 'id' => 'unique-select23-id']
    ]);
  
?>
</div>
    <?= $form->field($model, 'id_ac_esp')->dropDownList([$accion_especifica=>$model->nombre_accion($accion_especifica)]); ?>
    <?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
