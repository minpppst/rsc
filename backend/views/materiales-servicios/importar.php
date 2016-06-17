<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadEjecutora */

$this->title = 'Importar Materiales y Servicios';

//Iconos
$icons=[
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
    'importar' => '<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
];

?>
<div class="unidad-ejecutora-importar">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php if (Yii::$app->session->hasFlash('importado')): ?>

        <?= Yii::$app->session->getFlash('importado') ?>

    <?php endif; ?>

	<div class="panel panel-default">
		<div class="panel-body">
			<p>
				<i>Se debe utilizar un archivo <strong>CSV</strong> con el siguiente formato:</i>
			</p>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Partida Presupuestaria</th>
						<th>Material o Servicio</th>
						<th>Unidad de Medida</th>
						<th>Presentación</th>
						<th>Precio</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>402010100</td>
						<td>Agua Mineral</td>
						<td>litro</td>
						<td>botella</td>
						<td>350.00</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    
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
        <?= Html::submitButton($icons['importar'].' Importar', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end() ?>

</div>
