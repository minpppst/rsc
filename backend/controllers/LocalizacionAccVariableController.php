<?php

namespace backend\controllers;

use Yii;
use backend\models\LocalizacionAccVariable;
use backend\models\LocalizacionAccVariableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Pais;
use common\models\Estados;
use \yii\web\Response;
use yii\helpers\Html;
use backend\models\AccionCentralizadaVariableProgramacion;
use yii\filters\AccessControl;
/**
 * LocalizacionAccVariableController implements the CRUD actions for LocalizacionAccVariable model.
 */
class LocalizacionAccVariableController extends Controller
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
        
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Variable #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'model1' => $model1,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }

        else{
        return $this->render('view', [
            'model' => $model, 
            'model1'=> $model1,
        ]);
    }
    }

    /**
     * Creates a new LocalizacionAccVariable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
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
                    'title'=> "Localización",
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
                    'title'=> "Localización",

                    'content'=>'<span class="text-success">Create VariableLocalizacion success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create', 'variable' => $variable,
                    'localizacion' => $localizacion],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];}else{
                    
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
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $variable, $localizacion)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model1= AccionCentralizadaVariableProgramacion::find()->where(['id_localizacion' => $model->id])->One();
        
        $model->scenario = ($localizacion=='0' ? 'Nacional' : 'Estadal');

        //$model->id_pais = Pais::findOne(['nombre'=>'Venezuela'])->id;
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
                    'title'=> "Localización",
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
                    'title'=> "Localización",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'model1' => $model1,
                        'id' => $model->id,
                        //'variable' => $model->id_variable,
                        //'localizacion' => $model->idVariable->localizacion,
                    ]),
                    
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update', 'id' => $model->id, 'variable' => $model->id_variable, 'localizacion' => $model->idVariable->localizacion,],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];}else{
                    
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

    /**
     * Deletes an existing LocalizacionAccVariable model.
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
