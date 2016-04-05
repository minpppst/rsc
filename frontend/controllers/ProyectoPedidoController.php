<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\ProyectoPedido;
use common\models\ProyectoPedidoSearch;
use common\models\ProyectoAsignar;
use common\models\ProyectoAsignarSearch;
use common\models\MaterialesServicios;
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

use johnitvn\userplus\base\models\UserAccounts;

/**
 * ProyectoPedidoController implements the CRUD actions for ProyectoPedido model.
 */
class ProyectoPedidoController extends Controller
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
     * Lists all ProyectoPedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        //El usuario
        $usuario = UserAccounts::findOne(\Yii::$app->user->id);
        //Modelo de busqueda y dataprovider
        $searchModel = new ProyectoAsignarSearch();
        //Si no es sysadmin
        if(\Yii::$app->authManager->getAssignment('sysadmin',\Yii::$app->user->id) == null)
        {
            $searchModel->usuario = $usuario->id;
            $searchModel->estatus = 1;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'usuario' => $usuario
        ]);
    }

    /**
     * Pedidos del usuario
     * @param integer $asignado id de la asignacion
     * @return mixed
     */
    public function actionPedido($asignado)
    {
        //Datos para el gridview
        $searchModel = new ProyectoPedidoSearch(['asignado' => $asignado]);         
        //Si no es sysadmin
        if(\Yii::$app->authManager->getAssignment('sysadmin',\Yii::$app->user->id) == null)
        {
            $searchModel->estatus = 1;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //Datos de la asignacion
        $asignado = ProyectoAsignar::findOne($asignado);

        return $this->render('pedido', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'asignado' => $asignado
        ]);
    }

    /**
     * Displays a single ProyectoPedido model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        */
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
     * Creates a new ProyectoPedido model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($asignar)
    {
        $request = Yii::$app->request;
        $model = new ProyectoPedido();
        //Inicializar los meses en 0
        $model->enero = 0;
        $model->febrero = 0;
        $model->marzo = 0;
        $model->abril = 0;
        $model->mayo = 0;
        $model->junio = 0;
        $model->julio = 0;
        $model->agosto = 0;
        $model->septiembre = 0;
        $model->octubre = 0;
        $model->noviembre = 0;
        $model->diciembre = 0;
        $model->asignado = $asignar;
        //Precio en 0
        $model->precio = 0;

        //autocomplete
        $materiales = MaterialesServicios::find()
                ->select(['nombre', 'id', 'precio', 'iva'])
                ->all();

        //Arreglo de precios, iva, etc con id del material/servicio
        $precios = json_encode( //JSON
            ArrayHelper::toArray( //Convertir a arreglo
                ArrayHelper::index($materiales,'id') //Indice del arreglo el id del material
            )
        );

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Pedido",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'materiales' => $materiales,
                        'precios' => $precios
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Crear',['class'=>'btn btn-success','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Pedido",
                    'content'=>'<span class="text-success">Crear Pedido success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Asignar otro',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Pedido",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'materiales' => $materiales,
                        'precios' => $precios
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Crear',['class'=>'btn btn-success','type'=>"submit"])
        
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
                    'materiales' => $materiales,
                    'precios' => $precios
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProyectoPedido model.
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
        //Arreglo de precios, iva, etc con id del material/servicio
        $precios = json_encode( //JSON
            ArrayHelper::toArray( //Convertir a arreglo
                ArrayHelper::index($materiales,'id') //Indice del arreglo el id del material
            )
        );      

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
                        'materiales' => $materiales,
                        'precios' => $precios
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
                        'materiales' => $materiales,
                        'precios' => $precios
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Pedido",
                    'content'=>$this->renderAjax('update', [
                        'model' => $this->findModel($id),
                        'materiales' => $materiales,
                        'precios' => $precios
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
                    'materiales' => $materiales,
                    'precios' => $precios
                ]);
            }
        }
    }

    /**
     * Delete an existing ProyectiPedido model.
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
            return ['forceClose'=>true,'forceReload'=>true];    
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
     * Desactiva multiples modelos de ProyectoPedido.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = ProyectoPedido::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->desactivar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => true];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Activa multiples modelos de ProyectoPedido.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = ProyectoPedido::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->activar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => true];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the ProyectoPedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoPedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoPedido::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
