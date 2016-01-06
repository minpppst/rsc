<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\ProyectoResponsableAdministrativo;
use app\models\ProyectoResponsableAdministrativoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProyectoResponsableAdministrativoController implements the CRUD actions for ProyectoResponsableAdministrativo model.
 */
class ProyectoResponsableAdministrativoController extends Controller
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
     * Lists all ProyectoResponsableAdministrativo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoResponsableAdministrativoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProyectoResponsableAdministrativo model.
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
     * Creates a new ProyectoResponsableAdministrativo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($proyecto)
    {
        $model = new ProyectoResponsableAdministrativo();
        $model->id_proyecto = $proyecto;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto-registrador/create', 'proyecto' => $model->id_proyecto]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateAlt($proyecto)
    {
        $model = new ProyectoResponsableAdministrativo();
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
     * Updates an existing ProyectoResponsableAdministrativo model.
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
     * Deletes an existing ProyectoResponsableAdministrativo model.
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
     * Finds the ProyectoResponsableAdministrativo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoResponsableAdministrativo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoResponsableAdministrativo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
