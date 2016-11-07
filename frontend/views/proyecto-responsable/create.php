<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsable */

$this->title = 'Responsable Gerente';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['proyecto/view', 'id' => $model->id_proyecto]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-responsable-create">

	<?php if (!Yii::$app->request->isAjax){ ?>
    	<h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
