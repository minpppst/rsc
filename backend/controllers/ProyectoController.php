<?php

namespace backend\controllers;

//Yii
use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\data\ActiveDataProvider;

//Common models
use common\models\Proyecto;
use common\models\ProyectoSearch;
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
use backend\models\Feedback;

//Backend models
use backend\models\ProyectoPedido;
use backend\models\ProyectoPedidoSearch;

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
        //Formato de las fechas
        $model->fecha_inicio = \Yii::$app->formatter->asDate($model->fecha_inicio);
        $model->fecha_fin = \Yii::$app->formatter->asDate($model->fecha_fin);

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

        //Aquí se guardan los cambios al modelo
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{

            return $this->render('view', [
                'model' => $model,
                'estrategico' => $estrategico,
                'nacional' => $nacional,
                'historico' => $historico,
                'localizacion' => $localizacion,
            ]);
        }

        return $this->render('view', [
            'model' => $model,
            'estrategico' => $estrategico,
            'nacional' => $nacional,
            'historico' => $historico,
            'localizacion' => $localizacion,
        ]);

    }

    /**
     * Distribucion presupuestaria de un proyecto.
     */
    public function actionDistribucion($proyecto)
    {
        $model = $this->findModel($proyecto);

        return $this->render('distribucion',[
            'model' => $model
        ]);
    }

    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new Proyecto();
        //$model->estatus = 1; //Por defecto

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto-localizacion/create', 'proyecto' => $model->id, 'ambito' => $model->ambito]);
        } else {
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
    */
    
    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*
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
    */

    /**
     * Deletes an existing Proyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'true'];    
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
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
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (Proyecto::findAll(json_decode($pks)) as $model) {
            $model->delete();
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'true']; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
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

        if ($model != null && $model->toggleActivo()) {
            return ['forceClose' => true, 'forceReload' => 'true'];
        } else {
            return [
                'title' => 'Ocurrió un error.',
                'content' => '<span class="text-danger">No se pudo realizar la operación. Error desconocido</span>',
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
            return;
        }
    }

    /**
     * Desactiva multiples modelos de Proyecto.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = Proyecto::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->desactivar();
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
     * Activa multiples modelos de Proyecto.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar() {
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
     * Aprobar o desaprobar un proyecto.
     * @param int $id Id del proyecto
     */
    public function actionAprobar($id)
    {
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model != null && $model->toggleAprobado()) {
            return ['forceClose' => true, 'forceReload' => '#aprobar'];
        } else {
            return [
                'title' => 'Ocurrió un error.',
                'content' => '<span class="text-danger">No se pudo realizar la operación. Error desconocido</span>',
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
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

    /**
     * save Feedback model and trigger event notifications.
     * @param integer $id proyecto
     * @return Json Feedbaack
     */
    public function actionFeedback($id)
    {
        // ajax validation
        if (Yii::$app->request->isAjax)
        {
            $data = json_decode($_POST['feedback']);
            //search proyecto  creaction user
            $model_proyecto=Proyecto::findOne($id);
            $model= new Feedback();
            $model->id_usuario=Yii::$app->user->identity->id;
            $model->id_usuario_destino=$model_proyecto->usuario_creacion;
            $model->mensaje=$data->note;
            $model->img=$data->img;
            
            if($model->save())
            {
                $model->trigger(Feedback::EVENT_NUEVO_PEDIDO); //Notificacion
                Yii::$app->response->format = Response::FORMAT_JSON;
                return true;    
            }
            else
            {
                return false;
            }
            
        }
    }

}
