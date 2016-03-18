<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use kartik\select2\Select2Asset;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
/* @var $form yii\widgets\ActiveForm */

Select2Asset::register($this);

?>

<div class="proyecto-pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">

        <label>Material</label>

        <?= Select2::widget([
            'model' => $model,
            'theme' => Select2::THEME_KRAJEE,
            'name' => 'material',
            'attribute' => 'id_material',
            'data' => ArrayHelper::map($materiales,'id','nombre'),
            'options' => [
                'placeholder' => 'Escriba para buscar un material o servicio',
                'id'=>'material'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'addon' => [
                'prepend' => [
                    'content' => '<span class="glyphicon glyphicon-cutlery"></span>'
                ]
            ]
        ])?>

    </div>

    <table class="table table-bordered table-condensed table-striped">
        <tbody>
            <tr class="warning">
                <td><label>TRIM I</label></td>

                <td><?= $form->field($model, 'enero')->input('number', ['placeholder' => '0']) ?></td>

                <td><?= $form->field($model, 'febrero')->input('number', ['placeholder' => '0']) ?></td>

                <td><?= $form->field($model, 'marzo')->input('number', ['placeholder' => '0']) ?></td>
            </tr>
            <tr class="info">
                <td><label>TRIM II</label></td>

                <td><?= $form->field($model, 'abril')->input('number', ['placeholder' => '0']) ?></td>                           

                <td><?= $form->field($model, 'mayo')->input('number', ['placeholder' => '0']) ?></td>

                <td><?= $form->field($model, 'junio')->input('number', ['placeholder' => '0']) ?></td>
            </tr>
            <tr class="danger">
                <td><label>TRIM III</label></td> 

                <td><?= $form->field($model, 'julio')->input('number', ['placeholder' => '0']) ?></td>

                <td><?= $form->field($model, 'agosto')->input('number', ['placeholder' => '0']) ?></td>

                <td><?= $form->field($model, 'septiembre')->input('number', ['placeholder' => '0']) ?></td>
            </tr>
            <tr class="success">
                <td><label>TRIM IV</label></td>

                <td><?= $form->field($model, 'octubre')->input('number', ['placeholder' => '0']) ?></td>

                <td><?= $form->field($model, 'noviembre')->input('number', ['placeholder' => '0']) ?></td>

                <td><?= $form->field($model, 'diciembre')->input('number', ['placeholder' => '0']) ?></td>
            </tr>
        </tbody>
    </table>

    <?= $form->field($model, 'precio', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">Bs.</span>{input}</div>',
    ])->input('number', ['maxlength' => true, 'placeholder' => '0']) ?>

    <?= Html::activeHiddenInput($model, 'asignado') ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>