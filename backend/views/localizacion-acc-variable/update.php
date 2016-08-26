<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacionAccVariable */
?>
<?php if (!Yii::$app->request->isAjax){ 
$this->title = 'Planificación De Variable #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Localizacion Acc Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="localizacion-acc-variable-update">

    <h2><?= Html::encode($this->title) ?></h2>
 <?php } ?>
    <?= $this->render('_form', [
        'model' => $model,
        'pais' => $pais,
        'estados' => $estados,
        'model1' => $model1,
    ]) ?>

</div>
