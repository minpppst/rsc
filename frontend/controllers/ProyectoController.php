<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use common\models\Proyecto;
use common\models\ProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\data\ActiveDataProvider;

use common\models\EstatusProyecto;
use common\models\SituacionPresupuestaria;
use common\models\Sector;
use common\models\SubSector;
use common\models\PlanOperativo;
use common\models\ObjetivosHistoricos;
use common\models\ObjetivosNacionales;
use common\models\ObjetivosEstrategicos;
use common\models\ObjetivosGenerales;
use common\models\Ambito;
use common\models\ProyectoLocalizacion;

/**
 * ProyectoController implements the CRUD actions for Proyecto model.
 */
class ProyectoController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(!Yii::$app->user->can('sysadmin'))
        {
            $dataProvider->query->andWhere(['usuario_creacion'=>Yii::$app->user->identity->id]);    
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        //Objetivos
        $general = ObjetivosGenerales::find()->where(['id'=>$model->objetivo_general])->one();
        $estrategico = $general->objetivoEstrategico;
        $nacional = $estrategico->objetivoNacional;
        $historico = $nacional->objetivoHistorico;

        //Tablas relacionadas
        $localizacion = new ActiveDataProvider([
            'query' => ProyectoLocalizacion::find()->where(['id_proyecto'=>$model->id]),
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);

        return $this->render('view', [
            'model' => $model,
            'estrategico' => $estrategico,
            'nacional' => $nacional,
            'historico' => $historico,
            'localizacion' => $localizacion,
        ]);
    }

    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proyecto();
        //usuario Creacion
        $model->usuario_creacion=Yii::$app->user->identity->id;

        //Datos para listas desplegables
        $estatus_proyecto = EstatusProyecto::find()->all();
        $situacion_presupuestaria = SituacionPresupuestaria::find()->all();
        $sector = Sector::find()->all();
        $sub_sector = SubSector::find()->all();
        $plan_operativo = PlanOperativo::find()->all();
        $objetivo_general = ObjetivosGenerales::find()
                ->select(['objetivo_general as value', 'id as id'])
                ->asArray()
                ->all();
        $ambito = Ambito::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['proyecto-localizacion/create', 'proyecto' => $model->id, 'ambito' => $model->ambito]);
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
                'estatus_proyecto' => $estatus_proyecto,
                'situacion_presupuestaria' => $situacion_presupuestaria,
                'sector' => $sector,
                'sub_sector' => $sub_sector,
                'plan_operativo' => $plan_operativo,
                'objetivo_general' => $objetivo_general,
                'ambito' =>$ambito
            ]);
        }
    }

    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //Formato de las fechas
        $model->fecha_inicio = \Yii::$app->formatter->asDate($model->fecha_inicio);
        $model->fecha_fin = \Yii::$app->formatter->asDate($model->fecha_fin);

        //Listas desplegables y autocompletar
        $estatus_proyecto = EstatusProyecto::find()->all();
        $situacion_presupuestaria = SituacionPresupuestaria::find()->all();
        $sector = Sector::find()->all();
        $sub_sector = SubSector::find()->all();
        $plan_operativo = PlanOperativo::find()->all();
        $objetivo_general = ObjetivosGenerales::find()
                ->select(['objetivo_general as value', 'id as id'])
                ->asArray()
                ->all();
        $ambito = Ambito::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'estatus_proyecto' => $estatus_proyecto,
                'situacion_presupuestaria' => $situacion_presupuestaria,
                'sector' => $sector,
                'sub_sector' => $sub_sector,
                'plan_operativo' => $plan_operativo,
                'objetivo_general' => $objetivo_general,
                'ambito' =>$ambito
            ]);
        }
    }

    /**
     * Deletes an existing Proyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        //antes de eliminar chequeamos si existen acciones especificas, de ser asi no puede eliminar
        $model=$this->findModel($id);
        //si es admin, puede borrar todo el proyecto
        $usuario = \Yii::$app->user;
        if($usuario->can('sysadmin'))
        {
            //metodo del modelo donde se borra todo lo relacionado con el proyecto
            if($model->eliminarTodo())
            {
                if($request->isAjax)
                {
                    /*
                    *   Process for ajax request
                    */
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['forceClose'=>true,'forceReload'=>'true'];    
                }
                else
                {
                    /*
                    *   Process for non-ajax request
                    */
                    return $this->redirect(['index']);
                }
            }
            else
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo "\n<span class='text-danger'>Error Desconocido consulte al administrador.</span>";
                Yii::$app->end();
            }
        }
        else
        {
            if(isset($model->accionesEspecificas) && $model->accionesEspecificas!=null)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo "\n<span class='text-danger'>Este Proyecto Posee Acciones Específicas Asociadas.</span>";
                Yii::$app->end();
            }
            else
            {
                if($this->findModel($id)->delete())
                {
                    if($request->isAjax)
                    {
                        /*
                        *   Process for ajax request
                        */
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return ['forceClose'=>true,'forceReload'=>'true'];
                    }
                    else
                    {
                        /*
                        *   Process for non-ajax request
                        */
                        return $this->redirect(['index']);
                    }
                }
            }
        }
    }

     /**
     * Delete multiple existing Proyecto model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        //si es admin, puede borrar todo el proyecto
        $error=1;
        $usuario = \Yii::$app->user;
        $pks = explode(',',$request->post('pks')); // arreglo o llave primaria
        
        foreach ($pks as $keys)
        {
            $model=$this->findModel($keys);

            if($usuario->can('sysadmin'))
            {
                //metodo del modelo donde se borra todo lo relacionado con el proyecto
                if(!$model->eliminarTodo())
                {
                    $error=0;
                }
                else
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    echo "\n<span class='text-danger'>Error Desconocido consulte al administrador.</span>";
                    Yii::$app->end();
                }
            }
            else
            {
                if(isset($model->accionesEspecificas) && $model->accionesEspecificas!=null)
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    echo "\n<span class='text-danger'>Este Proyecto Posee Acciones Específicas Asociadas.</span>";
                    Yii::$app->end();
                }
                else
                {
                    
                    if(!$model->delete())
                    {
                        $error=0;
                    }
                }
            }

        }
        if($error==1)
        {
            if($request->isAjax)
            {
                /*
                *   Process for ajax request
                */
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['forceClose'=>true,'forceReload'=>'true'];    
            }
            else
            {
                /*
                *   Process for non-ajax request
                */
                return $this->redirect(['index']);
            }
        }
       
    }

    /**
     * Activar o desactivar un modelo
     * @param integer id
     * @return mixed
     */
    public function actionToggleActivo($id) {
        $model = $this->findModel($id);
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model != null && $model->toggleActivo()) 
        {
            
            return ['forceClose' => true, 'forceReload' => 'true'];
        } 
        else 
        {
            return 
            [
                'title' => 'Ocurrió un error.',
                'content' => '<span class="text-danger">No se pudo realizar la operación. Error desconocido</span>',
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
            
        }
    }

    /**
     * Desactiva multiples modelos de PartidaPartida.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar() 
    {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = Proyecto::className();
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {
            $model->desactivar();
        };
        

        if ($request->isAjax) 
        {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => 'true'];
        } 
        else 
        {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Activa multiples modelos de PartidaPartida.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar() 
    {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = Proyecto::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->activar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => 'true'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
