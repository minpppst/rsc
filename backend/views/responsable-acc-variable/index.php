<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ResponsableAccVariableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Responsable Acc Variables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsable-acc-variable-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Responsable Acc Variable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'cedula',
            'email:email',
            'telefono',
            [
                'attribute' => 'oficina',
                'value' => $model->idUnidadEjecutora->nombre,
            ],
            // 'id_variable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
