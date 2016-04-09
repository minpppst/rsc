<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoLocalizacion */

$this->title = 'Localización';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_proyecto, 'url' => ['proyecto/view', 'id' => $model->id_proyecto]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="proyecto-localizacion-update">

	<?php if (!Yii::$app->request->isAjax){ ?>
    	<h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
        'paises' => $paises,
        'estados' => $estados,
        'municipios' => $municipios,
        'parroquias' => $parroquias,
    ]) ?>

</div>
