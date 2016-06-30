<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAsignar */
/* @var $form yii\widgets\ActiveForm */
DepDropAsset::register($this);
?>

<div class="proyecto-asignar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'usuario') ?>

    <div class="form-group">

        <label class="control-label">Proyecto</label>

        <?= Html::dropDownList('proyectos',null,ArrayHelper::map($proyectos,'id','nombre'), ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'proyecto']) ?>
    </div>

    <?= $form->field($model, 'accion_especifica')->dropDownList([], ['prompt' => 'Seleccione']) ?>

    <?= $form->field($model, 'unidad_ejecutora')->dropDownList([], ['prompt' => 'Seleccione']) ?>    

    <?= $form->field($model, 'estatus')->dropDownList([1 => 'Activo', 0 => 'Inactivo'],['prompt' => 'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
    /* Listas desplegables dependientes */
    $(document).ready(function(){

        //Accion Especifica
        $("#proyectoasignar-accion_especifica").depdrop({
            depends: ['proyecto'],
            url: "<?= Url::to(['pae']) ?>"
        });

        //Unidad Ejecutora
        $("#proyectoasignar-unidad_ejecutora").depdrop({
            depends: ['proyectoasignar-accion_especifica'],
            url: "<?= Url::to(['aue']) ?>"
        });        
    });
</script>