<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAlcance */

$this->title = 'Crear Alcance e Impacto';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Alcances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-alcance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'alcanceUnidadMedida' => $alcanceUnidadMedida,
        'instanciaInstitucion' => $instanciaInstitucion,
    ]) ?>

</div>
