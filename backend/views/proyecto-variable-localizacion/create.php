<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableLocalizacion */

?>
<div class="proyecto-variable-localizacion-create">
    <?= $this->render('_form', [
        'model' => $model,
        'pais' => $pais,
        'estados' => $estados,
        'municipios' => $municipios,
        'parroquias' => $parroquias,
        'model1' => $model1,
    ]) ?>
</div>
