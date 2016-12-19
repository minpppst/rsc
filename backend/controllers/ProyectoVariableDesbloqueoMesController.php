<?php

namespace backend\controllers;

use Yii;
use backend\models\ProyectoVariableDesbloqueoMes;
use backend\models\ProyectoVariableDesbloqueoMesSearch;
use common\models\ProyectoVariableEjecucion;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ProyectoVariableDesbloqueoMesController implements the CRUD actions for ProyectoVariableDesbloqueoMes model.
 */
class ProyectoVariableDesbloqueoMesController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all ProyectoVariableDesbloqueoMes models. por localizacion
     *integer $id
     * @return mixed
     */
    public function actionIndex($id)
    {    
        
        $searchModel = new ProyectoVariableDesbloqueoMesSearch();
        $ejecucion=ProyectoVariableEjecucion::find()
        ->innerjoin('proyecto_variable_programacion', 'proyecto_variable_programacion.id=proyecto_variable_ejecucion.id_programacion')
        ->where(['proyecto_variable_programacion.id_localizacion' => $id])->one();
        
        $model = ProyectoVariableDesbloqueoMes::find();
        
        if($ejecucion!=null)
        {
            $model->andFilterWhere([
                'id_ejecucion' => $ejecucion->id,
            ]);
        }
        else
        {
            $model->andFilterWhere([
                'id' => -1,
            ]);
        }
        
        $dataProvider = new ActiveDataProvider([
        'query' => $model,
        ]);
        $searchModel='';
        
        Yii::$app->response->format = Response::FORMAT_JSON;

        return 
        [
            'title' => "Desbloqueo Por Mes Variables",
            'content' => $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'id_ejecucion' => $ejecucion,
                'dataProvider' => $dataProvider,
            ]),
        ];
        
    }


    /**
     * Displays a single ProyectoVariableDesbloqueoMes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ProyectoVariableDesbloqueoMes #".$id,
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
     * Creates a new ProyectoVariableDesbloqueoMes model.
     * For ajax request will return json object
     *integer $id_ejecucion
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_ejecucion)
    {
        $request = Yii::$app->request;
        $model = new ProyectoVariableDesbloqueoMes();  
        $model->id_ejecucion=$id_ejecucion;
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new ProyectoVariableDesbloqueoMes",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'mes' => $model->meses,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new ProyectoVariableDesbloqueoMes",
                    'content'=>'<span class="text-success">Create ProyectoVariableDesbloqueoMes success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create', 'id_ejecucion' => $id_ejecucion,],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new ProyectoVariableDesbloqueoMes",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'mes' => $model->meses,
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
                return $this->render('create', [
                    'model' => $model,
                    'mes' => $model->meses,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProyectoVariableDesbloqueoMes model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update ProyectoVariableDesbloqueoMes #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "ProyectoVariableDesbloqueoMes #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update ProyectoVariableDesbloqueoMes #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
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
                ]);
            }
        }
    }

    /**
     * Delete an existing ProyectoVariableDesbloqueoMes model.
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
     * Delete multiple existing ProyectoVariableDesbloqueoMes model.
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
     * Finds the ProyectoVariableDesbloqueoMes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoVariableDesbloqueoMes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoVariableDesbloqueoMes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
