<?php

namespace backend\controllers;

use Yii;
use backend\models\UePartidaEntidad;
use backend\models\UePartidaEntidadSearch;
use backend\models\TipoEntidad;
use common\models\UnidadEjecutora;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * UePartidaEntidadController implements the CRUD actions for UePartidaEntidad model.
 */
class UePartidaEntidadController extends \common\controllers\BaseController
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
     * Lists all UePartidaEntidad models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new UePartidaEntidadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single UePartidaEntidad model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id=null,$cuenta=null,$partida=null)
    {   
        $request = Yii::$app->request;
        if($id==null)
        {
        $model=UePartidaEntidad::find()->where(['cuenta' => $cuenta, 'partida' => $partida])->One();
        }        
        else
        {
        $model=$this->findModel($id);
        }

        $unidad_ejecutora=new UePartidaEntidad();
        $ue=$unidad_ejecutora->obtener_uej_relacionadas(1,$model->cuenta,$model->partida);
        $ue_acc=$unidad_ejecutora->obtener_uej_relacionadas(2,$model->cuenta,$model->partida);
        
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "UePartidaEntidad #".$model->cuenta.$model->partida,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'ue' => $ue,
                        'ue_acc' => $ue_acc,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $model,
                'ue' => $ue,
                'ue_acc' => $ue_acc,
            ]);
        }
    }

    /**
     * Creates a new UePartidaEntidad model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new UePartidaEntidad();  
        $ue = ArrayHelper::map(UnidadEjecutora::find()->asArray()->all(),'id','nombre');
        $tipo_entidad = ArrayHelper::map(TipoEntidad::find()->asArray()->all(),'id','nombre');
        

        if(!$request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new UePartidaEntidad",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'ue' => $ue,
                        'tipo_entidad' => $tipo_entidad,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new UePartidaEntidad",
                    'content'=>'<span class="text-success">Create UePartidaEntidad success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new UePartidaEntidad",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'ue' => $ue,
                        'tipo_entidad' => $tipo_entidad,
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
                    'ue' => $ue,
                    'tipo_entidad' => $tipo_entidad,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing UePartidaEntidad model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $cuenta=$model->cuenta;
        $partida=$model->partida;     
        $ue = ArrayHelper::map(UnidadEjecutora::find()->asArray()->all(),'id','nombre');
        $tipo_entidad = arrayHelper::map(TipoEntidad::find()->asArray()->all(),'id', 'nombre');
        $verificar =ArrayHelper::map(UePartidaEntidad::find()->where('cuenta= :id', ['id'=>$model->cuenta])->andwhere(['partida' => $model->partida])->andwhere(['id_tipo_entidad' => 1])->all(),'id','id_ue');
        $verificar_acc =ArrayHelper::map(UePartidaEntidad::find()->where('cuenta= :id', ['id'=>$model->cuenta])->andwhere(['partida' => $model->partida])->andwhere(['id_tipo_entidad' => 2])->all(),'id','id_ue');



            /*
            *   Process for post resquest
            */
           
            if($request->post()){
            //
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
            //verificando los cambios en los tipos de entidad proyecto y acc
            $proyecto=$request->post('ue_proyecto');
            $acc=$request->post('ue_acc');
            
            if(empty($proyecto) || empty($acc)){
            Yii::$app->getSession()->setFlash('danger', 'Error, no puede dejar las partida sin unidad ejecutora');

            return $this->render('update', [
                    'model' => $model,
                    'ue' => $ue,
                    'tipo_entidad' => $tipo_entidad,
                    'precarga_proyecto' => $verificar,
                    'precarga_acc' => $verificar_acc,
                ]);
            }

            $model->UejEntidad($proyecto,1);
            $model->UejEntidad($acc,2);
            $transaction->commit();
            
            }
            catch(Exception $e) {
            $transaction->rollback();
            Yii::$app->getSession()->setFlash('danger', 'Error al actualizar unidades.');
            return $this->render('update', [
                    'model' => $model,
                    'ue' => $ue,
                    'tipo_entidad' => $tipo_entidad,
                    'precarga_proyecto' => $verificar,
                    'precarga_acc' => $verificar_acc,
                ]);
            }

            return $this->redirect(['view',
                    'partida' => $partida,
                    'cuenta' => $cuenta,
                    ]);


            }else{
             return $this->render('update', [
                    'model' => $model,
                    'ue' => $ue,
                    'tipo_entidad' => $tipo_entidad,
                    'precarga_proyecto' => $verificar,
                    'precarga_acc' => $verificar_acc,
                ]);
            }
                
            
        
    }

    /**
     * Delete an existing UePartidaEntidad model.
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
     * Delete multiple existing UePartidaEntidad model.
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
     * Finds the UePartidaEntidad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UePartidaEntidad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UePartidaEntidad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
