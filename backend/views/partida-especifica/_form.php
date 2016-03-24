<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Es */
/* @var $form yii\widgets\ActiveForm */
DepDropAsset::register($this);
?>

<div class="es-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Partida</label>
        <?= Html::dropDownList('partida','',ArrayHelper::map($partida,'id','partida'),[
            'class' => 'form-control',
            'prompt' => 'Seleccione',
            'id' => 'partidas'
        ]) ?>
    </div>

    <?= $form->field($model, 'generica')->dropDownList([],['prompt' => 'Seleccione']) ?>

    <?= $form->field($model, 'especifica')->textInput(['placeholder' => 'Escriba un número entre 00 y 99']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
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
        $("#partidaespecifica-generica").depdrop({
            depends: ['partidas'],
            url: "<?= Url::to(['generica']) ?>"
        });
        
    });
</script>