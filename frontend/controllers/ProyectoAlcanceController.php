<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use common\models\ProyectoAlcance;
use common\models\ProyectoAlcanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\UnidadMedida;
use common\models\InstanciaInstitucion;

/**
 * ProyectoAlcanceController implements the CRUD actions for ProyectoAlcance model.
 */
class ProyectoAlcanceController extends Controller
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
     * Lists all ProyectoAlcance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoAlcanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProyectoAlcance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $html = $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);

        return Json::encode($html);
    }

    /**
     * Creates a new ProyectoAlcance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($proyecto)
    {
        $model = new ProyectoAlcance();
        $model->id_proyecto = $proyecto;

        //Listas desplegables
        $unidadMedida = UnidadMedida::find()->all();
        $instanciaInstitucion = InstanciaInstitucion::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto/view', 'id' => $model->id_proyecto]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'unidadMedida' => $unidadMedida,
                'instanciaInstitucion' => $instanciaInstitucion,
            ]);
        }
    }

    /**
     * Updates an existing ProyectoAlcance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //Listas desplegables
        $unidadMedida = UnidadMedida::find()->all();
        $instanciaInstitucion = InstanciaInstitucion::find()->all();
        //Formato de las fechas
        $model->fecha_indicador_inicial = \Yii::$app->formatter->asDate($model->fecha_indicador_inicial);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto/view', 'id' => $model->id_proyecto]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'unidadMedida' => $unidadMedida,
                'instanciaInstitucion' => $instanciaInstitucion,
            ]);
        }
    }

    /**
     * Deletes an existing ProyectoAlcance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProyectoAlcance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoAlcance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoAlcance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
