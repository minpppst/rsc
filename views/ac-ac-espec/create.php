<?php

use yii\helpers\Html;
use johnitvn\ajaxcrud\CrudAsset; 


/* @var $this yii\web\View */
/* @var $model app\models\AcAcEspec */

?>
<div class="ac-ac-espec-create">
    <?= $this->render('_form', [
        'model' => $model, 'unidades_ejecutoras'=>$unidades_ejecutoras,
    ]) ?>
</div>
