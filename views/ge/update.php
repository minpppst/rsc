<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ge */
?>
<div class="ge-update">

    <?= $this->render('_form', [
        'model' => $model,
        'partida' => $partida,
        'estatus' => $estatus
    ]) ?>

</div>
