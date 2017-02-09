<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Console;

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
class MaterialesServiciosController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return parent::behaviors();
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
        $sub_especifica = PartidaSubEspecifica::find()
           /*->select([
                'nombre as value',
                'cuenta as cuenta',
                'partida as partida',
                'generica as generica',
                'especifica as especifica',
                'subespecifica as subespecifica'
            ])*/
            ->select(["concat(cuenta, '-', partida, '-', generica, '-', especifica, '-', subespecifica, ' ', nombre) as nombre", "concat(cuenta, '-', partida, '-', generica, '-', especifica, '-', subespecifica) as partida"])
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
                        'sub_especifica' => $sub_especifica
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
                        'sub_especifica' => $sub_especifica
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
                    'sub_especifica' => $sub_especifica
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
        $model->cuentapartida=$model->cuenta."-".$model->partida."-".$model->generica."-".$model->especifica."-".$model->subespecifica;
        //Desplegables
        $unidad_medida = UnidadMedida::find()->all();
        $presentacion = Presentacion::find()->all();
        //autocompletar
        $sub_especifica = PartidaSubEspecifica::find()
            ->select(["concat(cuenta, '-', partida, '-', generica, '-', especifica, '-', subespecifica, ' ', nombre) as nombre", "concat(cuenta, '-', partida, '-', generica, '-', especifica, '-', subespecifica) as partida"])
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
                        'sub_especifica' => $sub_especifica
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
                        'sub_especifica' => $sub_especifica
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
                        'sub_especifica' => $sub_especifica
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
                    'sub_especifica' => $sub_especifica
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
                    //Ignorar el encabezado
                    if($llave == 0)
                    {
                        continue;
                    }

                    //Separar las columnas de la linea leida
                    $exploded = explode(',', str_replace('"', '',$valor));

                    /* Llaves foraneas */

                    //Preparar la llave compuesta
                    $cuenta = substr($exploded[0], 0,1);
                    $partida = substr($exploded[0], 1,2);
                    $generica = substr($exploded[0], 3,2);
                    $especifica = substr($exploded[0], 5,2);
                    $subespecifica = substr($exploded[0], 7,2);

                    //echo $cuenta."\n".$partida."\n".$generica."\n".$especifica."\n".$subespecifica;exit;
                    

                    //Unidad de medida $exploded[2]
                    $unidad_medida = UnidadMedida::find()->where('unidad_medida LIKE "%:unidad_medida%"')
                        ->addParams([':unidad_medida' => $exploded[2]])
                        ->one();

                    //Presentacion $exploded[3]   
                    $presentacion = Presentacion::find()->where('nombre LIKE "%:presentacion%"')
                        ->addParams([':presentacion' => $exploded[3]])
                        ->one();

                    //Buscar el modelo. Material o servicio $exploded[1]
                    $ms = MaterialesServicios::find()
                        ->where(['nombre' => $exploded[1], 'cuenta' => $cuenta, 'partida' => $partida, 'generica' => $generica, 'especifica' => $especifica, 'subespecifica' => $subespecifica])
                        ->one();

                    //Si no se encuentra un material o servicio
                    if($ms == null)
                    {
                        //Modelo nuevo a insertar
                        $ms = new MaterialesServicios;
                    }

                    //Asignar variables
                    $ms->cuenta = $cuenta;
                    $ms->partida = $partida;
                    $ms->generica = $generica;
                    $ms->especifica = $especifica;
                    $ms->subespecifica = $subespecifica;
                    $ms->nombre = $exploded[1];
                    $ms->unidad_medida = ($unidad_medida != null)? $unidad_medida->id : null;
                    $ms->presentacion = ($presentacion != null)? $presentacion->id : null;
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
     * Desactiva multiples modelos.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $pks = explode(',',$request->post('pks')); // arreglo o llave primaria
        foreach ($pks as $pk) 
        {             
            $model = $this->findModel($pk); //se busca el modelo
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
     * Activa multiples modelos.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @return mixed
     */
    public function actionBulkActivar() {
        $request = Yii::$app->request;
        $pks = explode(',',$request->post('pks')); // arreglo o llave primaria
        foreach ($pks as $pk) 
        {             
            $model = $this->findModel($pk); //se busca el modelo
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

    /**
     * Lists all MaterialesServicios models.
     * @return mixed
     */
    public function actionBuscarmaterial()
    {    
        $searchModel = new MaterialesServiciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('buscarmaterial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing MaterialesServicios model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionCambiarprecio($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            if($request->isGet)
            {
                //proceso de confirmación y realizar el cambio definitivo
                if($request->get('cambiartodo')!=null && $request->get('cambiartodo')==1)
                {
                    $model=MaterialesServicios::findOne($request->get('id'));
                    $model->precio=$request->get('precio');
                    //metodo en el model que cambia el precio y ademas cambio los pedidos hechos en el año en curso
                    if($model->cambiarTodo())
                    {
                        return 
                        [
                            'title'=> "MaterialesServicios #".$id,
                            'content'=>$this->renderAjax('view', [
                            'model' => $model,
                            ]),
                            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                        ]; 
                    }
                    else
                    {
                        return 
                            [
                                'title'=> "Modificar Precio Materiales/Servicios #".$id,
                                'content'=>$this->renderAjax('_cambiarprecio', 
                                    [
                                        'model' => $model,
                                    ]),
                                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                            Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                            ];
                    }
                }
                else
                {
                    return 
                    [
                        'title'=> "Modificar Precio Materiales/Servicios #".$id,
                        'content'=>$this->renderAjax('_cambiarprecio', 
                            [
                                'model' => $model,
                            ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                    ];
                }
            }
            else
            {
                if($model->load($request->post()))
                {
                    //reporte temporal
                    return 
                    [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "MaterialesServicios #".$id,
                        'content'=>$this->renderAjax('_reporte_temporal',
                            [
                                'model' => $model,
                            ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Editar',['cambiarprecio','id'=>$id, 'precio'=>$model->precio, 'cambiartodo'=>'1'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                    
                }
                else
                {
                    return 
                    [
                        'title'=> "Modificar Materiales/Servicios #".$id,
                        'content'=>$this->renderAjax('_cambiarprecio', 
                            [
                                'model' => $model,
                            ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                    ];        
                }
            }
        }
    }
}
