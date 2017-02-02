<?php

namespace backend\controllers;

use Yii;
use backend\models\LocalizacionAccVariable;
use backend\models\AccionCentralizadaVariables;
use backend\models\LocalizacionAccVariableSearch;
use frontend\models\AccionCentralizadaVariableEjecucion;
use common\models\Pais;
use common\models\Estados;
use common\models\Municipio;
use common\models\Parroquia;
use common\models\AccionCentralizadaVariableProgramacion;
use common\models\Ambito;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
/**
 * LocalizacionAccVariableController implements the CRUD actions for LocalizacionAccVariable model.
 */
class LocalizacionAccVariableController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all LocalizacionAccVariable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocalizacionAccVariableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LocalizacionAccVariable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $model=$this->findModel($id);
        $model1= AccionCentralizadaVariableProgramacion::find()->where(['id_localizacion' => $model->id])->One();
        $model2= AccionCentralizadaVariables::find($model->id_variable)->One();
        $request = Yii::$app->request;
        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return 
            [
                'title' => 'Localización Y Programación De Variable',
                'content'=>$this->renderAjax('view', 
                [
                    'model' => $model,
                    'model1' => $model1,
                ]),
                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id, 'variable' => $model->id_variable, 'localizacion' => $model2->localizacion,],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];    
        }
        else
        {
            return $this->render('view', 
            [
                'model' => $model, 
                'model1'=> $model1,
            ]);
        }
    }

    /**
     * Creates a new LocalizacionAccVariable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $variable, $localizacion
     * @return mixed
     */
    public function actionCreate($variable,$localizacion)
    {
        $request = Yii::$app->request;
        $ACVariable=AccionCentralizadaVariables::findOne($variable);
        $model = new LocalizacionAccVariable();
        $model1= new AccionCentralizadaVariableProgramacion();

        $model->id_variable=$variable;
        //Escenario
        $model->scenario = $ACVariable->ambito->ambito;
        $model->id_pais = Pais::findOne(['nombre'=>'Venezuela'])->id;
        //lista desplegable
        $pais = Pais::find()->where(['nombre'=>'Venezuela'])->all();
        $estados = Estados::find()->all();
        $municipios = Municipio::find()->all();
        $parroquias = Parroquia::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Localización Y Programación Mensual",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'pais' => $pais,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'model1' => $model1,
                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
            if($model->load($request->post()))
            {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try 
                {
                    if($model->save())
                    {
                        //guardando el modelo programacion
                        $model1->id_localizacion=$model->id;
                        if( $model1->load($request->post()) && $model1->save())
                        {
                            $transaction->commit();
                            return [
                                'forceReload'=>'true',                   
                                'title'=> "Localización y Programación",

                                'content'=>'<span class="text-success">Create VariableLocalizacion success</span>',
                                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                        Html::a('Create More',['create', 'variable' => $variable,
                                'localizacion' => $localizacion],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    
                            ];
                        }
                        else
                        {
                            $transaction->rollBack();
                            return 
                            [
                                'title'=> "Localización y Programación",
                                'content'=>$this->renderAjax('create', [
                                    'model' => $model,
                                    'pais' => $pais,
                                    'estados' => $estados,
                                    'municipios' => $municipios,
                                    'parroquias' => $parroquias,
                                    'model1' => $model1,

                                    
                                ]),
                                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                            ];         

                        }
                    }
                    else
                    {
                        $transaction->rollBack();
                        return 
                        [
                            'title'=> "Localización y Programación",
                            'content'=>$this->renderAjax('create', [
                                'model' => $model,
                                'pais' => $pais,
                                'estados' => $estados,
                                'municipios' => $municipios,
                                'parroquias' => $parroquias,
                                'model1' => $model1,
                            ]),
                            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                        ];                        
                    }
                }
                catch (\Exception $e)
                {
                    $transaction->rollBack();
                    throw $e;
                }
            }
            else
            {
                return 
                [
                    'title'=> "Localización",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'pais' => $pais,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'model1' => $model1,

                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        } 
        else
        {
            
            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                //return $this->redirect(['create', 'id' => $model->id]);
                return $this->redirect(['accion-centralizada-variable-programacion/create',  'id_localizacion' => $model->id]);
            } 
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                    'pais' => $paises,
                    'estados' => $estados,
                    'municipios' => $municipios,
                    'parroquias' => $parroquias,
                    'model1' => $model1,
                ]);
            }

        }
    }

    /**
     * Updates an existing LocalizacionAccVariable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id, $variable, $localizacion
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model1= AccionCentralizadaVariableProgramacion::find()->where(['id_localizacion' => $model->id])->One();
        //Escenario
        $model->scenario = $model->idVariable->ambito->ambito;
        //lista desplegable
        $paises = Pais::find()->where(['nombre'=>'Venezuela'])->all();
        $estados = Estados::find()->all();
        $municipios = Municipio::find()->where(['id_estado'=> $model->id_estado])->all();
        $parroquias = Parroquia::find()->where(['id_municipio' => $model->id_municipio])->all();

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            {
                return [
                    'title'=> "Localización y Programación",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'pais' => $paises,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'model1' => $model1,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
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
                            //guardando el modelo programacion
                            $model1->id_localizacion=$model->id;
                            if( $model1->load($request->post()) && $model1->save())
                            {
                                $transaction->commit();
                                return [
                                    'forceReload'=>'true',                   
                                    'title'=> "Localización y Programación",
                                    'content'=>$this->renderAjax('view', [
                                    'model' => $model,
                                    'model1' => $model1,
                                    'id' => $model->id,
                                    ]),
                                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::a('Editar',['update', 'id' => $model->id, 'variable' => $model->id_variable, 'localizacion' => $model->idVariable->localizacion,],['class'=>'btn btn-primary','role'=>'modal-remote'])
                                ];
                            }
                            else
                            {
                                $transaction->rollBack();
                                return 
                                [
                                    'title'=> "Localización y Programación",
                                    'content'=>$this->renderAjax('create', [
                                        'model' => $model,
                                        'pais' => $pais,
                                        'estados' => $estados,
                                        'municipios' => $municipios,
                                        'parroquias' => $parroquias,
                                        'model1' => $model1,
                                    ]),
                                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                            Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                                ];         

                            }
                        }
                        else
                        {
                            $transaction->rollBack();
                            return 
                            [
                                'title'=> "Localización y Programación",
                                'content'=>$this->renderAjax('create', [
                                    'model' => $model,
                                    'pais' => $pais,
                                    'estados' => $estados,
                                    'municipios' => $municipios,
                                    'parroquias' => $parroquias,
                                    'model1' => $model1,
                                ]),
                                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                            Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                            ];                        
                        }
                    }
                    catch (\Exception $e)
                    {
                        $transaction->rollBack();
                        throw $e;
                    }
                }
                else
                {
                    return 
                    [
                        'title'=> "Localización",
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                            'pais' => $pais,
                            'estados' => $estados,
                            'municipios' => $municipios,
                            'parroquias' => $parroquias,
                            'model1' => $model1,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
            
                    ];         
                }
            }
        }
        else 
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                    'pais' => $paises,
                    'estados' => $estados,
                    'municipios' => $municipios,
                    'parroquias' => $parroquias,
                    'model1' => $model1,
                ]);
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
            return $this->redirect(['/accion_centralizada_variables/index']);
        }
       
    }



    /**
     * Deletes an existing LocalizacionAccVariable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $bandera=0; //variable para determinar si ha ocurrido una ejecucion
        
        $programacion= AccionCentralizadaVariableProgramacion::find()->where(['id_localizacion' => $model->id])->one();
        if(isset($programacion) && $programacion!=null)
        {
            $usuario = \Yii::$app->user; //el admin no debe ser restringido
            if($usuario->can('sysadmin'))
            {
                //metodo del modelo donde se borra todo lo relacionado con la accion central
                if($model->eliminarTodoLocalizacion())
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
            }//fin admin
            else
            {
                //si existe alguna ejecucion de la programacion no se podrá eliminar
                $modelojecucion=AccionCentralizadaVariableEjecucion::find()->where(['id_programacion'=> $programacion->id])->One();
                if($modelojecucion!=null)
                {
                    $bandera=1;
                }
                
                if($bandera==1)
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    echo "\n<span class='text-danger'>Esta localización tiene una Ejecución asociada.</span>";
                    Yii::$app->end();
                }
                else
                {
                    //borrar programaciones
                    AccionCentralizadaVariableProgramacion::findOne($programacion->id)->delete();
                    //borrar localizacion
                    $this->findModel($id)->delete();
                    
                    if($request->isAjax)
                    {
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
            }//fin del else
        }
        else
        {
            $this->findModel($id)->delete();
        }

    }

    /**
     * Finds the LocalizacionAccVariable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LocalizacionAccVariable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LocalizacionAccVariable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
