<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="proyecto-accion-especifica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'id_proyecto'); ?>

    <?= $form->field($model, 'codigo_accion_especifica')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'nombre')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'unidad_medida')->dropDownList(ArrayHelper::map($unidadMedida, 'id', 'unidad_medida'), ['prompt' => 'Seleccione']); ?>

    <?= $form->field($model, 'meta')->textInput(['readonly' => true]); ?>    

    <?= $form->field($model, 'ponderacion')->input('number', [
        'min' => $model->minPonderacion, 
        'max' => $model->maxPonderacion, 
        'step' => 0.1
    ]); ?>

    <?= $form->field($model, 'bien_servicio')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'id_unidad_ejecutora')->dropDownList(ArrayHelper::map($unidadEjecutora,'id','nombre'),['prompt' => 'Seleccione']); ?>

    <?= $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->fecha_inicio,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd/mm/yyyy',
            'todayBtn' => true
        ],
        'options' => ['readonly' => true]
    ]); ?>

    <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->fecha_fin,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd/mm/yyyy',
            'todayBtn' => true
        ],
        'options' => ['readonly' => true]
    ]); ?>

    <?= Html::activeHiddenInput($model, 'ambito'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-map-marker"></i> Ambito</h3>
        </div>
        <div class="panel-body">
            <?php 
                switch ($model2->scenario)
                {
                    case 'Internacional':
                        echo $form->field($model2, 'id_pais')->dropDownList($model2->localizar($model->id_proyecto),['disabled' => true])->label('País'); 
                    break;

                    case 'Nacional':

                        echo $form->field($model2, 'id_pais')->dropDownList($model2->localizar($model->id_proyecto),['disabled' => true])->label('País');
                    break;

                    case 'Estadal':
                        echo $form->field($model2, 'id_pais')->dropDownList($model2->localizar($model->id_proyecto, 'pais'),['disabled' => true])->label('País');

                        echo '<label class="control-label" for="acespuej-id_ue">Estado</label>';

                        echo $filterwidget=\kartik\select2\Select2::widget([
                            'name' => 'id_estado',
                            'value' => isset($id_estado) ? $id_estado : '',
                            'data' => $model2->localizar($model->id_proyecto),
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccione el Estado ...', 'class' => 'form-control']
                            ]);
                    break;

                    case 'Municipal':
                        echo $form->field($model2, 'id_pais')->dropDownList($model2->localizar($model->id_proyecto, 'pais'))->label('País');
                        echo '<label class="control-label" for="acespuej-id_ue">Estado</label>';

                        echo $filterwidget=\kartik\select2\Select2::widget([
                            'name' => 'id_estado',
                            'value' => isset($id_estado) ? $id_estado : '',
                            'data' => $model2->localizar($model->id_proyecto,'estado'),
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccione el Estado ...', 'class' => 'form-control']
                            ]);
                        echo '<label class="control-label" for="acespuej-id_ue">Estado</label>';

                        echo $filterwidget=\kartik\select2\Select2::widget([
                            'name' => 'id_municipio',
                            'value' => isset($id_municipio) ? $id_municipio : '',
                            'data' => $model2->localizar($model->id_proyecto, 'municipio'),
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccione el Municipio ...', 'class' => 'form-control']
                            ]);
                    break;

                    case 'Parroquial':
                        echo $form->field($model2, 'id_pais')->dropDownList($model2->localizar($model->id_proyecto, 'pais'))->label('País');

                        echo '<label class="control-label" for="acespuej-id_ue">Estado</label>';
                        echo $filterwidget=\kartik\select2\Select2::widget([
                            'name' => 'id_estado',
                            'value' => $id_estado,
                            'data' => $model2->localizar($model->id_proyecto,'estado'),
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccione el Estado ...', 'class' => 'form-control']
                            ]);

                        echo '<label class="control-label" for="acespuej-id_ue">Municipio</label>';
                        echo $filterwidget=\kartik\select2\Select2::widget([
                            'name' => 'id_municipio',
                            'value' => $id_municipio,
                            'data' => $model2->localizar($model->id_proyecto, 'municipio'),
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccione el Municipio ...', 'class' => 'form-control']
                            ]);
                        echo '<label class="control-label" for="acespuej-id_ue">Parroquia</label>';
                        echo $filterwidget=\kartik\select2\Select2::widget([
                            'name' => 'id_parroquia',
                            'value' => $id_parroquia,
                            'data' => $model2->localizar($model->id_proyecto, 'parroquia'),
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccione La Parroquia ...', 'class' => 'form-control']
                            ]);
                    break;

                }
            ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script>
$(document).ready(function(){
    //Evitar input del usuario por teclado en campo ponderacion
    $('#proyectoaccionespecifica-ponderacion').keypress(function(key) {
        $(this).next().text('Utilice los botones o flechas.');
        $('.field-proyectoaccionespecifica-ponderacion').addClass('has-error');
        return false;
    });
});
</script>