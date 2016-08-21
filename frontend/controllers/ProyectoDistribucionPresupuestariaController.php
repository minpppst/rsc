<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\models\ProyectoDistribucionPresupuestaria;
use app\models\ProyectoDistribucionPresupuestariaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\data\SqlDataProvider;
use app\models\ProyectoAccionEspecifica;
use app\models\Partida;

/**
 * ProyectoDistribucionPresupuestariaController implements the CRUD actions for ProyectoDistribucionPresupuestaria model.
 */
class ProyectoDistribucionPresupuestariaController extends \common\controllers\BaseController
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
     * Lists all ProyectoDistribucionPresupuestaria models.
     * @return mixed
     */
    public function actionIndex($proyecto)
    {
        $accionesEspecificas = ProyectoAccionEspecifica::find()->where(['id_proyecto' => $proyecto])->all();
        $partidas = Partida::find()->all();

        $modelos = [];

        foreach ($accionesEspecificas as $key => $value) 
        {
            $modelos[] = ProyectoDistribucionPresupuestaria::find()->where([
                'id_accion_especifica' => $value->id
            ])->all();
        }

        $html = $this->renderPartial('index', [
            'modelos' => $modelos,
            'partidas' => $partidas,
            'proyecto' => $proyecto,
        ]);

        return Json::encode($html);
    }


    /**
     * Displays a single ProyectoDistribucionPresupuestaria model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ProyectoDistribucionPresupuestaria #".$id,
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
     * Creates a new ProyectoDistribucionPresupuestaria model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($proyecto)
    {
        $request = Yii::$app->request;
        $model = new ProyectoDistribucionPresupuestaria();
        $model->id_proyecto = $proyecto; 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new ProyectoDistribucionPresupuestaria",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Create new ProyectoDistribucionPresupuestaria",
                    'content'=>'<span class="text-success">Create ProyectoDistribucionPresupuestaria success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new ProyectoDistribucionPresupuestaria",
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
     * Updates an existing ProyectoDistribucionPresupuestaria model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update ProyectoDistribucionPresupuestaria #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "ProyectoDistribucionPresupuestaria #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update ProyectoDistribucionPresupuestaria #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    */

    /**
     * Acción AJAX para editar campos
     */
    public function actionUpdate($proyecto)
    {
        $accionesEspecificas = ProyectoAccionEspecifica::find()->where(['id_proyecto' => $proyecto])->all();
        $partidas = Partida::find()->all();
        $modelos = [];

        foreach ($accionesEspecificas as $key => $value) 
        {
            $modelos[] = ProyectoDistribucionPresupuestaria::find()->where(['id_accion_especifica'=>$value->id])->all();
        }

        $request = Yii::$app->request;

        if($request->isAjax)
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if(isset($_POST['hasEditable']))
            {

                $model = $this->findModel($_POST['ProyectoDistribucionPresupuestaria']['id']);
                $model->cantidad = $_POST['cantidad_'.$model->id];

                if($model->save())
                {
                    return ['output'=>$model->cantidad, 'message'=>''];
                }
                else
                {
                    return ['output'=>'', 'message'=>$model->getErrors('cantidad')];
                }

                
            }

        }


        return $this->render('editable', [
            'modelos' => $modelos,
            'proyecto' => $proyecto,
            'accionesEspecificas' => $accionesEspecificas,
            'partidas' => $partidas
        ]);
    }

    /**
     * Delete an existing ProyectoDistribucionPresupuestaria model.
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
     * Delete multiple existing ProyectoDistribucionPresupuestaria model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (ProyectoDistribucionPresupuestaria::findAll(json_decode($pks)) as $model) {
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
     * Finds the ProyectoDistribucionPresupuestaria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoDistribucionPresupuestaria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoDistribucionPresupuestaria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
