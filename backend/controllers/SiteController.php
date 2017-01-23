<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

use bedezign\yii2\audit\models\AuditEntry;
use bedezign\yii2\audit\models\AuditEntrySearch;
use bedezign\yii2\audit\models\AuditTrail;
use bedezign\yii2\audit\models\AuditTrailSearch;

/**
 * Site controller
 */
class SiteController extends \common\controllers\BaseController
{
     /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [ 
            'access' => [ 
                'class' => AccessControl::className(), 
                'rules' => [ 
                    [ 
                        'actions' => ['logout','index','error','configuracion'], 
                        'allow' => true, 
                        'roles' => ['@'], //autenticados 
                    ], 
                ], 
            ], 
            'verbs' => [ 
                'class' => VerbFilter::className(), 
                'actions' => [ 
                    'logout' => ['post'], 
                ], 
            ], 
        ]; 
        //return parent::behaviors();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Auditoria
     * @return mixed
     */
    public function actionAudit(){

        $searchModel = new AuditEntrySearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $submodelo = new AuditTrailSearch;
        //$submodelo->unsetAttributes(); // clear any default values
        $submodelo->entry_id = $dataProvider->id; // IMPORTANTE!!!
        if (isset($_GET['Trail'])) {
                $submodelo->attributes = $_GET['Trail'];
        }


        return $this->render('audit', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'submodelo' => $submodelo,
        ]);
   }
}
