<?php

namespace backend\controllers;

use Yii;
use backend\models\ProyectoVariableResponsable;
use backend\models\ProyectoVariableResponsableSearch;
use common\models\UnidadEjecutora;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ProyectoVariableResponsableController implements the CRUD actions for ProyectoVariableResponsable model.
 */
class ProyectoVariableResponsableController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
   public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all ProyectoVariableResponsable models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProyectoVariableResponsableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ProyectoVariableResponsable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ProyectoVariableResponsable #".$id,
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
     * Creates a new ProyectoVariableResponsable model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_variable)
    {
        $request = Yii::$app->request;
        $model = new ProyectoVariableResponsable();
        $model->id_variable=$id_variable;
        $modeluej=UnidadEjecutora::find()->all(); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new ProyectoVariableResponsable",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'modeluej' => $modeluej,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#responsable-data',
                    'title'=> "Create new ProyectoVariableResponsable",
                    'content'=>'<span class="text-success">Create ProyectoVariableResponsable success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new ProyectoVariableResponsable",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'modeluej' => $modeluej,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['proyecto-variables/view', 'id' => $model->id_variable]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'modeluej' => $modeluej,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProyectoVariableResponsable model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modeluej=UnidadEjecutora::find()->all(); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update ProyectoVariableResponsable #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'modeluej' => $modeluej,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#responsable-data',
                    'title'=> "ProyectoVariableResponsable #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'modeluej' => $modeluej,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update ProyectoVariableResponsable #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'modeluej' => $modeluej,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
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
                    'modeluej' => $modeluej,
                ]);
            }
        }
    }

    /**
     * Delete an existing ProyectoVariableResponsable model.
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
        }else
        {
            /*
            *   Process for non-ajax request
            */
            //return $this->redirect(['index']);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#responsable'];
        }


    }
    
    /**
     * Delete an existing ProyectoVariableResponsable model.
     * For ajax request will return json object
     * @param integer $id
     * @return mixed
     */
    public function actionDelete2($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceReload'=>'#responsable-data'];
        }


    }

     /**
     * Delete multiple existing ProyectoVariableResponsable model.
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
     * Finds the ProyectoVariableResponsable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoVariableResponsable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoVariableResponsable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
