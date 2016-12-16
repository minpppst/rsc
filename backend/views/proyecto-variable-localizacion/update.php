<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableLocalizacion */
?>
<div class="proyecto-variable-localizacion-update">

    <?= $this->render('_form', [
        'model' => $model,
        'pais' => $pais,
        'estados' => $estados,
        'model1' => $model1,
        'municipios' => $municipios,
        'parroquias' => $parroquias,
    ]) ?>

</div>
