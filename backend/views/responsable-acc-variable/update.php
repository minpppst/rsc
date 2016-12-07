<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResponsableAccVariable */

$this->title = 'Modificar Responsable Variable: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Responsable Acc Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="responsable-acc-variable-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
