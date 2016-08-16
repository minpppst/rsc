<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use johnitvn\userplus\base\WebController;
use common\models\AccionCentralizadaAsignar;
use common\models\AcEspUej;
use backend\models\AccionCentralizadaAsignarSearch;
use common\models\UnidadEjecutora;
use common\models\AccionCentralizada;
use common\models\AcAcEspec;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

use johnitvn\userplus\base\models\UserAccounts;

/**
 * AccionCentralizadaAsignarController implements the CRUD actions for ProyectoAsignar model.
 */
class AccionCentralizadaAsignarController extends WebController
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
     * Lists all ProyectoAsignar models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = $this->userPlusModule->createModelInstance('UserSearch');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProyectoAsignar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'title'=> "Asignado",
            'content'=>$this->renderPartial('view', [
                'model' => $this->findModel($id)
            ]),
            'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])

        ];
    }

    /**
     * Asignar unidades ejecutoras y acciones especificas
     * a un usuario.
     * @param integer $usuario
     * @return mixed
     */
    public function actionAsignar($usuario)
    {
        //Modelos
        $usuario = UserAccounts::findIdentity($usuario);
        $searchModel = new AccionCentralizadaAsignarSearch(['usuario' => $usuario->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->render('asignar', [
            'usuario' => $usuario,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new AccionCentralizadaAsignar model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($usuario)
    {
        $request = Yii::$app->request;
        $model = new AccionCentralizadaAsignar();
        $model->usuario = $usuario;
        if(!$model_ue_acc=AcEspUej::find()->where(['id'=>$model->accion_especifica_ue])->One()){
           $model_ue_acc=new AcEspUej();
        }
        
        
        $accion_especifica = AcAcEspec::find()->where(['id' => $model_ue_acc->id_ac_esp])->all();
        
        //Listas desplegables
        $ue = UnidadEjecutora::find(['estatus' => 1])->where(['id'=>$model_ue_acc->id_ue])->asArray()->all(); 
        $accion_centralizada = AccionCentralizada::find(['estatus' => 1])->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Asignar",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'ue' => $ue,
                        'accion_centralizada' => $accion_centralizada,
                        'accion_especifica' => $accion_especifica,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Asignado",
                    'content'=>'<span class="text-success">Create AccionCentralizadaAsignar success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Asignar otro',['create',  'usuario' => $usuar],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Asignar",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'ue' => $ue,
                        'accion_centralizada' => $accion_centralizada,
                        'accion_especifica' => $accion_especifica,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'ue' => $ue,
                    'accion_centralizada' => $accion_centralizada,
                    'accion_especifica' => $accion_especifica,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProyectoAsignar model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if(!$model_ue_acc=AcEspUej::find()->where(['id'=>$model->accion_especifica_ue])->One()){
           $model_ue_acc=new AcEspUej();
        }
        //Listas desplegables
        $accion_especifica = AcAcEspec::find()->where(['id' => $model_ue_acc->id_ac_esp])->all();
        $i=0;
         foreach($accion_especifica as $row){
         $acciones[$i]=$row->id;
         $i++;
        }

        $ue = UnidadEjecutora::find(['estatus' => 1])
        ->select(["unidad_ejecutora.id as id", "unidad_ejecutora.nombre as nombre"])
        ->innerjoin('accion_centralizada_ac_especifica_uej', 'accion_centralizada_ac_especifica_uej.id_ue=unidad_ejecutora.id')
        ->andWhere(['accion_centralizada_ac_especifica_uej.id_ac_esp'=> $acciones])
        ->asArray()
        ->all();
        $accion_centralizada = AccionCentralizada::find()->all();
        $accion_especifica = AcAcEspec::find()->where(['id_ac_centr' => $model_ue_acc->idAcEsp->idAcCentr->id])->all();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Asignar",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'ue' => $ue,
                        'accion_centralizada' => $accion_centralizada,
                        'accion_especifica' => $accion_especifica,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Asignado",
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                        'ue' => $ue,
                        'accion_centralizada' => $accion_centralizada,
                        'accion_especifica' => $accion_especifica,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                //print_r($model->getErrors()); exit();
                 return [
                    'title'=> "Asignar",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'ue' => $ue,
                        'accion_centralizada' => $accion_centralizada,
                        'accion_especifica' => $accion_especifica,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'ue' => $ue
                ]);
            }
        }
    }

    /**
     * Funcion de respuesta para el AJAX de
     * acciones especificas
     * @return array JSON 
     */
    
    public function actionAce1()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Acciones Especificas
                $ace = AcAcEspec::find()
                    ->select(["accion_centralizada_accion_especifica.id", "CONCAT(accion_centralizada_accion_especifica.cod_ac_espe,' - ',accion_centralizada_accion_especifica.nombre) AS name"])
                    ->innerjoin('accion_centralizada', 'accion_centralizada.id=accion_centralizada_accion_especifica.id_ac_centr')
                    ->where(['accion_centralizada.id' => $request->post('depdrop_parents'), 'accion_centralizada_accion_especifica.estatus' => 1])
                    ->asArray()
                    ->all();                

                return [
                    'output' => $ace
                ];
            }
        }
        
    }



    public function actionAce()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Acciones Especificas
                $ace = UnidadEjecutora::find()
                    ->select(["unidad_ejecutora.id", "CONCAT(unidad_ejecutora.codigo_ue,' - ',unidad_ejecutora.nombre) AS name"])
                    ->innerjoin('accion_centralizada_ac_especifica_uej', 'accion_centralizada_ac_especifica_uej.id_ue=unidad_ejecutora.id')
                    ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $request->post('depdrop_parents')])
                    ->asArray()
                    ->all();                
            
                    if($ace!=NULL){
                return [
                    'output' => $ace
                ];
            }
            
            }
        }
        
    }

    public function actionAce2()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
             
                //Acciones Especificas
                $ace = AcEspUej::find()
                ->where(['id_ue'=>$request->post('id_unidad')])
                ->andwhere(['id_ac_esp'=>$request->post('id_especifica')])
                ->One();
                    
            
                if($ace!=NULL){
                return  $ace->id;
                }
                else
                {
                return null;
                }
            
            }
        }
        
    }


     /**
     * Delete an existing ProyectoAsignar model.
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
            return ['forceClose'=>true,'forceReload'=>'true'];    
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

    /**
     * Delete multiple existing ProyectoAsignar model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
         $pks=explode(",", $request->post('pks'));
         foreach (AccionCentralizadaAsignar::findAll($pks) as $model) {
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
            return ['forceClose' => true, 'forceReload' => true];
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
     * Desactiva multiples modelos de ProyectoAsignar.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        
        if(empty($pks))
        $pks=explode(",", $request->post('pks'));
        //Obtener el nombre de la clase del modelo
        $className = AccionCentralizadaAsignar::className();
        
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
     * Activa multiples modelos de ProyectoAsignar.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        if(empty($pks))
        $pks=explode(",", $request->post('pks'));
        //Obtener el nombre de la clase del modelo
        $className = AccionCentralizadaAsignar::className();
        
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
     * Finds the ProyectoAsignar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoAsignar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccionCentralizadaAsignar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
