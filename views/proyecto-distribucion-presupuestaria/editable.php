<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = 'Distribución Presupuestaria';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $proyecto, 'url' => ['proyecto/view', 'id' => $proyecto]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div>
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="panel panel-default">
		<!-- Default panel contents -->		
		<div class="panel-body">
			<table class="table">
				<thead>
					<tr>
						<th></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>