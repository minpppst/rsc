<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResponsableAccVariable */

$this->title = 'Update Responsable Acc Variable: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Responsable Acc Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="responsable-acc-variable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
