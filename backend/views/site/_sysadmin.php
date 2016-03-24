<?php

use yii\helpers\Url;

use miloschuman\highcharts\Highcharts;

?>
<div class="form-group">
	<div class="col-xs-6 col-md-5">
		<?= Highcharts::widget([
			'options' => require(__DIR__.'/charts/_actividad.php')
		]) ?>		
	</div>
	<div class="col-xs-6 col-md-5">
		<?= Highcharts::widget([
			'options' => require(__DIR__.'/charts/_otro.php')
		]) ?>
	</div>
</div>