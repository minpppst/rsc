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

    <?= $form->field($model, 'proyecto_id')->dropDownList(
        ArrayHelper::map($proyectos,'id','nombre'), 
        ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'proyecto']
    )?>

    <?= $form->field($model, 'accion_especifica_id')->dropDownList([], ['prompt' => 'Seleccione']) ?>    

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
        $("#proyectousuarioasignar-accion_especifica_id").depdrop({
            depends: ['proyecto'],
            url: "<?= Url::to(['pae']) ?>"
        });       
    });
</script>