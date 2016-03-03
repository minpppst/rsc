<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */

$this->title = 'Crear Material o Servicio';
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['site/configuracion']];
$this->params['breadcrumbs'][] = ['label' => 'Materiales y Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiales-servicios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sub_especfica' => $sub_especfica,
        'unidad_medida' => $unidad_medida,
        'presentacion' => $presentacion
    ]) ?>

</div>
