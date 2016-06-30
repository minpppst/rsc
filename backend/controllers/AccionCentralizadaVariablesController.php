<?php

namespace backend\controllers;

use Yii;
use backend\models\AccionCentralizadaVariables;
use backend\models\AccionCentralizadaVariablesSearch;
use backend\models\AccionCentralizadaVariablesUsuarios;
use johnitvn\userplus\base\models\UserAccounts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AcAcEspec;
use \yii\web\Response;
use yii\data\ActiveDataProvider;
use backend\models\LocalizacionAccVariable;
use backend\models\ResponsableAccVariable;
use common\models\AccionCentralizadaAsignar;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
/**
 * AccionCentralizadaVariablesController implements the CRUD actions for AccionCentralizadaVariables model.
 */
class AccionCentralizadaVariablesController extends Controller
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
                    'bulk-delete' => ['post'],
                    'bulk-estatusactivo' => ['post'],
                    'bulk-estatusdesactivar' => ['post'],
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
     * Lists all AccionCentralizadaVariables models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionCentralizadaVariablesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccionCentralizadaVariables model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {


         $model = $this->findModel($id);
         $ambito= $model->localizacion;



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{

        //Tablas relacionadas
        $localizacion = new ActiveDataProvider([
            'query' => LocalizacionAccVariable::find()->where(['id_variable'=>$model->id]),
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);



        return $this->render('view', [
            'model' => $model,
            'localizacion' => $localizacion,
            'ambito' => $ambito
        ]);
    }
    }

    /**
     * Creates a new AccionCentralizadaVariables model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccionCentralizadaVariables();
        

        $model_usuarios= new AccionCentralizadaVariablesUsuarios();
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model_usuarios->id_variable=$model->id;
            $usuarios=Yii::$app->request->post('id_usuario');
            $i=0;
            while(count(Yii::$app->request->post('id_usuario'))!=$i){
                        //funcion en el modelo para guardar
                        if($model_usuarios->usuarios_agregar($model->id,$usuarios[$i])){
                        $i++;
                        }else{
                            $transaction->rollback();
                            $i=count($request->post('id_usuario'));
                            
                        }
                        }// termina el while

            $transaction->commit();
            return $this->redirect(['responsable-acc-variable/create',  'id_variable' => $model->id]);
        } else {
        
            return $this->render('create', [
                'model' => $model,
            ]);
        }


            
        
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        
    }

    /**
     * Updates an existing AccionCentralizadaVariables model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $precarga="";$precarga1="";
        $model = $this->findModel($id);
        $verificar = UserAccounts::find()
                    ->select(["user_accounts.id as id", "user_accounts.username as username"])
                    ->innerjoin('accion_centralizada_variables_usuarios', 'user_accounts.id=accion_centralizada_variables_usuarios.id_usuario')
                    ->where(['accion_centralizada_variables_usuarios.id_variable' =>$model->id,])//$request->post('q')])
                    ->asArray()
                    ->all(); 
                    $i=0;
                   
                foreach ($verificar as $key ) {
                        
                      $precarga[$i]=$key['id']; 
                      $precarga1[$i]=$key['username'];
                     
                         $i++;
                    }
                   
        $acciones_especificas= [$model->accAccionEspecifica->id =>$model->accAccionEspecifica->cod_ac_espe." - ".$model->accAccionEspecifica->nombre,];
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model_usuarios= new AccionCentralizadaVariablesUsuarios();
            $model_usuarios->id_variable=$model->id;
            $usuarios=Yii::$app->request->post('id_usuario');
            $i=0;
            //eliminamos los usuarios
            AccionCentralizadaVariablesUsuarios::deleteAll('id_variable ="'.$model->id.'"');

            while(count(Yii::$app->request->post('id_usuario'))!=$i){
                        
                        //funcion en el modelo para guardar
                        if($model_usuarios->usuarios_agregar($model->id,$usuarios[$i])){
                        $i++;
                        }else{
                            $transaction->rollback();
                            $i=count($request->post('id_usuario'));
                            
                        }
                        }// termina el while

            $transaction->commit();
            return $this->redirect(['accion-centralizada-variables/view',  'id' => $model->id]);


       } else {
            return $this->render('update', [
                'model' => $model,
                'precarga' => $precarga,
                'precarga1'=>$precarga1,
                'acciones_especificas' => $acciones_especificas,
            ]);
        }
    }

    /**
     * Deletes an existing AccionCentralizadaVariables model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }





    //funcion para encontrar las acciones especificas que posee asignada las unidades ejecutoras
     public function actionAce()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Acciones Especificas
                $ace = AcAcEspec::find()
                    ->select(["accion_centralizada_accion_especifica.id as id", "CONCAT(accion_centralizada_accion_especifica.cod_ac_espe,' - ',accion_centralizada_accion_especifica.nombre) AS name"])
                    ->innerjoin('accion_centralizada_ac_especifica_uej', 'accion_centralizada_ac_especifica_uej.id_ac_esp=accion_centralizada_accion_especifica.id')
                    ->innerjoin('accion_centralizada', 'accion_centralizada.id=accion_centralizada_accion_especifica.id_ac_centr')
                    ->where(['accion_centralizada_ac_especifica_uej.id_ue' => $request->post('depdrop_parents'), 'accion_centralizada_accion_especifica.estatus' => 1, 'accion_centralizada.aprobado' => 1])
                    ->asArray()
                    ->all();                

                return [
                    'output' => $ace
                ];
            }
        }
        
    }


    public function actionAce1($q = NULL, $id = NULL)
    {
       $request = Yii::$app->request;
     
    
    Yii::$app->response->format = Response::FORMAT_JSON;
    
    $out = ['results' => ['id' => '', 'text' => '']];

        
    if (!is_null($q)) {


        if(stristr($q, ',')==false){


        $ace = AccionCentralizadaAsignar::find()
                    ->select(["user_accounts.id as id", "user_accounts.username AS name"])
                    ->innerjoin('user_accounts', 'user_accounts.id=accion_centralizada_asignar.usuario')
                    ->where(['accion_centralizada_asignar.unidad_ejecutora' =>$id])
                    ->andWhere(['LIKE', 'user_accounts.username',  $q])
                    ->asArray()
                    ->all();
        
       $out['results'] = array_values($ace);
       return $out;
   }else{
    $q=explode(',', $q);
           $ace = AccionCentralizadaAsignar::find()
                    ->select(["user_accounts.id as id", "user_accounts.username AS name"])
                    ->innerjoin('user_accounts', 'user_accounts.id=accion_centralizada_asignar.usuario')
                    ->where(['accion_centralizada_asignar.unidad_ejecutora' =>$id])
                    ->andWhere(['in', 'user_accounts.username',  $q])
                    ->asArray()
                    ->all();                
                    
       $out['results'] = array_values($ace);
       return $out;


   }


        
    }
    elseif ($id > 1) {
         $ace = AccionCentralizadaAsignar::find()
                    ->select(["user_accounts.id as id", "user_accounts.username AS name"])
                    ->innerjoin('user_accounts', 'user_accounts.id=accion_centralizada_asignar.usuario')
                    ->where(['accion_centralizada_asignar.unidad_ejecutora' =>$id])//$request->post('q')])
                    ->asArray()
                    ->all();  
        $out['results'] = $ace;
        return ($out);
        
    }

     $out['results'] =array_values(['id' => 0, 'text' => 'No Se Encontraron Resultados']);
    return ($out);
   
    

        
    }


    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
     
        $pks = explode(',', $request->post('pks')); 
        
        foreach ($pks as $key) 
        {
     
            $model=$this->findModel($key);
            $model->delete();
        }        

        if($request->isAjax){
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
            return $this->redirect(['accion_centralizada_variables/index']);
        }
       
    }


    /**
     * Finds the AccionCentralizadaVariables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccionCentralizadaVariables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccionCentralizadaVariables::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
