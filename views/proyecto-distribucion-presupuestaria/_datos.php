<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<tr>
	<td><?= $accionEspecifica->nombre ?></td>
<?php foreach($model as $value){ ?>
	<td><?= $value->cantidad ?></td>
<?php } ?>
</tr>