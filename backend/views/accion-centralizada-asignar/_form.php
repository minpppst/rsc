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

    <?= $form->field($model, 'usuario')->hiddenInput(['maxlength' => true])->label(false) ?>
    

    
    <label class="control-label">Acción Centralizada</label>
    <?php if(!$model->isNewRecord){ ?>
    <?= Html::dropDownList('accion_centralizada','accion_centralizada',ArrayHelper::map($accion_centralizada,'id','nombre_accion'),
    ['options' => [$accion_especifica[0]->id_ac_centr => ['Selected' => 'seleted']], 'class' => 'form-control', 'id' => 'accion_centralizada'])?>
    <?php } // fin del update Accion Centralizada

    else{ ?>
    <?= Html::dropDownList('accion_centralizada','accion_centralizada',ArrayHelper::map($accion_centralizada,'id','nombre_accion'),
    ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'accion_centralizada'])?>
    <?php
    } // fin del create Accion Centralizada
    ?>


    
    <label class="control-label">Acción Específica</label>
    <?php if(!$model->isNewRecord){ ?>
    <?= Html::dropDownList('accioncentralizadaasignar-accion_especifica','accioncentralizadaasignar-accion_especifica',ArrayHelper::map($accion_especifica,'id','nombre'),
    ['options' => [$model->accion_especifica_ue0->id_ac_esp => ['Selected' => 'seleted']], 'class' => 'form-control', 'id' => 'accioncentralizadaasignar-accion_especifica'])?>
    <?php } // fin del update Accion Especifica
    else{ ?>

    <?= Html::dropDownList('accioncentralizadaasignar-accion_especifica','accioncentralizadaasignar-accion_especifica',ArrayHelper::map($accion_especifica,'id','nombre'),
    ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'accioncentralizadaasignar-accion_especifica'])?>
    <?php 
    } //fin del create Accion Especifica
    ?>

    
    <label class="control-label">Unidad Ejecutora</label>
    <?php if(!$model->isNewRecord){ ?>
    <?= Html::dropDownList('accioncentralizadaasignar-unidad_ejecutora','accioncentralizadaasignar-unidad_ejecutora',ArrayHelper::map($ue,'id','nombre'),
    ['options' => [$model->accion_especifica_ue0->id_ue => ['Selected' => 'seleted']], 'class' => 'form-control', 'id' => 'accioncentralizadaasignar-unidad_ejecutora'], ['onChange' =>'JS: probar();'])?>
    <?php } //fin del update Unidad Ejecutora
    else{ ?>


    <?= Html::dropDownList('accioncentralizadaasignar-unidad_ejecutora','accioncentralizadaasignar-unidad_ejecutora',ArrayHelper::map($ue,'id','nombre'),
    ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'accioncentralizadaasignar-unidad_ejecutora'],
    ['onChange' =>'JS: probar();'])?>
    <?php
    }       //fin del create Unidad Ejecutora
    ?>

    
    <?= $form->field($model, 'estatus')->dropDownList([1 => 'Activo', 0 => 'Inactivo'],['prompt' => 'Seleccione']) ?>
    <?= $form->field($model, 'accion_especifica_ue')->hiddenInput(['maxlength' => true])->label(false) ?>

  
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
        //tomar el id de ac_especifica_ue
        $("#accioncentralizadaasignar-unidad_ejecutora").change(function(){
        $.ajax({
        url: "<?= Url::to(['ace2']) ?>",
        type: 'post',
        dataType: 'json',
        data: {
           id_especifica: $("#accioncentralizadaasignar-accion_especifica").val(),
           id_unidad: $("#accioncentralizadaasignar-unidad_ejecutora").val(),
         },
        success: function (data) {
            if(data!=0){

            $('#accioncentralizadaasignar-accion_especifica_ue').val(data);
            }
            }
            });

        });


        
    });    
        

</script>
