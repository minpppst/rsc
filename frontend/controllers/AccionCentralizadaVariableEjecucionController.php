<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use frontend\models\AccionCentralizadaVariableEjecucion;
use backend\models\AccionCentralizadavariablesUsuarios;
use backend\models\AccionCentralizadaVariables;
use backend\models\LocalizacionAccVariable;
use backend\models\AccionCentralizadaDesbloqueoMes;
use common\models\AccionCentralizadaVariableProgramacion;
use frontend\models\AccionCentralizadaVariableEjecucionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
/**
 * AccionCentralizadaVariableEjecucionController implements the CRUD actions for AccionCentralizadaVariableEjecucion model.
 */
class AccionCentralizadaVariableEjecucionController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
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
     * Lists all AccionCentralizadaVariableEjecucion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionCentralizadaVariableEjecucionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccionCentralizadaVariableEjecucion model.
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
     * Creates a new AccionCentralizadaVariableEjecucion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$id_localizacion)
    {
            
            $desbloqueo=""; $total_cargado=0;

            $model= new AccionCentralizadaVariableEjecucion();
            $model_programacion = AccionCentralizadaVariableProgramacion::find()->where(['id_localizacion' => $id_localizacion])->All();
            $total=$model_programacion[0]['enero']+$model_programacion[0]['febrero']+$model_programacion[0]['marzo']+$model_programacion[0]['abril']+$model_programacion[0]['mayo']+$model_programacion[0]['junio']+$model_programacion[0]['julio']+$model_programacion[0]['agosto']+$model_programacion[0]['septiembre']+$model_programacion[0]['octubre']+$model_programacion[0]['noviembre']+$model_programacion[0]['diciembre'];
            $model_inicial = AccionCentralizadaVariableEjecucion::find()->where(['id_programacion'=> $model_programacion[0]['id']])->asArray()->One();
            
            $model->id_programacion=$model_programacion[0]['id'];
            $model->id_usuario=Yii::$app->user->getId();
            
            $hoy = getdate();
            $fecha=$hoy['year']."/".$hoy['mon']."/".$hoy['mday']." ".$hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds'];
            $model->fecha=$fecha;
            $desbloqueo[0]=0;    

            //verificar campos bloqueado
            if($model_inicial==NULL){
            //primera vez que carga, deberia habilitarse solamente enero
            $desbloqueo[0]=1;

                }else{
                //verificar mes pendiente con la fecha o ultima carga realizada y fecha
                if($model_inicial['diciembre']==NULL && ($hoy['mon']>=12 && $hoy['mday']>=5))
                $desbloqueo[0]=12;
                if($model_inicial['noviembre']==NULL && ($hoy['mon']>=11 && $hoy['mday']>=5))
                $desbloqueo[0]=11;
                if($model_inicial['octubre']==NULL && ($hoy['mon']>=10 && $hoy['mday']>=5))
                $desbloqueo[0]=10;
                if($model_inicial['septiembre']==NULL && ($hoy['mon']>=9 && $hoy['mday']>=5))
                $desbloqueo[0]=9;
                if($model_inicial['agosto']==NULL && ($hoy['mon']>=8 && $hoy['mday']>=5))
                $desbloqueo[0]=8;
                if($model_inicial['julio']==NULL && ($hoy['mon']>=7 && $hoy['mday']>=5))
                $desbloqueo[0]=7;
                if($model_inicial['junio']==NULL && ($hoy['mon']>=6 && $hoy['mday']>=5))
                $desbloqueo[0]=6;
                if($model_inicial['mayo']==NULL && ($hoy['mon']>=5 && $hoy['mday']>=5))
                $desbloqueo[0]=5;
                if($model_inicial['abril']==NULL && ($hoy['mon']>=4 && $hoy['mday']>=5))
                $desbloqueo[0]=4;
                if($model_inicial['marzo']==NULL && ($hoy['mon']>=3 && $hoy['mday']>=5))
                $desbloqueo[0]=3;
                if($model_inicial['febrero']==NULL && ($hoy['mon']>=2 && $hoy['mday']>=5))
                $desbloqueo[0]=2;

                //verificamos si desde el backend se le dio permiso para habilitar campos
                $permisos_espe = AccionCentralizadaDesbloqueoMes::find()->where(['id_ejecucion'=> $model_inicial['id']])->asArray()->All();
                
                if($permisos_espe!=""){

                    foreach ($permisos_espe as $key) {
                        // se cargan los meses que se le dio permiso de carga
                     
                        $desbloqueo[$key['mes']]='1';
                    }
                }

                $model = $this->findModel($model_inicial['id']);
                $total_cargado=$model->enero+$model->febrero+$model->marzo+$model->abril+$model->mayo+$model->junio+$model->julio+$model->agosto+$model->septiembre+$model->octubre+$model->noviembre+$model->diciembre;
                }//fin else modelo con datos


        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'id' => $id, 'id_localizacion' => $id_localizacion]);
        }else {
            return $this->render('create', [
                'model' => $model,
                'model_programacion' => $model_programacion,
                'total' => $total,
                'desbloqueo' => $desbloqueo,
                'total_cargado' => $total_cargado,

            ]);
        }
    }

    /**
     * Updates an existing AccionCentralizadaVariableEjecucion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AccionCentralizadaVariableEjecucion model.
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
    * Muestra el conjunto de variables asignadas al usuario
    **/
    public function actionVariables(){

    
        $model= new AccionCentralizadaVariableEjecucion();
      
       
            return $this->render('variables', [
                'model' => $model->variablesAsignadas(),//provider,
            ]);

    }
    /**
    * Mostrar las localizaciones(regiones) de las variables(de poseerlas)
    **/
    
    public function actionLocalizacion($id){

        $model= new AccionCentralizadaVariableEjecucion();
       
            return $this->render('localizacion', [
                'model' => $model->localizacionVariables($id),
            ]);

    }



    /**
     * Finds the AccionCentralizadaVariableEjecucion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccionCentralizadaVariableEjecucion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccionCentralizadaVariableEjecucion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
