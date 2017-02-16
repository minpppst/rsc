<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use common\models\AcAcEspec;
use common\models\UnidadEjecutora;
use common\models\UnidadEjecutoraSearch;
use common\models\AcEspUej;
use common\models\AcAcEspecSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use frontend\models\UploadForm;
use bedezign\yii2\audit\components\Version;
use bedezign\yii2\audit\models\AuditTrail;
use bedezign\yii2\audit\models\AuditTrailSearch;

/**
 * AcAcEspecController implements the CRUD actions for AcAcEspec model.
 */
class AcAcEspecController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all AcAcEspec models.
     * @param integer $ac_centralizada
     * @return mixed
     */
    public function actionIndex($ac_centralizada)
    {    
        $searchModel = new AcAcEspecSearch(['id_ac_centr'=>$ac_centralizada]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        

        $html=$this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    //   return $html;
    return Json::encode($html);
    }


    /**
     * Displays a single AcAcEspec model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $model=$this->findModel($id);
        $unidad_ejecutora=new AcEspUej;
        $ue=$unidad_ejecutora->obtener_uej_relacionadas($model->id);
        
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Accion Especifica #".$id,
                    'content'=>$this->renderPartial('view', [
                    'model' => $this->findModel($id),
                    'rows' =>$ue,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                 'rows' =>$ue,
            ]);
        }
    }

    /**
     * Creates a new AcAcEspec model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $ac_centralizada
     * @return mixed
     */
    public function actionCreate($ac_centralizada)
    {
        $request = Yii::$app->request;
        $model = new AcAcEspec();
        $model->id_ac_centr=$ac_centralizada; 
        $unidades_ejecutoras=ArrayHelper::map(UnidadEjecutora::find()->all(), 'id', 'nombre'); 


        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            { 
                return [
                    'title'=> "Crear nueva Acion Especifica",
                    'content'=>$this->renderAjax('_form', [
                        'model' => $model, 'unidades_ejecutoras'=>$unidades_ejecutoras,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                               Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
            else if($model->load($request->post()))
            {


                $uni_eje=$request->post('id_ue');
                $i=0;
                       
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try { 
                        if($model->save()){
                        // si salva el modelo padre, contamos las uej a guardar
                            while(count($request->post('id_ue'))!=$i)
                            {
                                //guardamos las uej, si ocurre algun error devuelve false
                                $salvar=$model->uejecutoras_crear($uni_eje[$i]);
                                $i++;
                                if(!$salvar)
                                {
                                    $transaction->rollback();
                                    $i=count($request->post('id_ue'));
                                    
                                }
                            }// termina el while
                            $transaction->commit();
                            return 
                            [
                                'forceReload'=>'true',
                                'contenedorUrl' => Url::to(['ac-ac-espec/index', 'ac_centralizada' => $model->id_ac_centr]),
                                'title'=> "Create new AcAcEspec",
                                'content'=>'<span class="text-success">Create AcAcEspec success</span>',
                                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                        Html::a('Crear Más',['create','ac_centralizada'=>$model->id_ac_centr],['class'=>'btn btn-primary','role'=>'modal-remote'])
                            ];
                        }
                        else
                        { // si falla el save de accion centralizada
                            return 
                            [
                                'title'=> "Crear nueva Acción Específica",
                                'content'=>$this->renderAjax('create', [
                                    'model' => $model,
                                    'unidades_ejecutoras'=>$unidades_ejecutoras
                                ]),
                                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                            Html::button('Crear',['class'=>'btn btn-primary','type'=>"submit"])
                    
                            ];         
                        }
                    } catch(Exception $e) 
                    {
                        $transaction->rollback();
                    }        
            }
            else
            {
                return 
                [
                    'title'=> "Create new AcAcEspec",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Crear',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }
        else
        {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) 
            {
                return $this->redirect(['view', 'id' => $model->id]);
            } 
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

  
       
    }

    /**
     * Updates an existing AcAcEspec model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
        $model_nuevo=$model;
       
        $unidades_ejecutoras=ArrayHelper::map(UnidadEjecutora::find()->all(), 'id', 'nombre'); 
        $verificar =ArrayHelper::map(AcEspUej::find()->where('id_ac_esp= :id', ['id'=>$model->id])->andwhere(['estatus' => 1])->all(),'id','id_ue');
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Modificando Accion Especifica #".$id,
                    'content'=>$this->renderAjax('_form', [
                    'model' => $this->findModel($id),
                    'unidades_ejecutoras'=>$unidades_ejecutoras,
                    'precarga'=>$verificar,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                       
                       $uni_eje=$request->post('id_ue');
                       $i=0;
                       $id_ac_esp=$request->post('AcEspUej');
                       $connection = \Yii::$app->db;
                       $transaction = $connection->beginTransaction();
                       try {
                        if($model->save()){
                       
                        $salvar=$model->uejecutoras($uni_eje);
                        $transaction->commit();

                
                // buscando las unidades ejecutoras relacionadas para mostrarla en la vista
                        $unidad_ejecutora=new AcEspUej;
                        $ue=$unidad_ejecutora->obtener_uej_relacionadas($model->id);
                

                return [
                    'forceReload'=>'true',
                    'contenedorUrl' => Url::to(['ac-ac-espec/index', 'ac_centralizada' => $model->id_ac_centr]),
                    'title'=> "Accion Especifica #".$id,
                    'content'=>$this->renderPartial('view', [
                    'model' => $this->findModel($id),
                    'rows' => $ue,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];

            }else{ //si falla la actulización padre
                return [
                    'title'=> "Update AcAcEspec #".$id,
                    'content'=>$this->renderAjax('_form', [
                    'model' => $model,
                    'unidades_ejecutoras'=>$unidades_ejecutoras,
                                     'precarga'=>$verificar,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
                ];

                }


                } catch(Exception $e) {
                $transaction->rollback();
                }    
                }else{
                 return [
                    'title'=> "Update AcAcEspec #".$id,
                    'content'=>$this->renderPartial('update', [
                    'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
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
                ]);
            }
        }
    }

    /**
     * Delete an existing AcAcEspec model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        //si es admin, puede borrar todo el proyecto
        $usuario = \Yii::$app->user;
        if($usuario->can('sysadmin'))
        {
            //metodo del modelo donde se borra todo lo relacionado con la accion especifica
            if($model->eliminarTodoEspecifica())
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
            //si existe alguna asignación o variable, no se podrá eliminar
            if((isset($model->idAccuej) && $model->idAccuej!=null) || (isset($model->accionVariables) && $model->accionVariables!=null))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo "\n<span class='text-danger'>Esta Acción Posee Asignaciones(Usuarios) o Variables asociadas.</span>";
                Yii::$app->end();
            }
            else
            {
                $model->delete();

                if($request->isAjax)
                {
                    /*
                    *   Process for ajax request
                    */
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['forceClose'=>true,'forceReload'=>'#especifica-pjax'];    
                }else
                {
                    /*
                    *   Process for non-ajax request
                    */
                    return $this->redirect(['index']);
                }
            }
        }
    }

     /**
     * Delete multiple existing AcAcEspec model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        $accion_centralizada="";
        
        foreach (AcAcEspec::findAll(json_decode($pks)) as $model) {
            $accion_centralizada=$model->id_ac_centr;
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
            return $this->redirect(['/accion_centralizada/view', 'id'=>$accion_centralizada]);
        }
       
    }

    
   
/**
     * Activar o desactivar un modelo
     * @param integer id
     * @return mixed
     */
    public function actionToggleActivo($id) 
    {
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model != null && $model->toggleActivo()) 
        {
            return ['forceClose' => true, 'forceReload' => 'true'];
        } 
        else 
        {
            return [
                'title' => 'Ocurrió un error.',
                'content' => '<span class="text-danger">No se pudo realizar la operación. Error desconocido</span>',
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
            return;
        }
    }

    /**
     * Accion para importar acciones especificas.
     * @param integer $accion_centralizada es el id de una accion central
     * @return mixed
     */
    public function actionImportar($accion_central)
    {
        $request = Yii::$app->request;
        $modelo = new UploadForm();

        if($request->isPost)
        {
            $archivo = file($_FILES['UploadForm']['tmp_name']['importFile']);
            $bandera=0;
            $contador=0;
            $mensaje="";
            $id_accion_especifica="";
           $connection = \Yii::$app->db;
                       $transaction = $connection->beginTransaction();
            try
            {
                foreach ($archivo as $llave => $valor) 
                {

                     $exploded = explode(';', str_replace('"', '',$valor));
                     
                    if($bandera==0)
                    {
                   

                    $ac = AcAcEspec::find()
                        ->where(['cod_ac_espe' => $exploded[0], 'id_ac_centr' => $accion_central])
                        ->one();

                    if($ac == null)
                    {
                        $ac = new AcAcEspec;


                    $ac->id_ac_centr= $accion_central;
                    $ac->cod_ac_espe = str_replace("'", "", $exploded[0]);
                    $ac->nombre = $exploded[1];
                    $ac->estatus = 0;
                    $ac->isNewRecord = true;
                    $ac->id= null;
                    $ac->save(false);

                    //guardando unidad ejecutora de esa accion especifica
                    //si existe unidades ejecutoras
                    $exploded[2]=str_replace("'", "",$exploded[2]);
                    if(isset($exploded[2]) && $exploded[2]>0 ){
                      
                        $bandera=1;
                        $contador=$exploded[2];
                        $id_accion_especifica=$ac->id;
                    }
                    }
                    else
                    {
                        $mensaje="Codigo De Accion Ya Existe";
                         
                    }
                    
                }
                else
                {
                    //print_r($exploded); exit();
                    $exploded[0]=str_replace("'","",$exploded[0]);
                    $exploded[0]=str_replace("\r\n","",$exploded[0]);

                    $ej = UnidadEjecutora::find()
                        ->where(['codigo_ue' => $exploded[0]])
                        ->one();
                        
                    if($ej != null)
                    {   

                        $ac_ej = new AcEspUej;

                    }
                    else
                    {
                        $mensaje="No Existe El Codigo De Unidad Ejecutora ". $exploded[0];

                    }
                    $ac_ej->id_ue = $ej['id'];
                    $ac_ej->id_ac_esp = $id_accion_especifica;
                    $ac_ej->save(false);
                    $contador=$contador-1;
                   
                    if($contador==0)
                    {
                        $bandera=0;
                    }
                }
            } //fin foreach
                
            $transaction->commit();
                
            Yii::$app->session->setFlash('importado', '<div class="alert alert-success">Registros importados exitosamente.</div>');
                return $this->refresh();

            }catch(\Exception $e){
              $transaction->rollBack();
                Yii::$app->session->setFlash('importado', '<div class="alert alert-danger">'.$mensaje.'</div>');
            }
                        
        }


        return $this->render('importar', [
            'modelo' => $modelo, 'accion_central'=> $accion_central,
        ]);
    }

    /**
     * Finds the AcAcEspec model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AcAcEspec the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AcAcEspec::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * operacion para activar las acciones especificas
     * @return mixed
     */
    public function actionBulkEstatusactivo()
    {        
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        
        
        foreach ($pks as $key) 
        {
        $model=$this->findModel($key);
        $model->activar();
        }
        

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
            return $this->redirect(['/ac-ac-espec/index']);
        }
       
    }


    /**
     * operacion para desactivar las acciones especificas
     * @return 
     */
    public function actionBulkEstatusdesactivo()
    {        
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        
        
        foreach ($pks as $key) 
        {
        
            $model=$this->findModel($key);
            $model->desactivar();
        
        }
        
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
            return $this->redirect(['/ac-ac-espec/index']);
        }
       
    }


    /**
     * operacion para revertir algun cambio hecho al modelo
     * @param integer $id
     * @return Mixed
     */
    public function actionRevertir($id)
    {
        // buscamos los modelos
        $post1 = AuditTrail::findOne($id);
        $post=AcAcEspec::findOne($post1->model_id);

        //si esta vacio el modelo es por que fue borrado
        if($post!=null)
        {
        //buscamos la ultima version
        $attributes = Version::lastVersion($post->className(), $post->id);
        //cargamos los datos de la ultima version
        $post = Version::find($post->className(), $post->id, $attributes);
        
        //solo para el caso de modelos que tenga fecha, formatear la fecha
        $post->fecha_inicio = date_create($post->fecha_inicio);
        $post->fecha_fin = date_create($post->fecha_fin);

        $post->fecha_inicio=date_format($post->fecha_inicio, 'Y-m-d');
        $post->fecha_fin=date_format($post->fecha_fin, 'Y-m-d');
        }
        else
        {
        //en que caso que fue borrado se busca la ultima version por medio del  id almacenado en el modelo trail
        $attributes = Version::lastVersion(AcAcEspec::className(), $post1->model_id);

        //cargamos los datos 
        $post = Version::find(AcAcEspec::className(), $post1->model_id, $attributes);
        
        
        //solo en caso de modelos q tengan fecha
        $post->fecha_inicio = date_create($post->fecha_inicio);
        $post->fecha_fin = date_create($post->fecha_fin);

        $post->fecha_inicio=date_format($post->fecha_inicio, 'Y-m-d');
        $post->fecha_fin=date_format($post->fecha_fin, 'Y-m-d');

        }
        if(!$post->save())
        {
        
        return $this->redirect('index.php?r=audit/trail');
            
        }
        else
        {
            return $this->redirect('index.php?r=audit/trail');
             
        }
           

        }

}
