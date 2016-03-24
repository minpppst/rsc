<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadEjecutora */

$this->title = 'Importar Acciones Especificas';
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['site/configuracion']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
    'importar' => '<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
];

?>
<div class="accion-especifica-importar">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php if (Yii::$app->session->hasFlash('importado')): ?>

        <?= Yii::$app->session->getFlash('importado') ?>

    <?php endif; ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    
    <?= Html::hiddenInput('accion_central',$accion_central)?>

    <?= $form->field($modelo, 'importFile')->widget(FileInput::classname(),[
	    	'options' => [
	    		'multiple' => false,
	    		'accept' => 'text/csv'
	    	],
	    	'pluginOptions' => [
	    		'showUpload' => false
	    	]
	    ]) 
	?>

    <div class="form-group">
    	<?= Html::a($icons['volver'].' Volver', ['accion-centralizada/view', 'id'=>$accion_central], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($icons['importar'].' Importar', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end() ?>

</div>
