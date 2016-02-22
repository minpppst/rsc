<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */

$this->title = 'Crear Materiales o Servicios';
$this->params['breadcrumbs'][] = ['label' => 'Materiales Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="materiales-servicios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'partida_se' => $partida_se
    ]) ?>

</div>