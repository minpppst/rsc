<?php

namespace app\controllers;

use Yii;
use app\models\Se;
use app\models\SeSearch;
use app\models\Partida;
use app\models\Ge;
use app\models\Es;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * SeController implements the CRUD actions for Se model.
 */
class SeController extends Controller
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
     * Lists all Se models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Se model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Se #".$id,
                    'content'=>$this->renderPartial('view', [
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
     * Creates a new Se model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Se();
        //Listas desplegables
        //Listas desplegables
        $partida = Partida::find()
            ->select(["id AS id", "CONCAT(partida,' - ',nombre) AS partida"])
            ->where(['estatus' => 1])
            ->asArray()
            ->all(); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear SE",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        'partida'=>$partida
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Crear SE",
                    'content'=>'<span class="text-success">Create Se success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear SE",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        'partida'=>$partida
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
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'partida'=>$partida
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Se model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        //Listas desplegables
        $partida = Partida::find()
            ->select(["id AS id", "CONCAT(partida,' - ',nombre) AS partida"])
            ->where(['estatus' => 1])
            ->asArray()
            ->all();       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Se #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                        'partida'=>$partida
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Se #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                        'partida'=>$partida
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Se #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                        'partida'=>$partida
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
                    'partida'=>$partida
                ]);
            }
        }
    }

    /**
     * Delete an existing Se model.
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
            return ['forceClose'=>true,'forceReload'=>true];    
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
            return ['forceClose'=>true,'forceReload'=>true]; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Funcion de respuesta para el AJAX de
     * partidas generales
     * @return array JSON 
     */
    public function actionGe()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Partidas GE
                $ge = Ge::find()
                    ->select(["id AS id", "CONCAT(codigo_ge,' - ',nombre_ge) AS name"])
                    ->where(['id_partida' => $request->post('depdrop_parents'), 'estatus' => 1])
                    ->asArray()
                    ->all();                

                return [
                    'output' => $ge
                ];
            }
        }
        
    }

    /**
     * Funcion de respuesta para el AJAX de
     * partidas especificas
     * @return array JSON 
     */
    public function actionEs()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Partidas GE
                $es = Es::find()
                    ->select(["id AS id", "CONCAT(codigo_es,' - ',nombre) AS name"])
                    ->where(['id_ge' => $request->post('depdrop_parents'), 'estatus' => 1])
                    ->asArray()
                    ->all();                

                return [
                    'output' => $es
                ];
            }
        }
        
    }

    /**
     * Finds the Se model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Se the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Se::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
