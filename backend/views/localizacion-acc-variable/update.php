<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacionAccVariable */
?>

<div class="localizacion-acc-variable-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'pais' => $pais,
        'estados' => $estados,
        'municipios' => $municipios,
        'parroquias' => $parroquias,
        'model1' => $model1,
    ]) ?>

</div>
