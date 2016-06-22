<?php

namespace backend\controllers;

use Yii;
use common\models\PartidaSubEspecifica;
use common\models\PartidaSubEspecificaSearch;
use common\models\PartidaPartida;
use common\models\PartidaGenerica;
use common\models\PartidaEspecifica;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * SeController implements the CRUD actions for PartidaSubEspecifica model.
 */
class PartidaSubEspecificaController extends Controller
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
     * Lists all PartidaSubEspecifica models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PartidaSubEspecificaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single PartidaSubEspecifica model.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @param char(2) $especifica
     * @param char(2) $subespecifica
     * @return mixed
     */
    public function actionView($cuenta,$partida,$generica,$especifica,$subespecifica)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Sub-específica #".$cuenta.$partida.$generica.$especifica.$subespecifica,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','cuenta' => $cuenta, 'partida' => $partida, 'generica' => $generica, 'especifica' => $especifica, 'subespecifica' => $subespecifica],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica),
            ]);
        }
    }

    /**
     * Creates a new Se model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PartidaSubEspecifica();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Sub-Específica",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Crear Sub-Específica",
                    'content'=>'<span class="text-success">Crear Sub-Específica success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear Sub-Específica",
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
                return $this->redirect(['view', 'cuenta' => $model->cuenta, 'partida' => $model->partida, 'generica' => $model->generica, 'especifica' => $model->especifica, 'subespecifica' => $model->subespecifica]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing PartidaSubEspecifica model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @param char(2) $especifica
     * @param char(2) $subespecifica
     * @return mixed
     */
    public function actionUpdate($cuenta,$partida,$generica,$especifica,$subespecifica)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Editar Sub-Específica #".$cuenta.$partida.$generica.$especifica.$subespecifica,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Sub-Específica #".$cuenta.$partida.$generica.$especifica.$subespecifica,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','cuenta' => $model->cuenta, 'partida' => $model->partida, 'generica' => $model->generica, 'especifica' => $model->especifica, 'subespecifica' => $model->subespecifica],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Editar Sub-Específica #".$cuenta.$partida.$generica.$especifica.$subespecifica,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica),
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
                return $this->redirect(['view', 'cuenta' => $model->cuenta, 'partida' => $model->partida, 'generica' => $model->generica, 'especifica' => $model->especifica, 'subespecifica' => $model->subespecifica]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing PartidaSubEspecifica model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @param char(2) $especifica
     * @param char(2) $subespecifica
     * @return mixed
     */
    public function actionDelete($cuenta,$partida,$generica,$especifica,$subespecifica)
    {
        $request = Yii::$app->request;
        $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica)->delete();

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
     * Delete multiple existing Se model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (Se::findAll(json_decode($pks)) as $model) {
            $model->delete();
        }
        

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
     * Activar o desactivar un modelo
     * @param integer id
     * @return mixed
     */
    public function actionToggleActivo($cuenta,$partida,$generica,$especifica,$subespecifica) {
        $model = $this->findModel($cuenta,$partida,$generica,$especifica,$subespecifica);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model != null && $model->toggleActivo()) {
            return ['forceClose' => 'true', 'forceReload' => 'true'];
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
     * Desactiva multiples modelos de PartidaSubEspecifica.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkDesactivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = PartidaSubEspecifica::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->desactivar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => 'true', 'forceReload' => 'true'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Activa multiples modelos de PartidaSubEspecifica.
     * Para las peticiones AJAX devolverá un objeto JSON
     * para las peticiones no-AJAX el navegador se redireccionará al "index"
     * @param integer id
     * @return mixed
     */
    public function actionBulkActivar() {
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        //Obtener el nombre de la clase del modelo
        $className = PartidaSubEspecifica::className();
        
        //call_user_func - Invocar el callback 
        foreach (call_user_func($className . '::findAll', $pks) as $model) {            
            $model->activar();
        }
        

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => 'true', 'forceReload' => 'true'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the PartidaSubEspecifica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param char(1) $cuenta
     * @param char(2) $partida
     * @param char(2) $generica
     * @param char(2) $especifica
     * @param char(2) $subespecifica
     * @return el modelo
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cuenta,$partida,$generica,$especifica,$subespecifica)
    {
        if (($model = PartidaSubEspecifica::findOne(['cuenta'=>$cuenta,'partida'=>$partida,'generica'=>$generica,'especifica'=>$especifica,'subespecifica'=>$subespecifica])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
