<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ge */

?>
<div class="ge-create">
    <?= $this->render('_form', [
        'model' => $model,
        'partida' => $partida,
        'estatus' => $estatus
    ]) ?>
</div>
