<?php

namespace frontend\controllers;

use Yii;
use app\models\AcEspUej;
use app\models\AcEspUejSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\UnidadEjecutora;
use yii\filters\AccessControl;




/**
 * AcEspUejController implements the CRUD actions for AcEspUej model.
 */
class AcEspUejController extends Controller
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
     * Lists all AcEspUej models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new AcEspUejSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single AcEspUej model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "AcEspUej #".$id,
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
     * Creates a new AcEspUej model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($accion_central, $accion_especifica)
    {
        $request = Yii::$app->request;
        $model = new AcEspUej();  
       // $unidades_ejecutoras = UnidadEjecutora::find()->asArray('id','nombre')->all();
        $unidades_ejecutoras=ArrayHelper::map(UnidadEjecutora::find()->all(), 'id', 'nombre');
        $verificar =ArrayHelper::map(AcEspUej::find()->where('id_ac_esp= :id', ['id'=>$accion_especifica])->all(),'id','id_ue');
       
        
       // print_r($unidades_ejecutoras); exit();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */

           Yii::$app->response->format = Response::FORMAT_JSON;

           // if(count($verificar)>0){

                  
                      /* return [
                                'title'=> "Editar Unidades Ejecutoras",
                                'content'=>$this->renderAjax('_form', [
                                    'model' => $model , 'accion_central'=>$accion_central,
                                     'accion_especifica'=>$accion_especifica,
                                     'unidades_ejecutoras'=>$unidades_ejecutoras,
                                     'precarga'=>$verificar,
                                ]),
                                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                            Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                    
                            ];
                        exit();
                    }*/

            if($request->isGet){
              
                return [
                    'title'=> "Agregar Unidades Ejecutoras",
                    'content'=>$this->renderAjax('_form', [
                        'model' => $model , 'accion_central'=>$accion_central,
                         'accion_especifica'=>$accion_especifica,
                         'unidades_ejecutoras'=>$unidades_ejecutoras
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else //if($model->load($request->post()) && $model->save()){ 
                    if($model->load($request->post())){
                        //se cuenta las unidades ejecutoras seleccionadas y se van guardando de una a una
                       $uni_eje=$request->post('id_ue');
                       $i=0;

                       $connection = \Yii::$app->db;
                       $transaction = $connection->beginTransaction();
                       try { 
                        while(count($request->post('id_ue'))!=$i){
                        $model->id_ue=$uni_eje[$i];
                        $id_ac_esp=$request->post('AcEspUej');
                        $model->id_ac_esp=$id_ac_esp['id_ac_esp'];
                        $i++;
                        $model->id = NULL; 
                        $model->isNewRecord = true;
                        if($model->save()){
                        }else{
                            $transaction->rollback();
                            $i=count($request->post('id_ue'));
                            //print_r($model->errors);
                        }
                        }

                        
                        $transaction->commit();

                return [
                    'forceReload'=>'false',
                    'title'=> "Agregar Unidades Ejecutoras",
                    'contenedorId' => '#especifica-pjax', //Id del contenedor
                    'contenedorUrl' => Url::to(['ac-ac-espec/index', 'ac_centralizada' => $request->post('accion_central')]),
                    'content'=>'<span class="text-success">Se Ha Guardado Satisfactoriamente!</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                            //Html::a('Seguir Creando',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];   
                } catch(Exception $e) {
                    $transaction->rollback();
                    }

            }else{           
                return [
                    'title'=> "Create new AcEspUej3",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'accion_especifica'=>$accion_especifica,
                         'unidades_ejecutoras'=>$unidades_ejecutoras
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
     * Updates an existing AcEspUej model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $accion_centralizada)
    {   
        $request = Yii::$app->request;
          
        $unidades_ejecutoras=ArrayHelper::map(UnidadEjecutora::find()->all(), 'id', 'nombre');
        $verificar =ArrayHelper::map(AcEspUej::find()->where('id_ac_esp= :id', ['id'=>$id])->all(),'id','id_ue');
         
         $model = new AcEspUej();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
 
           



            if($request->isGet){


                 if(count($verificar)>0){

                  
                      return [
                                'title'=> "Editar Unidades Ejecutoras",
                                'content'=>$this->renderAjax('_form', [
                                    'model' => $model , 'accion_central'=>$accion_centralizada,
                                     'accion_especifica'=>$id,
                                     'unidades_ejecutoras'=>$unidades_ejecutoras,
                                     'precarga'=>$verificar,
                                ]),
                                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                            Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
                    
                            ];
                        exit();
                    }

               /* return [
                    'title'=> "Update AcEspUej #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];*/         
            }else 

            if($model->load($request->post())){
                        //se cuenta las unidades ejecutoras seleccionadas y se van guardando de una a una
                       $uni_eje=$request->post('id_ue');
                       $i=0;
                       $id_ac_esp=$request->post('AcEspUej');
                       $connection = \Yii::$app->db;
                       $transaction = $connection->beginTransaction();
                       try {
                        AcEspUej::deleteAll("id_ac_esp='".$id_ac_esp['id_ac_esp']."'");
                        while(count($request->post('id_ue'))!=$i){
                             $model = new AcEspUej();
                        $model->id_ue=$uni_eje[$i];
                        $model->id_ac_esp=$id_ac_esp['id_ac_esp'];
                        $i++;
                        
                        $model->isNewRecord = true;
                        $model->id = NULL; 
                        if($model->save()){
                        }else{
                            $transaction->rollback();
                            $i=count($request->post('id_ue'));
                            //print_r($model->errors);
                        }
                        }

                        
                        $transaction->commit();

                return [
                    'forceReload'=>'false',
                    'title'=> "Editando Unidades Ejecutoras",
                    'contenedorId' => '#especifica-pjax', //Id del contenedor
                    'contenedorUrl' => Url::to(['ac-ac-espec/index', 'ac_centralizada' => $request->post('accion_central')]),
                    'content'=>'<span class="text-success">Se Edito Correctamente</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                            //Html::a('Seguir Creando',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];   
                } catch(Exception $e) {
                    $transaction->rollback();
                    }

            }
            /* if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "AcEspUej #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }*/else{
                 return [
                    'title'=> "Update AcEspUej #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
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
     * Delete an existing AcEspUej model.
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
     * Delete multiple existing AcEspUej model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (AcEspUej::findAll(json_decode($pks)) as $model) {
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
     * Finds the AcEspUej model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AcEspUej the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AcEspUej::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
