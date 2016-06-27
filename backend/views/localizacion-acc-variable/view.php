<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacionAccVariable */

$this->title = "Programación De Variable #".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Localizacion Acc Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localizacion-acc-variable-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <!--<p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
<table align="center" width="500" border="0"><tr>
    <td align="center">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'nombreVariable',
            'nombrePais',
            'nombreEstado',
            ],
    ]) ?></td>
</tr><tr>
    <td>
     <?= DetailView::widget([
        'model' => $model1,
        'attributes' => [
            'trimestre1',
            'trimestre2',
            'trimestre3',
            'trimestre4',
            'totalTrimestre',
            
        ],
    ]) ?>
</td>
</tr>
</table>

</div>
