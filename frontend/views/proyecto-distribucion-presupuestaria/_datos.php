<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<tr>
	<?php foreach($model as $key => $value){ ?>

	<?php 
		if($value == array_values($model)[0])
		{
	?>
	<td><?= Html::encode($value->nombreAccionEspecifica) ?></td>
	<?php
		}
	?>	
	<td><?= $value->cantidad ?></td>
	<?php } ?>
</tr>