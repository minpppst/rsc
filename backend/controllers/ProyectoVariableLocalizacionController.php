<?php

namespace backend\controllers;

use Yii;
use backend\models\ProyectoVariableLocalizacion;
use backend\models\ProyectoVariableLocalizacionSearch;
use backend\models\ProyectoVariables;
use backend\models\ProyectoVariableProgramacion;
use common\models\ProyectoVariableEjecucion;
use common\models\Pais;
use common\models\Estados;
use common\models\Municipio;
use common\models\Parroquia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * ProyectoVariableLocalizacionController implements the CRUD actions for ProyectoVariableLocalizacion model.
 */
class ProyectoVariableLocalizacionController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all ProyectoVariableLocalizacion models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProyectoVariableLocalizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ProyectoVariableLocalizacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $model=$this->findModel($id);
        $model1=ProyectoVariableProgramacion::find()->where(['id_localizacion' => $model->id])->One();
        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return 
            [
                'title'=> "ProyectoVariableLocalizacion #".$id,
                'content'=>$this->renderAjax('view', 
                [
                    'model' => $model,
                    'model1' => $model1,
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
     * Creates a new ProyectoVariableLocalizacion model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_variable)
    {
        $request = Yii::$app->request;
        $model = new ProyectoVariableLocalizacion();
        $model1= new ProyectoVariableProgramacion();
        $variablemodel=ProyectoVariables::findOne($id_variable);
        $model->scenario=$variablemodel->ambito->ambito;
        $model->id_variable=$id_variable;

        //para esta logica siempre sera venezuela el pais.
        $model->id_pais=Pais::findOne(['nombre'=>'Venezuela'])->id;
        
        $pais = Pais::find()->where(['nombre'=>'Venezuela'])->all();
        $estados = Estados::find()->all();
        $municipios = Municipio::find()->all();
        $parroquias = Parroquia::find()->all();

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Localización y Programación",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'pais' => $pais,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'model1' => $model1,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Crear',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];
            }
            else
            {
                //transaction para guardar dos modelos localizacion y programacion
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                if($model->load($request->post()) && $model->save())
                {
                    $model1->id_localizacion=$model->id;
                    if( $model1->load($request->post()) && $model1->save())
                    {   
                        $transaction->commit();
                        return 
                        [
                            'forceReload'=>'true',
                            'title'=> "Create Localización y Programación",
                            'content'=>'<span class="text-success">Creada Locazación y Programacion</span>',
                            'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).Html::a('Crear Más',['create', 'id_variable' => $model->id_variable],['class'=>'btn btn-primary','role'=>'modal-remote'])
                        ];
                    }
                    else
                    {
                        $transaction->rollback();
                        return 
                        [
                            'title'=> "Crear Localización y Programación",
                            'content'=>$this->renderAjax('create', 
                            [
                                'model' => $model,
                                'pais' => $pais,
                                'estados' => $estados,
                                'municipios' => $municipios,
                                'parroquias' => $parroquias,
                                'model1' => $model1,
                            ]),
                            'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).Html::button('Crear',['class'=>'btn btn-primary','type'=>"submit"])
                        ]; 
                    }
                }else{ 
                    $transaction->rollback();
                    return [
                        'title'=> "Crear Localización y Programación",
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                            'pais' => $pais,
                            'estados' => $estados,
                            'municipios' => $municipios,
                            'parroquias' => $parroquias,
                            'model1' => $model1,
                        ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button('Crear',['class'=>'btn btn-primary','type'=>"submit"])
            
                    ];         
                }
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
                    'pais' => $pais,
                    'estados' => $estados,
                    'municipios' => $municipios,
                    'parroquias' => $parroquias,
                    'model1' => $model1,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProyectoVariableLocalizacion model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $variablemodel=ProyectoVariables::findOne($model->id_variable);
        $model->scenario=$variablemodel->ambito->ambito;
        $model1= ProyectoVariableProgramacion::find()->where(['id_localizacion'=> $model->id])->One();
        $pais = Pais::find()->where(['nombre'=>'Venezuela'])->all();
        $estados = Estados::find()->all();
        $municipios= Municipio::find()->where(['id_estado' => $model->id_estado])->all();
        $parroquias= Parroquia::find()->where(['id_municipio' => $model->id_municipio])->all();
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update ProyectoVariableLocalizacion #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'pais' => $pais,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'model1' => $model1,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save())
            {
                $model1->id_localizacion=$model->id;
                if( $model1->load($request->post()) && $model1->save())
                {
                    return 
                    [
                        'forceReload'=>'true',
                        'title'=> "ProyectoVariableLocalizacion #".$model->id,
                        'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'model1' => $model1,
                        ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                }
                else
                {
                    return 
                    [
                        'title'=> "Create new ProyectoVariableLocalizacion",
                        'content'=>$this->renderAjax('update', 
                        [
                            'model' => $model,
                            'pais' => $pais,
                            'estados' => $estados,
                            'municipios' => $municipios,
                            'parroquias' => $parroquias,
                            'model1' => $model1,
                        ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
                    ]; 
                }
            }else
            {
                return [
                    'title'=> "Update ProyectoVariableLocalizacion #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'pais' => $pais,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'model1' => $model1,
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
                    'pais' => $pais,
                    'estados' => $estados,
                    'municipios' => $municipios,
                    'parroquias' => $parroquias,
                    'model1' => $model1,
                ]);
            }
        }
    }

    /**
     * Delete an existing ProyectoVariableLocalizacion model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $bandera=0; //variable para determinar si ha ocurrido una ejecucion
        $programacion= ProyectoVariableProgramacion::find()->where(['id_localizacion' => $model->id])->One();
        //si existe alguna ejecucion de la programacion no se podrá eliminar
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
                $modelojecucion=ProyectoVariableEjecucion::find()->where(['id_programacion'=> $programacion->id])->One();
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
                    ProyectoVariableProgramacion::findOne($programacion->id)->delete();
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
            }//fion del else de no admin
        }//fin de existe programacion
    }

     /**
     * Delete multiple existing ProyectoVariableLocalizacion model.
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
     * Finds the ProyectoVariableLocalizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoVariableLocalizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoVariableLocalizacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Busca los municipios model basado en el id de estado.
     * @return json con los municipios
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEstadomunicipios() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) 
        {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) 
            {
                $estado = $parents[0];
                $out = Municipio::find()->select(['id', 'nombre as name'])->asArray()->orderby('nombre')->where(['id_estado' => $estado])->all();
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Busca las  Parroquias model basado en el id de Municipio.
     * @return json con las parroquias
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMunicipiosparroquias() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) 
            {
                $muni_id = $parents[0];
                $out = Parroquia::find()->select(['id', 'nombre as name'])->asArray()->orderby('nombre')->where(['id_municipio' =>$muni_id])->all();
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
}
