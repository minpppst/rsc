<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoLocalizacion */
?>
<div class="proyecto-localizacion-update">

    <?= $this->render('_form', [
        'model' => $model,
       	'pais' => $pais,
       	'estados' => $estados,
       	'model1' => $model1,
    ]) ?>

</div>
