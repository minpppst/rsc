<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;

use common\models\ProyectoAccionEspecifica;
use common\models\ProyectoAccionEspecificaSearch;
use common\models\UnidadMedida;
use common\models\FuenteFinanciamiento;
use common\models\UnidadEjecutora;
use common\models\Ambito;
use common\models\ProyectoACLocalizacion;
use common\models\ProyectoACLocalizacionSearch;
use app\models\Pais;
use app\models\Estados;
use app\models\Municipio;
use app\models\Parroquia;
/**
 * ProyectoAccionEspecificaController implements the CRUD actions for ProyectoAccionEspecifica model.
 */
class ProyectoAccionEspecificaController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all ProyectoAccionEspecifica models.
     * @return mixed
     */
    public function actionIndex($proyecto)
    {    
        $searchModel = new ProyectoAccionEspecificaSearch(['id_proyecto'=>$proyecto]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $html = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        return Json::encode($html);
        //return $html;
    }


    /**
     * Displays a single ProyectoAccionEspecifica model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $localizaciones=new ProyectoAClocalizacionSearch(['id_proyecto_ac' => $id]);
        $dataProvider = $localizaciones->search(Yii::$app->request->queryParams);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Accion Especfica #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                        'localizaciones' => $dataProvider,
                        'search' => $localizaciones
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'localizaciones' => $dataProvider,
                'search' => $localizaciones
            ]);
        }
    }


    /**
     * Updates an existing ProyectoAccionEspecifica model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        //formateando fechas
        $model->fecha_inicio=date('d/m/Y',strtotime($model->fecha_inicio));
        $model->fecha_fin=date('d/m/Y',strtotime($model->fecha_fin));
        //lista desplegable y datos del select2
        $unidadEjecutora = UnidadEjecutora::find()->all();
        $unidadMedida = UnidadMedida::find()->all();
        $fuenteFinanciamiento= fuenteFinanciamiento::find()->all();
        $modelodata = ProyectoACLocalizacion::find()->where(['id_proyecto_ac' => $model->id])->all();
        $id_estados[]="";
        $id_municipio[]="";
        $id_parroquia[]="";
        foreach ($modelodata as $key => $value) 
        {
            $id_estados[]=$value->id_estado;
            $id_municipio[]=$value->id_municipio;
            $id_parroquia[]=$value->id_parroquia;
        }
        //Escenario
        $model2= new ProyectoACLocalizacion();
        $model2->scenario = Ambito::findOne(['id'=>$model->ambito])->ambito;
        //cargando pais
        if($model->idProyecto->proyectoLocalizacion)
        {
            $model2->id_pais=$model->idProyecto->proyectoLocalizacion[0]->id_pais;//key($pais);
        }
        else
        {
            $model2->id_pais=null;
        }
        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            {
                return [
                    'title'=> "Editar Acción Específica #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'unidadEjecutora' => $unidadEjecutora,
                        'unidadMedida' => $unidadMedida,
                        'fuenteFinanciamiento' => $fuenteFinanciamiento,
                        'model2' => $model2,
                        'id_estado' => $id_estados,
                        'id_municipio' => $id_municipio,
                        'id_parroquia' => $id_parroquia
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
            else
            {
                    if($model->load($request->post()))
                    {
                        
                        $connection = \Yii::$app->db;
                        $transaction = $connection->beginTransaction();
                        try 
                        {
                            
                            if($model->save())
                            {
                                //si salva el modelo principal intentamos salvar los cambios al modelo de proyectoAClocalizacion
                                $salvar=$model2->modificarLocalizacion($request->post(),$model->id, $model2->scenario, $model2->id_pais);
                                if($salvar)
                                {   
                                    $transaction->commit();
                                    $localizaciones=new ProyectoAClocalizacionSearch(['id_proyecto_ac' => $model->id]);
                                    $dataProvider = $localizaciones->search(Yii::$app->request->queryParams);
                                    //retorna exitoso
                                    return  
                                    [
                                        'forceReload'=>'#especifica-pjax',
                                        'title'=> "Editar Acción Específica #".$id,
                                        'content'=>$this->renderAjax('view', [
                                            'id' => $model->id,
                                            'model' => $model,
                                            'localizaciones' => $dataProvider,
                                            'search' => $localizaciones
                                            
                                        ]),
                                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                                Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                                    ];
                                }
                                else
                                {   
                                    $transaction->rollback();
                                    //error al intentar salvar modelo hijo localizacion
                                    return 
                                    [
                                        'title'=> "Update ProyectoAccionEspecifica #".$id,
                                        'content'=>$this->renderAjax('update', 
                                        [
                                            'model' => $model,
                                            'unidadEjecutora' => $unidadEjecutora,
                                            'unidadMedida' => $unidadMedida,
                                            'fuenteFinanciamiento' => $fuenteFinanciamiento,
                                            'model2' => $model2,
                                            'id_estado' => $id_estados,
                                            'id_municipio' => $id_municipio,
                                            'id_parroquia' => $id_parroquia
                                        ]),
                                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                                    Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                                    ];        

                                }

                            }
                            else
                            {
                                //error al salvar modelo padre accion especifica
                                    return 
                                    [
                                        'title'=> "Update ProyectoAccionEspecifica #".$id,
                                        'content'=>$this->renderAjax('update', 
                                        [
                                            'model' => $model,
                                            'unidadEjecutora' => $unidadEjecutora,
                                            'unidadMedida' => $unidadMedida,
                                            'fuenteFinanciamiento' => $fuenteFinanciamiento,
                                            'model2' => $model2,
                                            'id_estado' => $id_estados,
                                            'id_municipio' => $id_municipio,
                                            'id_parroquia' => $id_parroquia
                                        ]),
                                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                                    Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                                    ];        

                            };
                        } catch(Exception $e) 
                        {
                            $transaction->rollback();
                        };

                    } 
                    else
                    {   //error al intentar cargar parametros
                        return [
                            'title'=> "Update ProyectoAccionEspecifica #".$id,
                            'content'=>$this->renderAjax('update', [
                                'model' => $model,
                                'unidadEjecutora' => $unidadEjecutora,
                                'unidadMedida' => $unidadMedida,
                                'fuenteFinanciamiento' => $fuenteFinanciamiento,
                                'ambito' => $ambito
                            ]),
                            'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                        Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                        ];        
                    }
            }
        }
        else
        {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'unidadEjecutora' => $unidadEjecutora,
                    'unidadMedida' => $unidadMedida
                ]);
            }
        }
    }

    /**
     * Delete an existing ProyectoAccionEspecifica model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $proyecto = $model->id_proyecto;
        $model->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#especifica-pjax'];    
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing ProyectoAccionEspecifica model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (ProyectoAccionEspecifica::findAll(json_decode($pks)) as $model) {
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
            return [
                'forceClose' => true, 
                'forceReload' => '#especifica-pjax',
            ];
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
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar($id_proyecto) {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = ProyectoAccionEspecifica::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->desactivar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose' => true, 
                'forceReload' => '#especifica-pjax',
            ];
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
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar($id_proyecto) {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = ProyectoAccionEspecifica::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->activar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
            'forceClose' => true, 
            'forceReload' => '#especifica-pjax',
            ];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the ProyectoAccionEspecifica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoAccionEspecifica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoAccionEspecifica::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
