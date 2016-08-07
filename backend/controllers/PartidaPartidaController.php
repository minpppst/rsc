<?php

namespace backend\controllers;

use Yii;
use common\models\PartidaPartida;
use common\models\PartidaPartidaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * PartidaPartidaController implements the CRUD actions for PartidaPartidamodel.
 */
class PartidaPartidaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PartidaPartida models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PartidaPartidaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single PartidaPartida model.
     * @param integer $cuenta
     * @param integer $partida
     * @return mixed
     */
    public function actionView($cuenta,$partida)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "PartidaPartida #".$cuenta.$partida,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($cuenta,$partida),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','cuenta'=>$cuenta,'partida'=>$partida],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($cuenta,$partida),
            ]);
        }
    }

    /**
     * Creates a new PartidaPartida model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PartidaPartida();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Partida",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->model()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Crear Partida",
                    'content'=>'<span class="text-success">Create PartidaPartida success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];         
            }else{           
                return [
                    'title'=> "Crear Partida",
                    'content'=>$this->renderPartial('create', [
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
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing PartidaPartida model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $cuenta
     * @param integer $partida
     * @return mixed
     */
    public function actionUpdate($cuenta,$partida)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($cuenta,$partida);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Partida #".$cuenta.$partida,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($cuenta,$partida),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){            
                return [
                    'forceReload'=>'true',
                    'title'=> "Partida #".$cuenta.$partida,
                    'content'=>$this->renderPartial('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','cuenta'=>$cuenta,'partida'=>$partida],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
                   
            }else{
                 return [
                    'title'=> "Update Partida #".$cuenta.$partida,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($cuenta,$partida),
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
                return $this->redirect(['view', 'cuenta' => $model->cuenta,'partida' => $model->partida]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing PartidaPartida model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $cuenta
     * @param integer $partida
     * @return mixed
     */
    public function actionDelete($cuenta,$partida)
    {
        $request = Yii::$app->request;
        $this->findModel($cuenta,$partida)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>'true','forceReload'=>'true'];    
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing PartidaPartida model.
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
            
            $model = $this->findModel($tmp->cuenta, $tmp->partida); //se busca el modelo
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
     * @param integer $cuenta
     * @param integer $partida
     * @return mixed
     */
    public function actionToggleActivo($cuenta,$partida) {
        $model = $this->findModel($cuenta,$partida);

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
     * Desactiva multiples modelos de PartidaPartida.
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
            
            $model = $this->findModel($tmp->cuenta, $tmp->partida); //se busca el modelo
            $model->desactivar();
            
        }

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */            
            Yii::$app->response->format = Response::FORMAT_JSON;
            //return ['pks'=>$tmp->cuenta];
            return ['forceClose' => true, 'forceReload' => 'true'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Activa multiples modelos de PartidaPartida.
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
            
            $model = $this->findModel($tmp->cuenta, $tmp->partida); //se busca el modelo
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
     * Finds the PartidaPartida model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PartidaPartida the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cuenta,$partida)
    {
        if (($model = PartidaPartida::findOne(['cuenta' => $cuenta, 'partida' => $partida])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
