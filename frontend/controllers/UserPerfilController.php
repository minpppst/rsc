<?php

namespace frontend\controllers;

use Yii;
use common\models\UserPerfil;
use common\models\UserPerfilSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * UserPerfilController implements the CRUD actions for UserPerfil model.
 */
class UserPerfilController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all UserPerfil models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new UserPerfilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['id_user' => Yii::$app->user->identity->id]);
        $bandera=UserPerfil::find()->where(['id_user'=> Yii::$app->user->identity->id])->one() == null ? 0 : 1;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bandera' => $bandera,
        ]);
    }

    /**
     * Displays a single UserPerfil model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Perfil #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new UserPerfil model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new UserPerfil();
        $model->id_user=Yii::$app->user->identity->id;
        $model_user = User::find()->where(['id' => $model->id_user])->one();
        $model_user->scenario='create';

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Editar Perfil",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'model_user' => $model_user,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else 
            {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                if($model->load($request->post()) && $model->save() && $model_user->load($request->post()) && $model_user->save())
                {
                    $transaction->commit();
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Editar Perfil",
                        'content'=>'<span class="text-success">¡Perfil Completado!</span>',
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
            
                    ];
                }
                else
                {
                    $transaction->rollback();
                    return [
                        'title'=> "Editar Perfil",
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                            'model_user' => $model_user,
                        ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
            
                    ];         
                }
            }//fin del else

        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'model_user' => $model_user,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing UserPerfil model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model_user = User::find()->where(['id' => $model->id_user])->one();
        $model_user->scenario='update';
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Editar Perfil #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'model_user' => $model_user,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else 
            {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                if($model->load($request->post()) && $model->save() && $model_user->load($request->post()) && $model_user->save() )
                {
                    $transaction->commit();
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Perfil #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                            'model_user' => $model_user,
                        ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];    
                }else
                {
                    $transaction->rollback();
                     return [
                        'title'=> "Update UserPerfil #".$id,
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                            'model_user' => $model_user,
                        ]),
                        'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button('Editar',['class'=>'btn btn-primary','type'=>"submit"])
                    ];        
                }
            }//fin del else
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'model_user' => $model_user,
                ]);
            }
        }
    }

    /**
     * Delete an existing UserPerfil model.
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
     * Delete multiple existing UserPerfil model.
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
     * Finds the UserPerfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserPerfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserPerfil::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
