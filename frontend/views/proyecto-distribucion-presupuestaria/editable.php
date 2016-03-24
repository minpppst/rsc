<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

use yii\widgets\ActiveForm;
use kartik\editable\Editable;

$this->title = 'Distribución Presupuestaria';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $proyecto, 'url' => ['proyecto/view', 'id' => $proyecto]];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

?>

<div>
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="panel panel-default">
		<!-- Default panel contents -->		
		<div class="panel-body">
			<table class="table">
				<thead>
					<tr>
						<th>Acción Específica</th>						
						<?php 
		                    foreach($partidas as $partida)
		                    {
		                ?>
		                <th><?= $partida->partida ?></th>
		                <?php
		                    }
		                ?>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($modelos as $modelo) 
						{
					?>
					<tr>
					<?php
							foreach ($modelo as $key => $value)
							{
								if($value == array_values($modelo)[0])
	                    		{
	                    			echo "<td>".$value->nombreAccionEspecifica."</td>";
	                    		}
					?>
						<td>
							<?= Editable::widget([
									'model' => $value,
									'name' => 'cantidad_'.$value->id,
									'asPopover' => true,
									'value' => $value->cantidad,
									'afterInput' =>function($form,$widget){
										echo Html::activeHiddenInput($widget->model, 'id');
									},
									'options' => [
										'class' => 'form-control'
									]
								])
							?>
						</td>
					<?php
							}
					?>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- BOTONES -->
	<p>
	    <?= Html::a($icons['volver'].' Volver', ['proyecto/view', 'id' => $proyecto], ['class' => 'btn btn-primary']) ?>
	</p>
</div>