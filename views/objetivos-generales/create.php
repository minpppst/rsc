<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosGenerales */

$this->title = 'Create Objetivos Generales';
$this->params['breadcrumbs'][] = ['label' => 'Objetivos Generales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetivos-generales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
