<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ge */

$this->title = 'Create Ge';
$this->params['breadcrumbs'][] = ['label' => 'Ges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
