<?php

namespace backend\controllers;

use Yii;
use backend\models\AccionCentralizadaVariables;
use backend\models\AccionCentralizadaVariablesSearch;
use backend\models\AccionCentralizadaVariablesUsuarios;
use johnitvn\userplus\base\models\UserAccounts;
use common\models\AccionCentralizada;
use common\models\UnidadEjecutora;
use common\models\AcEspUej;
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
class AccionCentralizadaVariablesController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return parent::behaviors();
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            //Tablas relacionadas
            $localizacion = new ActiveDataProvider([
                'query' => LocalizacionAccVariable::find()->where(['id_variable'=>$model->id]),
                'pagination' => [
                    'pageSize' => 5,
                ]
            ]);

            $usuarios_variables=new AccionCentralizadaVariablesUsuarios;
            $usuarios=$usuarios_variables->obtener_usuario_variables($model->id);

            return $this->render('view', [
                'model' => $model,
                'localizacion' => $localizacion,
                'ambito' => $ambito,
                'usuarios' => $usuarios,
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
        $accionAC= new AccionCentralizada();
        //listas desplegables
        $accion_centralizada = AccionCentralizada::find(['estatus' => 1])->all();
        $accion_especifica = AcAcEspec::find()->where(['id' => $model->acc_accion_especifica, 'estatus' => 1])->all();
        $ue = UnidadEjecutora::find(['estatus' => 1])
        ->select(["unidad_ejecutora.id as id", "unidad_ejecutora.nombre as name"])
        ->where(['id' => $model->unidad_ejecutora])
        ->asArray()
        ->all();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
        
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model_usuarios= new AccionCentralizadaVariablesUsuarios();
            $model_usuarios->id_variable=$model->id;
            $usuarios=Yii::$app->request->post('id_usuario');
            $i=0;
            while(count(Yii::$app->request->post('id_usuario'))!=$i)
            {
                //funcion en el modelo para guardar
                if($model_usuarios->usuarios_agregar($model->id,$usuarios[$i]))
                {
                    $i++;
                }
                else
                {
                    $transaction->rollback();
                    $i=count($request->post('id_usuario'));
                }
            }// termina el while

            $transaction->commit();
            return $this->redirect(['responsable-acc-variable/create',  'id_variable' => $model->id]);
        } 
        else 
        {
        
            return $this->render('create', [
                'model' => $model,
                 'accion_centralizada' => $accion_centralizada,
                 'accion_especifica' => $accion_especifica,
                 'accionAC' => $accionAC,
                 'ue' => $ue,
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
        $precarga="";
        $model = $this->findModel($id);
        $accionAC=AccionCentralizada::findOne($model->accAccionEspecifica->idAcCentr->id);
        $verificar1 = new UserAccounts();
        //listas precargadas
        $accion_centralizada = AccionCentralizada::find(['estatus' => 1])->all();
        $accion_especifica = AcAcEspec::find()->where(['id_ac_centr' => $accionAC->id, 'estatus' => 1])->all();
        $ue = UnidadEjecutora::find(['estatus' => 1])
        ->select(["unidad_ejecutora.id as id", "unidad_ejecutora.nombre as name"])
        ->innerjoin('accion_centralizada_ac_especifica_uej', 'unidad_ejecutora.id=accion_centralizada_ac_especifica_uej.id_ue')
        ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $model->acc_accion_especifica])
        ->asArray()
        ->all();
        
        $verificar = AcEspUej::find()
            ->select(["user_accounts.id", "user_accounts.username as username"])
            ->innerjoin('accion_centralizada_asignar', 'accion_centralizada_asignar.accion_especifica_ue=accion_centralizada_ac_especifica_uej.id')
            ->innerjoin('user_accounts', 'user_accounts.id=accion_centralizada_asignar.usuario')
            ->where(['accion_centralizada_ac_especifica_uej.id_ue' => $model->unidad_ejecutora, 'accion_centralizada_ac_especifica_uej.id_ac_esp' => $model->acc_accion_especifica])
            ->asArray()
            ->all();
        //buscar los usuarios ya seleccionados
        foreach ($model->usuariosVariables as $key )
        {
            $precarga[]=$key['id_usuario'];
        }
        //agregarlos al modelo
        $verificar1->id=$precarga;
        $acciones_especificas= [$model->accAccionEspecifica->id =>$model->accAccionEspecifica->cod_ac_espe." - ".$model->accAccionEspecifica->nombre,];
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       if ($model->load(Yii::$app->request->post()) && $model->save())
       {
            $usuarios=Yii::$app->request->post('UserAccounts');
            if(!empty($usuarios['id']))
            {
                foreach ($usuarios as $key => $value) {
                    if(!$salvar=$model->uejecutoras($value))
                    {
                        
                        $transaction->rollback();
                        return $this->render('update', 
                        [
                            'model' => $model,
                            'precarga' => $precarga,
                            'verificar' => $verificar,
                            'verificar1' => $verificar1,
                            'accion_centralizada' => $accion_centralizada,
                            'accion_especifica' => $accion_especifica,
                            'accionAC' => $accionAC,
                            'ue' => $ue,
                        ]);
                    }
                }
                $transaction->commit();
                return $this->redirect(['accion-centralizada-variables/view',  'id' => $model->id]);
            }
            else
            {
                return $this->render('update', 
                    [
                        'model' => $model,
                        'precarga' => $precarga,
                        'verificar' => $verificar,
                        'verificar1' => $verificar1,
                        'accion_centralizada' => $accion_centralizada,
                        'accion_especifica' => $accion_especifica,
                        'accionAC' => $accionAC,
                        'ue' => $ue,
                    ]);
            }
       }
       else
       {
            return $this->render('update', [
                'model' => $model,
                'precarga' => $precarga,
                'verificar' => $verificar,
                'verificar1' => $verificar1,
                'accion_centralizada' => $accion_centralizada,
                'accion_especifica' => $accion_especifica,
                'accionAC' => $accionAC,
                'ue' => $ue,
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

    /**
     * Encontrar  las unidades ejecutoras asociadas a la accion especifica
     * @return array
     */
    public function actionAce()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Acciones Especificas
                $ace= new AccionCentralizadaVariables();                
                $unidad = new UnidadEjecutora();
                $unidad=$ace->obtenerUnidadesEJ($request->post('depdrop_parents'));
                              
                return [
                    'output' => $unidad
                ];
            }
        }
        
    }

    
    /**
     * Encontrar  los usuarios  que esten asociados a las acciones especificas
     * @return array
     * @param integer $id, $acc
     * @param string or array $q
     */
    public function actionAce1()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
             Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                $user=new UserAccounts();
                $variable= new AccionCentralizadaVariables();
                $user=$variable->BuscarUserUej($request->post('depdrop_all_params'));
                
                return [
                        'output' => $user
                    ];
            }
        }
    
    }


    /**
     * Encontrar las acciones especificas
     * @return array
     */
     public function actionAce2()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
         Yii::$app->response->format = Response::FORMAT_JSON;

         if($request->isPost)
         {
            $ace= new AcAcEspec ();
            $variable= new AccionCentralizadaVariables();
            $ace=$variable->BuscarACC($request->post('depdrop_parents'));
            
            return [
                    'output' => $ace
                ];
            }
        }
        
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
