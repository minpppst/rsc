<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosNacionales */

$this->title = 'Create Objetivos Nacionales';
$this->params['breadcrumbs'][] = ['label' => 'Objetivos Nacionales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetivos-nacionales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
