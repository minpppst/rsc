<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = 'Crear Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model,
        'estatus_proyecto' => $estatus_proyecto,
        'situacion_presupuestaria' => $situacion_presupuestaria
    ]) ?>

</div>
