<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserPerfil */
?>
<div class="user-perfil-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_user',
            'nombres',
            'apellidos',
            'correo',
            'telefono_oficina',
            'telefono_celular',
            'fecha_creacion',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
