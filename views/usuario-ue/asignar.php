<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioUe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-ue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($formModel, 'usuarioId')?>
    <input type="hidden" name="AssignmentForm[unidadesEjecutoras]" value="">

    <?php
    	foreach ($modelos as $key => $value) {
    		echo 'id:'.$key.' usuario:'.$value->usuario.' unidad:'.$value->unidad_ejecutora;
    		echo '<br>';
    	}
    ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>