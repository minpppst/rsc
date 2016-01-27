<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAlcance */

$this->title = 'Crear Alcance e Impacto';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_proyecto, 'url' => ['proyecto/view', 'id' => $model->id_proyecto]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-alcance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'unidadMedida' => $unidadMedida,
        'instanciaInstitucion' => $instanciaInstitucion,
    ]) ?>

</div>
