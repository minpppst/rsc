<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserPerfil */
?>
<div class="user-perfil-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_user' => $model_user,
    ]) ?>

</div>
