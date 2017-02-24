<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserPerfil */
?>
<div class="user-perfil-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombres',
            'apellidos',
            'correo',
            'telefono_oficina',
            'telefono_celular',
        ],
    ]) ?>

</div>
