<?php

namespace backend\controllers;

use Yii;
use backend\models\ResponsableAccVariable;
use backend\models\ResponsableAccVariableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
/**
 * ResponsableAccVariableController implements the CRUD actions for ResponsableAccVariable model.
 */
class ResponsableAccVariableController extends \common\controllers\BaseController
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
                    'bulk-estatusactivo' => ['post'],
                    'bulk-estatusdesactivar' => ['post'],
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
     * Lists all ResponsableAccVariable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResponsableAccVariableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResponsableAccVariable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ResponsableAccVariable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_variable)
    {
        $model = new ResponsableAccVariable();
        $model->id_variable=$id_variable;
        $request = Yii::$app->request;
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
        Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Responsable",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
             
             
                return [
                    'forceReload'=>'true',                   
                    'title'=> "Responsable",
                    'content'=>'<span class="text-success">Create VariableLocalizacion success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];
            }else{           
                return [
                    'title'=> "Responsable",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                                   
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        } else{

        //proceso normal

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/accion-centralizada-variables/view', 'id' => $model->id_variable]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }


    }



    }

    /**
     * Updates an existing ResponsableAccVariable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $request = Yii::$app->request;
        //ajax
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Responsable",
                    'content'=>$this->renderPartial('update', [
                        'model' => $model,
                        
                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                
                return [
                    'forceReload'=>'true',                   
                    'title'=> "Responsable",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        
                    ]),
                    
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                               Html::a('Editar',['update', 'id' => $model->id,],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];
            }else{           
                  return [
                    'title'=> "Responsable",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }

        //fin ajax
        else {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    }

    /**
     * Deletes an existing ResponsableAccVariable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ResponsableAccVariable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ResponsableAccVariable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResponsableAccVariable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
