<?php

namespace backend\controllers;

use Yii;
use backend\models\ProyectoVariables;
use backend\models\ProyectoVariablesSearch;
use backend\models\ProyectoVariableUsuarios;
use backend\models\ProyectoVariableLocalizacion;
use common\models\ProyectoUsuarioAsignar;
use johnitvn\userplus\base\models\UserAccounts;
use common\models\Proyecto;
use common\models\Ambito;
use common\models\ProyectoAccionEspecifica;
use common\models\UnidadEjecutora;
use common\models\AcEspUej;
use common\models\ProyectoVariableImpacto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

/**
 * ProyectoVariablesController implements the CRUD actions for ProyectoVariables model.
 */
class ProyectoVariablesController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all ProyectoVariables models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProyectoVariablesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ProyectoVariables model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        
        $model = $this->findModel($id);
        $ambito= $model->localizacion;
        $modelLocalizacion=ProyectoVariableLocalizacion::find()->where(['id_variable' => $model->id])->One();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            //Tablas relacionadas
            $localizacion = new ActiveDataProvider([
                'query' => ProyectoVariableLocalizacion::find()->where(['id_variable'=>$model->id]),
                'pagination' => [
                    'pageSize' => 5,
                ]
            ]);
            

            $usuarios_variables=new ProyectoVariableUsuarios;

            return $this->render('view', [
                'model' => $model,
                'localizacion' => $localizacion,
                'ambito' => $ambito,
                'usuarios' =>$usuarios_variables->obtenerUsuarioVariables($model->id),
                'modelLocalizacion' => $modelLocalizacion,
            ]);
        }
        
    }

    /**
     * Creates a new ProyectoVariables model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new ProyectoVariables();
        $impacto = ProyectoVariableImpacto::find()->asArray()->all();
        $proyecto= new Proyecto();
        $modeluser = new UserAccounts();
        //listas desplegables
        $listproyecto = Proyecto::find()->all();
        $lugares = Ambito::find()->all();
        $proyectoac = ProyectoAccionEspecifica::find()->where(['id' => null])->all();
        $ue = UnidadEjecutora:: find()->where(['id' => null])->all();
        
        if ($model->load($request->post())) 
        {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try 
            {
                
                if($model->save())
                {
                    $model_usuarios= new ProyectoVariableUsuarios();
                    $model_usuarios->id_variable=$model->id;
                    $usuarios=Yii::$app->request->post('UserAccounts');
                    
                    foreach ($usuarios['id'] as $key => $value)
                    {
                        if(!$model_usuarios->UsuariosAgregar($model->id,$value))
                        {
                            $transaction->rollback();
                            return $this->render('create',
                            [
                                'model' => $model,
                                'proyecto' => $proyecto,
                                'proyectoac' => $proyectoac,
                                'listproyecto' => $listproyecto,
                                'modeluser' => $modeluser,
                                'lugares' => $lugares,
                                'ue' => $ue,
                                'impacto' => $impacto,
                            ]);
                        }
                    }

                    $transaction->commit();
                    return $this->redirect(['proyecto-variable-responsable/create',  'id_variable' => $model->id]);
                }
                else
                {
                    return $this->render('create',
                    [
                        'model' => $model,
                        'proyecto' => $proyecto,
                        'proyectoac' => $proyectoac,
                        'listproyecto' => $listproyecto,
                        'modeluser' => $modeluser,
                        'lugares' => $lugares,
                        'ue' => $ue,
                        'impacto' => $impacto,
                    ]);
                }
            }
            catch (CDbException $e)
            {
                $transaction->rollBack();
                throw $e;
            }
        }
        else
        {
            return $this->render('create',
            [
                'model' => $model,
                'proyecto' => $proyecto,
                'proyectoac' => $proyectoac,
                'listproyecto' => $listproyecto,
                'modeluser' => $modeluser,
                'lugares' => $lugares,
                'ue' => $ue,
                'impacto' => $impacto,
            ]);
        }
    }

    /**
     * Updates an existing ProyectoVariables model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $impacto = ProyectoVariableImpacto::find()->asArray()->all();
        //lista desplegables
        $lugares = Ambito::find()->all();
        $proyecto= Proyecto::findOne(['id' => $model->accionEspecifica->id_proyecto]);
        $listproyecto = Proyecto::find(['estatus' => 1])->all();
        $proyectoac = ProyectoAccionEspecifica::find()->where(['id_proyecto' => $model->accionEspecifica->id_proyecto, 'estatus' => 1])->all();
        $ue = UnidadEjecutora::find(['estatus' => 1])
        ->select(["unidad_ejecutora.id as id", "unidad_ejecutora.nombre as name"])
        ->asArray()
        ->where(['id' => $model->unidad_ejecutora])
        ->All();
        $listausuariosaccion=ProyectoUsuarioAsignar::find()->select(['usuario_id as id', 'username'])->innerjoin('user_accounts', 'user_accounts.id=proyecto_usuario_asignar.usuario_id')->where(['accion_especifica_id' => $model->accion_especifica])->asArray()->all();
        //fin listas precargadas y modelos necesarios
        //usuarios seleccionados
        $usuariosaccion=ProyectoVariableUsuarios::find()->select(['id_usuario as id', 'username'])->innerjoin('user_accounts', 'user_accounts.id=proyecto_variable_usuarios.id_usuario')->where(['id_variable' => $model->id])->asArray()->all();
        foreach ($usuariosaccion as $key => $value) 
        {
            $usuarios[]=$value['id'];
        }
        $modeluser =new UserAccounts();
        $modeluser->id=$usuarios;

        if ($model->load($request->post())) 
        {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try 
            {
                
                if($model->save())
                {
                    $model_usuarios=new ProyectoVariableUsuarios();
                    $usuarios=Yii::$app->request->post('UserAccounts');
                    if($usuarios['id']!=null)
                    {
                        //print_r($usuarios['id']); exit();   
                        if(!$model_usuarios->UsuariosModificar($usuarios['id'], $model->id))
                        {
                            $transaction->rollback();
                            return $this->render('update',
                            [
                                'model' => $model,
                                'proyecto' => $proyecto,
                                'proyectoac' => $proyectoac,
                                'listproyecto' => $listproyecto,
                                'modeluser' => $modeluser,
                                'lugares' => $lugares,
                                'ue' => $ue,
                                'impacto' => $impacto,
                                'listausuariosaccion' => $listausuariosaccion,
                            ]);
                        }
                    }
                    else
                    {
                        $transaction->rollback();
                        return $this->render('update', 
                        [
                            'model' => $model,
                            'proyecto' => $proyecto,
                            'proyectoac' => $proyectoac,
                            'listproyecto' => $listproyecto,
                            'modeluser' => $modeluser,
                            'lugares' => $lugares,
                            'ue' => $ue,
                            'impacto' => $impacto,
                            'listausuariosaccion' => $listausuariosaccion,

                        ]);
                    }

                    $transaction->commit();
                    return $this->redirect(['proyecto-variables/view',  'id' => $model->id]);
                }
                else 
                {
                    return $this->render('update', 
                    [
                        'model' => $model,
                        'proyecto' => $proyecto,
                        'proyectoac' => $proyectoac,
                        'listproyecto' => $listproyecto,
                        'modeluser' => $modeluser,
                        'lugares' => $lugares,
                        'ue' => $ue,
                        'impacto' => $impacto,
                        'listausuariosaccion' => $listausuariosaccion,

                    ]);
                }
            }
            catch (CDbException $e)
            {
                $transaction->rollBack();
                throw $e;
            }
        }
        else 
        {
            return $this->render('update', 
            [
                'model' => $model,
                'proyecto' => $proyecto,
                'proyectoac' => $proyectoac,
                'listproyecto' => $listproyecto,
                'modeluser' => $modeluser,
                'lugares' => $lugares,
                'ue' => $ue,
                'impacto' => $impacto,
                'listausuariosaccion' => $listausuariosaccion,
            ]);
        }
        
        
    }

    /**
     * Delete an existing ProyectoVariables model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
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
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing ProyectoVariables model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
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
     * Finds the ProyectoVariables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoVariables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoVariables::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
            //$ace= new ProyectoAccionEspecifica ();
            $variable= new ProyectoVariables();
            $ace=$variable->BuscarAcciones($request->post('depdrop_parents'));
            
            return [
                    'output' => $ace
                ];
            }
        }
        
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
                $ace= new ProyectoVariables();                
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
                $variable= new ProyectoVariables();
                $user=$variable->BuscarUserUej($request->post('depdrop_all_params'));
                
                return [
                        'output' => $user
                    ];
            }
        }
    
    }
}
