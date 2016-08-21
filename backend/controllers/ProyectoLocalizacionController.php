<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\Proyecto;
use common\models\ProyectoLocalizacion;
use common\models\ProyectoLocalizacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Ambito;
use common\models\Pais;
use common\models\Estados;
use common\models\Municipio;
use common\models\Parroquia;

/**
 * ProyectoLocalizacionController implements the CRUD actions for ProyectoLocalizacion model.
 */
class ProyectoLocalizacionController extends \common\controllers\BaseController
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule,$action)
                        {
                            $controller = Yii::$app->controller->id;
                            $action = Yii:: $app->controller->action->id;                    
                            $route = "$controller/$action";
                            if(\Yii::$app->user->can($route))
                            {
                                return true;
                            }
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ProyectoLocalizacion models.
     * @return mixed
     */
    public function actionIndex($proyecto,$ambito)
    {    
        $searchModel = new ProyectoLocalizacionSearch(['id_proyecto'=>$proyecto]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ambito' => $ambito
        ]);
    }


    /**
     * Displays a single ProyectoLocalizacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ProyectoLocalizacion #".$id,
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
     * Creates a new ProyectoLocalizacion model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($proyecto,$ambito)
    {
        $request = Yii::$app->request;
        $model = new ProyectoLocalizacion(); 
        $model->id_proyecto = $proyecto;
        //Escenario
        $model->scenario = Ambito::findOne(['id'=>$ambito])->ambito;

        switch ($model->scenario) {
            case 'Nacional':
                $model->id_pais = Pais::findOne(['nombre'=>'Venezuela'])->id;
                break;
            
            default:
                $model->id_pais = Pais::findOne(['nombre'=>'Venezuela'])->id;
                break;
        }

        //Listas desplegables
        $paises = Pais::find()->all();
        $estados = Estados::find()->all();
        $parroquias = Parroquia::find()->all();
        $municipios = Municipio::find()->all(); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new ProyectoLocalizacion",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        'paises' => $paises,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'ambito' => $ambito
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',                   
                    'title'=> "Create new ProyectoLocalizacion",
                    'content'=>'<span class="text-success">Create ProyectoLocalizacion success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new ProyectoLocalizacion",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        'paises' => $paises,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias,
                        'ambito' => $ambito
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
                return $this->redirect(['proyecto-responsable/create', 'proyecto' => $model->id_proyecto]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'paises' => $paises,
                    'estados' => $estados,
                    'municipios' => $municipios,
                    'parroquias' => $parroquias,
                    'ambito' => $ambito
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProyectoLocalizacion model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        //Escenario
        $model->scenario = $this->findAmbito($model->id_proyecto);

        switch ($model->scenario) {
            case 'Nacional':
                $model->id_pais = Pais::findOne(['nombre'=>'Venezuela'])->id;
                break;
            
            default:
                $model->id_pais = Pais::findOne(['nombre'=>'Venezuela'])->id;
                break;
        }

        //Listas desplegables
        $paises = Pais::find()->all();
        $estados = Estados::find()->all();
        $parroquias = Parroquia::find()->all();
        $municipios = Municipio::find()->all();       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update ProyectoLocalizacion #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $model,
                        'paises' => $paises,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "ProyectoLocalizacion #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $model,
                        'paises' => $paises,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update ProyectoLocalizacion #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $model,
                        'paises' => $paises,
                        'estados' => $estados,
                        'municipios' => $municipios,
                        'parroquias' => $parroquias
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
                    'paises' => $paises,
                    'estados' => $estados,
                    'municipios' => $municipios,
                    'parroquias' => $parroquias,
                ]);
            }
        }
    }

    /**
     * Delete an existing ProyectoLocalizacion model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose'=>true,
                'forceReload'=>'true',
            ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing ProyectoLocalizacion model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (ProyectoLocalizacion::findAll(json_decode($pks)) as $model) {
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

    protected function findAmbito($proyecto)
    {
        $proyecto = Proyecto::findOne($proyecto);

        return $proyecto->nombreAmbito;
    }

    /**
     * Finds the ProyectoLocalizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoLocalizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoLocalizacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
