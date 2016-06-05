<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariables */

$this->title = 'Crear Variables';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variables-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
