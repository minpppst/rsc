<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\rbac\ManagerInterface;
use yii\db\Query;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use backend\models\AcAcEspec;
use backend\models\AcAcEspecSearch;
use common\models\AccionCentralizadaPedido;
use common\models\AccionCentralizadaPedidoSearch;
use common\models\AccionCentralizadaAsignar;
use common\models\AccionCentralizadaAsignarSearch;
use common\models\MaterialesServicios;
use common\models\UnidadEjecutora;
use common\models\AcEspUej;
use common\models\AcEspUejSearch;


use johnitvn\userplus\base\models\UserAccounts;

/**
 * AccionCentralizadaPedidoController implements the CRUD actions for AccionCentralizadaPedido model.
 */
class AccionCentralizadaPedidoController extends \common\controllers\BaseController
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
     * Lists all AccionCentralizadaPedido models.
     * @return mixed
     */
    public function actionIndex()
    {        
    
        $searchModel = new AcEspUejSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Pedidos
     * @param integer $ue unidad ejecutora
     * @return mixed
     */
    public function actionPedido($ue,$acc)
    {
        //Datos para el gridview
        $searchModel = new AccionCentralizadaPedidoSearch(['idUnidadEjecutora' => $ue, 'idAcc' => $acc]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = AcEspUej::find()->where(['id_ue' => $ue])->andWhere(['id_ac_esp' => $acc])->One();

        //Otros datos
        $ue = UnidadEjecutora::findOne($ue);

        return $this->render('pedido', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ue' => $ue,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single AccionCentralizadaPedido model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Pedido #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new AccionCentralizadaPedido model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($asignar)
    {
        $request = Yii::$app->request;
        $model = new AccionCentralizadaPedido();
        $model->asignado = $asignar;

        //autocomplete
        $materiales= UePartidaEntidad::find()
        ->andWhere(['id_tipo_entidad' => 2])
        ->andWhere(['id_ue' => $model->asignado0->accion_especifica_ue0->id_ue])
        ->All();
        
        
        foreach ($materiales as $key => $value) {

            foreach ($value->materialesPartidaEntidad as $key => $value) {
            if(isset($value))
            $materiales1[]=$value;
        }
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Requerimiento",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'materiales' => $materiales1,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Requerimientos",
                    'content'=>'<span class="text-success">Create ProyectoAsignar success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Asignar otro',['create', 'asignar' => $asignar],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Pedido",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'materiales' => $materiales1,
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
                    'materiales' => $materiales1,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing AccionCentralizadaPedido model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        //autocomplete
        $materiales = MaterialesServicios::find()
                ->select(['nombre', 'id', 'precio'])
                ->all();      

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Pedido",
                    'content'=>$this->renderAjax('update', [
                        'model' => $this->findModel($id),
                        'materiales' => $materiales
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Pedido",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                        'materiales' => $materiales
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Pedido",
                    'content'=>$this->renderAjax('update', [
                        'model' => $this->findModel($id),
                        'materiales' => $materiales
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
                    'materiales' => $materiales
                ]);
            }
        }
    }

    /**
     * Delete an existing AccionCentralizadaPedido model.
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
     * Desactiva multiples modelos de AccionCentralizadaPedido.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = AccionCentralizadaPedido::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->desactivar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' =>'true'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Activa multiples modelos de AccionCentralizadaPedido.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar() {
        $request = Yii::$app->request;
        $pks = explode(',',$request->post('pks')); // arreglo o llave primaria
        //Obtener el nombre de la clase del modelo
        $className = AccionCentralizadaPedido::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->activar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' =>'true'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }
    public function actionLlenarprecio()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Acciones Especificas
                $ace = MaterialesServicios::find()
                    ->select(["precio", "iva"])
                    ->where(['id' => $request->post('id')])
                    ->asArray()
                    ->all();                
                if($ace!=null)
                return $ace;
            else
                return 0;


            }
        }
        
    }

    /**
     * Finds the AccionCentralizadaPedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccionCentralizadaPedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccionCentralizadaPedido::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

      public function actionAprobar($id)
    {

        
        $model = AcEspUej::find()->where(['id' => $id])->One();
        
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model->id != null && $model->toggleAprobar()) {
            return ['forceClose' => true, 'forceReload' => '#aprobar'];
        } else {

            return [
                'title' => 'Ocurrió un error.',
                'content' => '<span class="text-danger">No se pudo realizar la operación. Error desconocido</span>',
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
            return;
        }
    }




    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        //$pks = json_decode($request->post('pks')); // Array or selected records primary keys
        $pks = explode(',',$request->post('pks')); // arreglo o llave primaria
        
        foreach ($pks as $key) 
        {
            //$model=AcAcEspec::findAll(json_decode($key));
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
            return $this->redirect(['/accion_centralizada-pedido/index']);
        }
       
    }




}
