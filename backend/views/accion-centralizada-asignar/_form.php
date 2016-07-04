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

<div class="accion-centralizada-asignar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'usuario') ?>

    <label class="control-label">Acción Centralizada</label>
    <?php if(!$model->isNewRecord){ ?>
    <?= Html::dropDownList('accion_centralizada','accion_centralizada',ArrayHelper::map($accion_centralizada,'id','nombre_accion'),
    ['options' => [$accion_especifica[0]->id_ac_centr => ['Selected' => 'seleted']], 'class' => 'form-control', 'id' => 'accion_centralizada'])?>
    <?php }
    else{ ?>
    <?= Html::dropDownList('accion_centralizada','accion_centralizada',ArrayHelper::map($accion_centralizada,'id','nombre_accion'),
    ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'accion_centralizada'])?>
    <?php
    } // fin del else
    ?>
    <?= $form->field($model, 'accion_especifica')->dropDownList(ArrayHelper::map($accion_especifica, 'id', 'nombre'), ['prompt' => 'Seleccione']) ?>

    <!--<?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map($ue,'id','nombre'), ['prompt' => 'Seleccione']) ?>-->
    
    <?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map($ue, 'id', 'name'), ['prompt' => 'Seleccione']) ?>

    
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
        //GE
        $("#accioncentralizadaasignar-accion_especifica").depdrop({
            depends: ['accion_centralizada'],
            url: "<?= Url::to(['ace1']) ?>"
        });

        $("#accioncentralizadaasignar-unidad_ejecutora").depdrop({
            depends: ['accioncentralizadaasignar-accion_especifica'],
            url: "<?= Url::to(['ace']) ?>"
        });
        
    });
</script>