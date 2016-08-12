
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AcAcEspec */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ac-ac-espec-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ac_centr')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'cod_ac_espe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textarea(['rows' => 6]) ?>

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

<?php if (!Yii::$app->request->isAjax){ ?>
	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
	

<?=
  $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->fecha_inicio,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy/mm/dd',
            'todayBtn' => true
          ]
          ]); 
?>

  <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->fecha_fin,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy/mm/dd',
            'todayBtn' => true
          ]
          ]); 

?>

<?php ActiveForm::end(); ?>
    
</div>
