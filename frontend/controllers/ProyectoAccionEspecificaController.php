<?php

namespace frontend\controllers;

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
use common\models\ProyectoAcLocalizacion;
use common\models\ProyectoAcLocalizacionSearch;
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

        $html = $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        return Json::encode($html);
    }

    /**
     * Displays a single ProyectoAccionEspecifica model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $localizaciones=new ProyectoAcLocalizacionSearch(['id_proyecto_ac' => $id]);
        $dataProvider = $localizaciones->search(Yii::$app->request->queryParams);
        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return 
                [
                    'title'=> "Accion Específica",
                    'content'=>$this->renderPartial('view', 
                    [
                        'model' => $this->findModel($id),
                        'localizaciones' => $dataProvider,
                        'search' => $localizaciones
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }
        else
        {
            return $this->render('view', 
            [
                'model' => $this->findModel($id),
                'localizaciones' => $localizaciones,
                'search' => $localizaciones
            ]);
        }
    }

    /**
     * Creates a new ProyectoAccionEspecifica model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($proyecto)
    {
        $request = Yii::$app->request;
        $model = new ProyectoAccionEspecifica();
        $model2= new ProyectoAcLocalizacion();
        $model->id_proyecto = $proyecto;
        $model->estatus = 1;
        $model->ambito=$model->idProyecto->ambito;
        //lista desplegable
        $unidadEjecutora = UnidadEjecutora::find()->all();
        $unidadMedida = UnidadMedida::find()->all();
        $fuenteFinanciamiento = FuenteFinanciamiento::find()->all();
        //id del pais
        if($model->idProyecto->proyectoLocalizacion)
        {
            $model2->id_pais=$model->idProyecto->proyectoLocalizacion[0]->id_pais;
        }
        else
        {
            $model2->id_pais=null;
        }
        //Escenario
        $model2->scenario = Ambito::findOne(['id'=>$model->ambito])->ambito;
        
        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            {
                return [
                    'title'=> "Nueva Acción Específica",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'unidadEjecutora' => $unidadEjecutora,
                        'unidadMedida' => $unidadMedida,
                        'fuenteFinanciamiento' => $fuenteFinanciamiento,
                        'model2' => $model2,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Crear',['class'=>'btn btn-success','type'=>"submit"])
        
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
                            
                            //si salva  la accion intentamos salvar su localizacion del modelo ProyectoAcLocalizacion
                            $model2->id_proyecto_ac=$model->id;
                            if(!$salvar=$model2->guardarLocalizacion($request->post()))
                            {
                                $transaction->rollback();
                                //caso de error al intentar guardar localizacion
                                return 
                                [
                                    'title'=> "Nueva Acción Específica",
                                    'content'=>$this->renderAjax('create', 
                                    [
                                        'model' => $model,
                                        'unidadEjecutora' => $unidadEjecutora,
                                        'unidadMedida' => $unidadMedida,
                                        'fuenteFinanciamiento' => $fuenteFinanciamiento,
                                        'model2' => $model2,
                                    ]),
                                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).Html::button('Crear',['class'=>'btn btn-success','type'=>"submit"])
                                ];
                            }
                            else
                            {
                                //caso Exitoso
                                $transaction->commit();
                                return
                                [
                                    'forceReload'=>'#especifica-pjax',
                                    'title'=> "Nueva Acción Específica",
                                    'content'=>'<span class="text-success">Creada exitosamente.</span>',
                                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                            Html::a('Crear otra',['create', 'proyecto' => $proyecto],['class'=>'btn btn-primary','role'=>'modal-remote'])
                                ];
                            }
                        }
                        else
                        {
                           //caso de error al intentar guardar maestro
                            return [
                                'title'=> "Nueva Acción Específica",
                                'content'=>$this->renderAjax('create', [
                                    'model' => $model,
                                    'unidadEjecutora' => $unidadEjecutora,
                                    'unidadMedida' => $unidadMedida,
                                    'fuenteFinanciamiento' => $fuenteFinanciamiento,
                                    'model2' => $model2,
                                ]),
                                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).Html::button('Crear',['class'=>'btn btn-success','type'=>"submit"])
                            ];

                        };

                    } catch(Exception $e) 
                    {
                        $transaction->rollback();
                    };
                            
                }
                else
                {   //caso de error al cargar parametros
                    return 
                    [
                        'title'=> "Nueva Acción Específica",
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                            'unidadEjecutora' => $unidadEjecutora,
                            'unidadMedida' => $unidadMedida,
                            'fuenteFinanciamiento' => $fuenteFinanciamiento,
                            'model2' => $model2,
                        ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).Html::button('Crear',['class'=>'btn btn-success','type'=>"submit"])
            
                    ];         
                }
            }
        }else{
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
                    'unidadEjecutora' => $unidadEjecutora,
                    'unidadMedida' => $unidadMedida,
                    'fuenteFinanciamiento' => $fuenteFinanciamiento,
                    'model2' => $model2,
                ]);
            }
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
        $modelodata = ProyectoAcLocalizacion::find()->where(['id_proyecto_ac' => $model->id])->all();
        $id_estados[]="";
        $id_municipio[]="";
        $id_parroquia[]="";
        foreach ($modelodata as $key => $value) 
        {
            $id_estados[]=$value->id_estado;
            $id_municipio[]=$value->id_estado."-".$value->id_municipio;
            $id_parroquia[]=$value->id_estado."-".$value->id_municipio."-".$value->id_parroquia;
        }
        $model2= new ProyectoAcLocalizacion();
        $model2->id_estado=$id_estados;
        $model2->id_municipio=$id_municipio;
        $model2->id_parroquia=$id_parroquia;
        //Escenario
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
                                //si salva el modelo principal intentamos salvar los cambios al modelo de ProyectoAcLocalizacion
                                $salvar=$model2->modificarLocalizacion($request->post(),$model->id, $model2->scenario, $model2->id_pais);
                                if($salvar)
                                {   
                                    $transaction->commit();
                                    $localizaciones=new ProyectoAcLocalizacionSearch(['id_proyecto_ac' => $model->id]);
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
                                'model2' => $model2,
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
        //si es admin, puede borrar todo el proyecto
        $usuario = \Yii::$app->user;
        if($usuario->can('sysadmin'))
        {
            //metodo del modelo donde se borra todo lo relacionado con el proyecto
            if($model->eliminarAccionTodo())
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
            if((isset($model->asignacion) && $model->asignacion!=null) || (isset($model->variable) && $model->variable!=null))
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
     * Delete multiple existing ProyectoAccionEspecifica model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        //si es admin, puede borrar todo el proyecto
        $error=1;
        $usuario = \Yii::$app->user;
        $pks = explode(',',$request->post('pks')); // arreglo o llave primaria
        foreach ($pks as $keys)
        {
            $model=$this->findModel($keys);
            //si existe alguna asignación o variable, no se podrá eliminar
            if((isset($model->asignacion) && $model->asignacion!=null) || (isset($model->variable) && $model->variable!=null))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo "\n<span class='text-danger'>Esta Acción Posee Asignaciones(Usuarios) o Variables asociadas.</span>";
                Yii::$app->end();
            }
            else
            {
                if(!$model->delete())
                {
                    $error=0;
                }
                
            }
        }//fin del foreach
        

        if($error==1)
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
