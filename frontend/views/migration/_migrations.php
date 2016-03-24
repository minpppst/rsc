<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="list-group-item">
	<h4 class="list-group-item-heading">
		<label>Versión:</label>
    	<?= HtmlPurifier::process($model->version) ?>
    </h4>
    <label>Fecha:</label>
    <?= HtmlPurifier::process(date('d/m/Y', $model->apply_time)) ?>    
</div>