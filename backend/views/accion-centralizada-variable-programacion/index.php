<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccionCentralizadaVariableProgramacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada Variable Programacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variable-programacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Accion Centralizada Variable Programacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_localizacion',
            'enero',
            'febrero',
            'marzo',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
