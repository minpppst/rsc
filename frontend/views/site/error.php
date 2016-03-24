<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El error ocurrió mientras el servidor Web intentaba procesar su solicitud.
    </p>
    <p>
        Por favor contactenos si piensa que se trata de un error del servidor. Gracias.
    </p>

</div>
