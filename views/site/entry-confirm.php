<?php
	use yii\helpers\Html;
?>
<p>Ha ingresado la siguiente información:</p>

<ul>
	<li><label>Nombre:</label><?= Html::encode($model->name) ?></li>
	<li><label>Email:</label><?= Html::encode($model->email) ?></li>
</ul>