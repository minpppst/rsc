<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacionAccVariable */

$this->title = 'Update Localizacion Acc Variable: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Localizacion Acc Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="localizacion-acc-variable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pais' => $pais,
        'estados' => $estados,
        'model1' => $model1,
    ]) ?>

</div>
