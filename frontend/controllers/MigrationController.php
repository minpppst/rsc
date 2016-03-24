<?php

namespace frontend\controllers;

use Yii;
use app\models\Migration;
use app\models\MigrationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

class MigrationController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$searchModel = new MigrationSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        	'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    	]);
    }

}
