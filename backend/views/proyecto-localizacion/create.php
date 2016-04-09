<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoLocalizacion */

?>
<div class="proyecto-localizacion-create">
    <?= $this->render('_form', [
        'model' => $model,
        'paises' => $paises,
        'estados' => $estados,
        'municipios' => $municipios,
        'parroquias' => $parroquias,
        'ambito' => $ambito
    ]) ?>
</div>
