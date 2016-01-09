<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\ProyectoRegistrador;
use app\models\ProyectoRegistradorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProyectoRegistradorController implements the CRUD actions for ProyectoRegistrador model.
 */
class ProyectoRegistradorController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule,$action)
                        {
                            $controller = Yii::$app->controller->id;
                            $action = Yii:: $app->controller->action->id;                    
                            $route = "$controller/$action";
                            if(\Yii::$app->user->can($route))
                            {
                                return true;
                            }
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ProyectoRegistrador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoRegistradorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProyectoRegistrador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProyectoRegistrador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($proyecto)
    {
        $model = new ProyectoRegistrador();
        $model->id_proyecto = $proyecto;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto/view', 'id' => $model->id_proyecto]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateAlt($proyecto)
    {
        $model = new ProyectoRegistrador();
        $model->id_proyecto = $proyecto;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto/view', 'id' => $model->id_proyecto]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProyectoRegistrador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto/view', 'id' => $model->id_proyecto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProyectoRegistrador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $proyecto = $model->id_proyecto;
        $model->delete();

        return $this->redirect(['proyecto/view', 'id' => $proyecto]);
    }

    /**
     * Finds the ProyectoRegistrador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoRegistrador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoRegistrador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
