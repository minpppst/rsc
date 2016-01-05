<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoResponsableTecnicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto Responsable Tecnicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-responsable-tecnico-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proyecto Responsable Tecnico', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'unidad_tecnica',
            // 'id_proyecto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
