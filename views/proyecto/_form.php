<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_proyecto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_sne')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus_proyecto')->dropDownList(ArrayHelper::map($estatus_proyecto,'id','estatus'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'situacion_presupuestaria')->dropDownList(ArrayHelper::map($situacion_presupuestaria,'id','situacion'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'monto_proyecto')->input('number') ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'clasificacion_sector')->dropDownList(ArrayHelper::map($sector,'id','sector'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'sub_sector')->dropDownList(ArrayHelper::map($sub_sector,'id','sub_sector'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'plan_operativo')->dropDownList(ArrayHelper::map($plan_operativo,'id','plan_operativo'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'objetivo_general')->hiddenInput() ?>

    <div class="form-group">
        <?= AutoComplete::widget([
                'model' => $model,
                'name' => 'general',
                'options'=> [
                    'class' => 'form-control',
                ],
                'clientOptions' => [                
                    'source' => $objetivo_general,
                    'autoFill' => true,
                    'select' => new JsExpression("function(event, ui) {
                        $('#proyecto-objetivo_general').val(ui.item.id);
                    }"),
                ],
            ])
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
