<?php

namespace backend\controllers;

use Yii;
use backend\models\LocalizacionAccVariable;
use backend\models\AccionCentralizadaVariables;
use backend\models\LocalizacionAccVariableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Pais;
use common\models\Estados;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\AccionCentralizadaVariableProgramacion;
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
        $model = new LocalizacionAccVariable();
        $model1= new AccionCentralizadaVariableProgramacion();

        $model->id_variable=$variable;
        //Escenario
        $model->scenario = ($localizacion=='0' ? 'Nacional' : 'Estadal');
        $model->id_pais = Pais::findOne(['nombre'=>'Venezuela'])->id;
        //lista desplegable
        $paises = Pais::find()->all();
        $estados = Estados::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Localización Y Programación Mensual",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        'pais' => $paises,
                        'estados' => $estados,
                        'model1' => $model1,
                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model1->id_localizacion=$model->id;
                if( $model1->load($request->post()) && $model1->save()){
                return [
                    'forceReload'=>'true',                   
                    'title'=> "Localización y Programación",

                    'content'=>'<span class="text-success">Create VariableLocalizacion success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create', 'variable' => $variable,
                    'localizacion' => $localizacion],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];}else{
                    
                    return [
                    'title'=> "Localización y Programación",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'pais' => $paises,
                        'estados' => $estados,
                        'model1' => $model1,

                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         

                }
            }else{           
                  return [
                    'title'=> "Localización",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'pais' => $paises,
                        'estados' => $estados,
                        'model1' => $model1,

                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        } else{
            
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['create', 'id' => $model->id]);
            return $this->redirect(['accion-centralizada-variable-programacion/create',  'id_localizacion' => $model->id]);
            } else {
            return $this->render('create', [
                'model' => $model,
                'pais' => $paises,
                'estados' => $estados,
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
        
        $model->scenario = ($localizacion=='0' ? 'Nacional' : 'Estadal');

        //lista desplegable
        $paises = Pais::find()->all();
        $estados = Estados::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Localización y Programación",
                    'content'=>$this->renderPartial('update', [
                        'model' => $model,
                        'pais' => $paises,
                        'estados' => $estados,
                        'model1' => $model1,
                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model1->id_localizacion=$model->id;
                if( $model1->load($request->post()) && $model1->save()){
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
        
                ];}else{
                    
                    return [
                    'title'=> "Localización y Programación",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'pais' => $paises,
                        'estados' => $estados,
                        'model1' => $model1,

                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         

                }
            }else{           
                  return [
                    'title'=> "Localización",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'pais' => $paises,
                        'estados' => $estados,
                        'model1' => $model1,

                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        $this->findModel($id)->delete();

        $request = Yii::$app->request;
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'true']; 
        }else{

        return $this->redirect(['/accion_centralizada_variables/index']);
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
