<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosEstrategicos */

$this->title = 'Create Objetivos Estrategicos';
$this->params['breadcrumbs'][] = ['label' => 'Objetivos Estrategicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetivos-estrategicos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
