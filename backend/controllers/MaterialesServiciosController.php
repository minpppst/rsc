<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

use common\models\MaterialesServicios;
use common\models\MaterialesServiciosSearch;
use common\models\CuentaPresupuestaria;
use common\models\PartidaPartida;
use common\models\PartidaGenerica;
use common\models\PartidaEspecifica;
use common\models\PartidaSubEspecifica;
use common\models\UnidadMedida;
use common\models\Presentacion;

use common\models\UploadForm;

/**
 * MaterialesServiciosController implements the CRUD actions for MaterialesServicios model.
 */
class MaterialesServiciosController extends Controller
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
     * Lists all MaterialesServicios models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new MaterialesServiciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MaterialesServicios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "MaterialesServicios #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new MaterialesServicios model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MaterialesServicios(); 
        //Desplegables
        $unidad_medida = UnidadMedida::find()->all();
        $presentacion = Presentacion::find()->all();
        //autocompletar
        $sub_especfica = PartidaSubEspecifica::find()
           ->select(['nombre as value', 'cuenta as cuenta', 'partida as partida'])
           ->asArray()
           ->all(); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Materiales/Servicios",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'unidad_medida' => $unidad_medida,
                        'presentacion' => $presentacion,
                        'sub_especfica' => $sub_especfica
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Crear Materiales/Servicios",
                    'content'=>'<span class="text-success">Create MaterialesServicios success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Crear Otro',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear Materiales/Servicios",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'unidad_medida' => $unidad_medida,
                        'presentacion' => $presentacion,
                        'sub_especfica' => $sub_especfica
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
                    'unidad_medida' => $unidad_medida,
                    'presentacion' => $presentacion,
                    'sub_especfica' => $sub_especfica
                ]);
            }
        }
       
    }

    /**
     * Updates an existing MaterialesServicios model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        //Desplegables
        $unidad_medida = UnidadMedida::find()->all();
        $presentacion = Presentacion::find()->all();
        //autocompletar
        $sub_especfica = PartidaSubEspecifica::find()
           ->select(['nombre as value', 'id as id'])
           ->asArray()
           ->all();       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Modificar Materiales/Servicios #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'unidad_medida' => $unidad_medida,
                        'presentacion' => $presentacion,
                        'sub_especfica' => $sub_especfica
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "MaterialesServicios #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'unidad_medida' => $unidad_medida,
                        'presentacion' => $presentacion,
                        'sub_especfica' => $sub_especfica
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Modificar Materiales/Servicios #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'unidad_medida' => $unidad_medida,
                        'presentacion' => $presentacion,
                        'sub_especfica' => $sub_especfica
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
                    'unidad_medida' => $unidad_medida,
                    'presentacion' => $presentacion,
                    'sub_especfica' => $sub_especfica
                ]);
            }
        }
    }

    /**
     * Delete an existing MaterialesServicios model.
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
     * Delete multiple existing MaterialesServicios model.
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
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Importar Materiales o Servicios.
     * Se recibe el stream de un archivo CSV. Se lee cada linea del archivo
     * y se separa cada columna en un arreglo. Cada elemento del arreglo se utilizara
     * para buscar los modelos asociados al registro a insertar/modificar.
     * @return mixed
     */
    public function actionImportar()
    {
        $request = Yii::$app->request;
        $modelo = new UploadForm();

        if($request->isPost)
        {
            $archivo = file($_FILES['UploadForm']['tmp_name']['importFile']);

            $transaccion = MaterialesServicios::getDb()->beginTransaction();

            try
            {
                //Por cada linea leida
                foreach ($archivo as $llave => $valor) 
                {
                    //Separar las columnas de la linea leida
                    $exploded = explode(',', str_replace('"', '',$valor));
                    /* Llaves foraneas */
                    //Partida presupuestaria $exploded[0]
                    $id_se = MaterialesServicios::findIdSubEspecifica($exploded[0]);

                    //Unidad de medida $exploded[2]
                    $unidad_medida = UnidadMedida::find()->where('unidad_medida LIKE "%:unidad_medida%"')
                        ->addParams([':unidad_medida' => $exploded[2]])
                        ->one();

                    //Presentacion $exploded[3]
                    $presentacion = Presentacion::find()->where('presentacion LIKE "%:presentacion%"')
                        ->addParams([':presentacion' => $exploded[3]])
                        ->one();

                    //Buscar el modelo. Material o servicio $exploded[1]
                    $ms = MaterialesServicios::find()
                        ->where(['nombre' => $exploded[1], 'id_se' =>$id_se])
                        ->one();

                    //Si no se encuentra un material o servicio
                    if($ms == null)
                    {
                        //Modelo nuevo a insertar
                        $ms = new MaterialesServicios;
                    }

                    //Asignar variables
                    $ms->id_se = $id_se;
                    $ms->nombre = $exploded[1];
                    $ms->unidad_medida = $unidad_medida->id;
                    $ms->presentacion = $presentacion->id;
                    $ms->precio = $exploded[4];
                    $ms->iva = 12; //IVA 12%
                    $ms->estatus = 1; //1 Activo, 0 Inactivo
                    $ms->save();
                }
                
                //Se insertan o modifican los registros
                $transaccion->commit();
                //Mensaje de exito
                Yii::$app->session->setFlash('importado', '<div class="alert alert-success">Registros importados exitosamente.</div>');
                return $this->refresh();

            }catch(\Exception $e){ //Falla la insercion o modificacion de registros
                //Se cancela la transaccion
                $transaccion->rollBack();
                //Mensaje de error
                Yii::$app->session->setFlash('importado', '<div class="alert alert-danger">'.$e.'</div>');
            }
                        
        }
        //La vista
        return $this->render('importar', [
            'modelo' => $modelo,
        ]);
    }

    /**
     * Activar o desactivar un modelo.
     * @param integer $id Id del modelo 
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
     * Desactiva multiples modelos.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = MaterialesServicios::className();
        
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
     * Activa multiples modelos.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @return mixed
     */
    public function actionBulkActivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = MaterialesServicios::className();
        
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
     * Finds the MaterialesServicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MaterialesServicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaterialesServicios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
