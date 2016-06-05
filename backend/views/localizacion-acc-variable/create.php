<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacionAccVariable */


?>
<div class="localizacion-acc-variable-create">
	<?php if (!Yii::$app->request->isAjax){ 
		$this->title = 'Create Localizacion Acc Variable';
$this->params['breadcrumbs'][] = ['label' => 'Localizacion Acc Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    	<h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>
   <!-- <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'pais' => $pais,
        'estados' => $estados,
        'model1' => $model1,
    ]) ?>

</div>
