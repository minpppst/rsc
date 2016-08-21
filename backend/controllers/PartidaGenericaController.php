<?php

namespace backend\controllers;

use Yii;
use common\models\PartidaGenerica;
use common\models\PartidaGenericaSearch;
use common\models\PartidaPartida;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * GeController implements the CRUD actions for Ge model.
 */
class PartidaGenericaController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all PartidaGenerica models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PartidaGenericaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single PartidaGenerica model.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @return mixed
     */
    public function actionView($cuenta,$partida,$generica)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Ge #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($cuenta,$partida,$generica),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','cuenta'=>$cuenta,'partida'=>$partida,'generica'=>$generica],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($cuenta,$partida,$generica),
            ]);
        }
    }

    /**
     * Creates a new PartidaGenerica model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PartidaGenerica();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Partida Genérica",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Crear Partida Genérica",
                    'content'=>'<span class="text-success">Create Ge success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Crear otro',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear Partida Genérica",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
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
                return $this->redirect(['view', 'cuenta' => $model->cuenta,'partida'=>$model->partida,'generica'=>$model->generica]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Ge model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @return mixed
     */
    public function actionUpdate($cuenta,$partida,$generica)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($cuenta,$partida,$generica);    

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Actualizar GE #".$cuenta.$partida.$generica,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($cuenta,$partida,$generica),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Ge #".$cuenta.$partida.$generica,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($cuenta,$partida,$generica),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Actualizar GE #".$cuenta.$partida.$generica,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($cuenta,$partida,$generica),
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
                return $this->redirect(['view', 'cuenta' => $model->cuenta,'partida'=>$model->partida,'generica'=>$model->generica]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Ge model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @return mixed
     */
    public function actionDelete($cuenta,$partida,$generica)
    {
        $request = Yii::$app->request;
        $this->findModel($cuenta,$partida,$generica)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true];    
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Ge model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $arr = explode('},{',ltrim(rtrim($request->post('pks'),'}'), '{')); // arreglo o llave primaria
        foreach ($arr as $key => $value) //por cada string
        {
            $tmp = json_decode('{'.$value.'}'); //json a objeto
            
            $model = $this->findModel($tmp->cuenta, $tmp->partida, $tmp->generica); //se busca el modelo
            $model->delete();
            
        }        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true]; 
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
    public function actionToggleActivo($cuenta,$partida,$generica) {
        $model = $this->findModel($cuenta,$partida,$generica);

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
     * Desactiva multiples modelos de PartidaGenerica.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $arr = explode('},{',ltrim(rtrim($request->post('pks'),'}'), '{')); // arreglo o llave primaria
        foreach ($arr as $key => $value) //por cada string
        {
            $tmp = json_decode('{'.$value.'}'); //json a objeto
            
            $model = $this->findModel($tmp->cuenta, $tmp->partida, $tmp->generica); //se busca el modelo
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
     * Activa multiples modelos de PartidaGenerica.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar() {
        $request = Yii::$app->request;
        $arr = explode('},{',ltrim(rtrim($request->post('pks'),'}'), '{')); // arreglo o llave primaria
        foreach ($arr as $key => $value) //por cada string
        {
            $tmp = json_decode('{'.$value.'}'); //json a objeto
            
            $model = $this->findModel($tmp->cuenta, $tmp->partida, $tmp->generica); //se busca el modelo
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
     * Finds the PartidaGenerica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @return el modelo
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cuenta,$partida,$generica)
    {
        if (($model = PartidaGenerica::findOne(['cuenta'=>$cuenta,'partida'=>$partida,'generica'=>$generica])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
