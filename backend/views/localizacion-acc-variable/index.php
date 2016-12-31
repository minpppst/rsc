<?php

use yii\helpers\Html;
use yii\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalizacionAccVariableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Localizacion Acc Variables';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="localizacion-acc-variable-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Localizacion Acc Variable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_variable',
            'id_pais',
            'id_estado',
            'id_municipio',
            // 'id_parroquia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
