<?php

namespace frontend\controllers;

use Yii;
use common\models\ProyectoAeMeta;
use common\models\ProyectoAeMetaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ProyectoAeMetaController implements the CRUD actions for ProyectoAeMeta model.
 */
class ProyectoAeMetaController extends Controller
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
     * Lists all ProyectoAeMeta models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProyectoAeMetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ProyectoAeMeta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ProyectoAeMeta #".$id,
                    'content'=>$this->renderAjax('view', [
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
     * Creates a new ProyectoAeMeta model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @param int $accionEspecifica ID de la accion especifica
     * @return mixed
     */
    public function actionCreate($idLocalizacion)
    {
        $request = Yii::$app->request;
        $model = new ProyectoAeMeta();
        $model->id_proyecto_ac_localizacion = $idLocalizacion;
        $model->estatus=1;
        //inicializar variables en 0
        $model->enero=0;
        $model->febrero=0;
        $model->marzo=0;
        $model->abril=0;
        $model->mayo=0;
        $model->junio=0;
        $model->julio=0;
        $model->agosto=0;
        $model->septiembre=0;
        $model->octubre=0;
        $model->noviembre=0;
        $model->diciembre=0;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Meta",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::a('Regresar',['proyecto-accion-especifica/view', 'id' => $model->idProyectoAcLocalizacion->id_proyecto_ac],['class'=>'btn btn-primary','role'=>'modal-remote']).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"]),
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#especifica-pjax',
                    'title'=> "Create new ProyectoAeMeta",
                    'content'=>'<span class="text-success">Create ProyectoAeMeta success</span>',
                    'footer'=> Html::a('Regresar',['proyecto-accion-especifica/view', 'id' => $model->idProyectoAcLocalizacion->id_proyecto_ac],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{      
                return [
                    'title'=> "Crear Meta",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::a('Regresar',['proyecto-accion-especifica/view', 'id' => $model->idProyectoAcLocalizacion->id_proyecto_ac],['class'=>'btn btn-primary','role'=>'modal-remote']).
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
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProyectoAeMeta model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $accionEspecifica ID de la accion
     * @return mixed
     */
    public function actionUpdate($idLocalizacion)
    {
        $request = Yii::$app->request;
        $model = ProyectoAeMeta::find()->where([
            'id_proyecto_ac_localizacion' => $idLocalizacion
        ])->one();       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update ProyectoAeMeta #".$model->id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::a('Regresar',['proyecto-accion-especifica/view', 'id' => $model->idProyectoAcLocalizacion->id_proyecto_ac],['class'=>'btn btn-primary','role'=>'modal-remote']).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#especifica-pjax',
                    'title'=> "ProyectoAeMeta #".$model->id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::a('Regresar',['proyecto-accion-especifica/view', 'id' => $model->idProyectoAcLocalizacion->id_proyecto_ac],['class'=>'btn btn-primary','role'=>'modal-remote'])
                            
                ];    
            }else{
                 return [
                    'title'=> "Update ProyectoAeMeta #".$model->id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::a('Regresar',['proyecto-accion-especifica/view', 'id' => $model->idProyectoAcLocalizacion->id_proyecto_ac],['class'=>'btn btn-primary','role'=>'modal-remote'])
                                
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
     * Delete an existing ProyectoAeMeta model.
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
            return ['forceClose'=>'true','forceReload'=>'#especifica-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing ProyectoAeMeta model.
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
            return ['forceClose'=>'true','forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the ProyectoAeMeta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoAeMeta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoAeMeta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
