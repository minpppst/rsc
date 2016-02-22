<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Se */
/* @var $form yii\widgets\ActiveForm */
DepDropAsset::register($this);
?>

<div class="se-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Partida</label>
        <?= Html::dropDownList('partida','',ArrayHelper::map($partida,'id','partida'),[
            'class' => 'form-control',
            'prompt' => 'Seleccione',
            'id' => 'partidas'
        ]) ?>
    </div>

    <div class="form-group">
        <label>GE</label>
        <?= Html::dropDownList('ge','',[],[
            'prompt' => 'Seleccione',
            'class' => 'form-control',
            'id' => 'ge'
        ]) ?>
    </div>

    <div class="form-group">
        <label>GE</label>
        <?= Html::dropDownList('es','',[],[
            'prompt' => 'Seleccione',
            'class' => 'form-control',
            'id' => 'es'
        ]) ?>
    </div>

    <?= $form->field($model, 'codigo_se')->textInput(['prompt' => 'Seleccione','placeholder' => 'Ingrese un número entre 00 y 99']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->dropdownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
    /* Listas desplegables dependientes */
    $(document).ready(function(){
        //GE
        $("#ge").depdrop({
            depends: ['partidas'],
            url: "<?= Url::to(['ge']) ?>"
        });
        //ES
        $("#es").depdrop({
            depends: ['ge'],
            url: "<?= Url::to(['es']) ?>"
        });
    });
</script>