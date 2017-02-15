<?php

namespace frontend\controllers;

use Yii;
use backend\models\ProyectoVariableProgramacion;
use backend\models\ProyectoVariablesSearch;
use backend\models\ProyectoVariables;
use backend\models\ProyectoVariableDesbloqueoMes;
use common\models\ProyectoVariableEjecucion;
use common\models\ProyectoVariableEjecucionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ProyectoVariableEjecucionController implements the CRUD actions for ProyectoVariableEjecucion model.
 */
class ProyectoVariableEjecucionController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all ProyectoVariableEjecucion models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProyectoVariableEjecucionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ProyectoVariableEjecucion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ProyectoVariableEjecucion #".$id,
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
     * Creates a new ProyectoVariableEjecucion model.
     * For ajax request will return json object
     * @param integer $id, $id_localizacion
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$id_localizacion)
    {
            
        $desbloqueo=""; $total_cargado=0;
        $model= new ProyectoVariableEjecucion();
        //cargando la programación
        $model_programacion = ProyectoVariableProgramacion::find()->where(['id_localizacion' => $id_localizacion])->One();

        //total cargado en la programación
        $total=$model_programacion->totalTrimestre;

        $model_inicial = ProyectoVariableEjecucion::find()->where(['id_programacion'=> $model_programacion->id])->asArray()->One();
            
        $model->id_programacion=$model_programacion->id;
        $model->id_usuario=Yii::$app->user->getId();
            
        $hoy = getdate();
        $fecha=$hoy['year']."/".$hoy['mon']."/".$hoy['mday']." ".$hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds'];
        $model->fecha=$fecha;
        $desbloqueo[0]=0;    

        //verificar campos bloqueado
        if($model_inicial==NULL)
        {
            //primera vez que carga, deberia habilitarse solamente enero
            $desbloqueo[0]=1;

        }
        else
        {
            //verificar mes pendiente con la fecha o ultima carga realizada y fecha
            if($model_inicial['diciembre']==NULL && (($hoy['mon']==12 && $hoy['mday']>=5) || ($hoy['mon']>12)))
                $desbloqueo[0]=12;
            if($model_inicial['noviembre']==NULL && (($hoy['mon']==11 && $hoy['mday']>=5) || ($hoy['mon']>11)))
                $desbloqueo[0]=11;
            if($model_inicial['octubre']==NULL && (($hoy['mon']==10 && $hoy['mday']>=5) || ($hoy['mon']>10)))
                $desbloqueo[0]=10;
            if($model_inicial['septiembre']==NULL && (($hoy['mon']==9 && $hoy['mday']>=5) || ($hoy['mon']>9)))
                $desbloqueo[0]=9;
            if($model_inicial['agosto']==NULL && (($hoy['mon']==8 && $hoy['mday']>=5) || ($hoy['mon']>8)))
                $desbloqueo[0]=8;
            if($model_inicial['julio']==NULL && (($hoy['mon']==7 && $hoy['mday']>=5) || ($hoy['mon']>7)))
                $desbloqueo[0]=7;
            if($model_inicial['junio']==NULL && (($hoy['mon']==6 && $hoy['mday']>=5) || ($hoy['mon']>6)))
                $desbloqueo[0]=6;
            if($model_inicial['mayo']==NULL && (($hoy['mon']==5 && $hoy['mday']>=5) || ($hoy['mon']>5)))
                $desbloqueo[0]=5;
            if($model_inicial['abril']==NULL && (($hoy['mon']==4 && $hoy['mday']>=5) || ($hoy['mon']>4)))
                $desbloqueo[0]=4;
            if($model_inicial['marzo']==NULL && (($hoy['mon']==3 && $hoy['mday']>=5) || ($hoy['mon']>3)))
                $desbloqueo[0]=3;
            if($model_inicial['febrero']==NULL && (($hoy['mon']==2 && $hoy['mday']>=5) || ($hoy['mon']>2)))
                $desbloqueo[0]=2;

            //verificamos si desde el backend se le dio permiso para habilitar campos
            $permisos_espe = ProyectoVariableDesbloqueoMes::find()->where(['id_ejecucion'=> $model_inicial['id']])->asArray()->All();
                
            if($permisos_espe!="")
            {
                foreach ($permisos_espe as $key) 
                {
                    // se cargan los meses que se le dio permiso de carga
                    $desbloqueo[$key['mes']]='1';
                }
            }

            $model = $this->findModel($model_inicial['id']);
            $total_cargado=$model->totalTrimestre;
        }//fin else modelo con datos

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['create', 'id' => $id, 'id_localizacion' => $id_localizacion]);
        }
        else 
        {
            return $this->render('create', [
                'model' => $model,
                'model_programacion' => $model_programacion,
                'desbloqueo' => $desbloqueo,
                'total_cargado' => $total_cargado,

            ]);
        }
    }

    /**
     * Updates an existing ProyectoVariableEjecucion model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update ProyectoVariableEjecucion #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "ProyectoVariableEjecucion #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update ProyectoVariableEjecucion #".$id,
                    'content'=>$this->renderAjax('update', [
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
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing ProyectoVariableEjecucion model.
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
     * Delete multiple existing ProyectoVariableEjecucion model.
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
     * Finds the ProyectoVariableEjecucion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProyectoVariableEjecucion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProyectoVariableEjecucion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
    * Muestra el conjunto de variables asignadas al usuario
    **/
    public function actionVariables()
    {
        $model= new ProyectoVariables();
        $dataprovider=$model->variablesAsignadas();
        $searchModel = new ProyectoVariablesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('variables', [
                'model' => $dataprovider,
                'searchModel' => $searchModel,
            ]);
    }

    /**
    * Mostrar las localizaciones(regiones) de las variables(de poseerlas)
    *integer $id
    **/
    public function actionLocalizacion($id){

        $model= new ProyectoVariableEjecucion();
       
            return $this->render('localizacion', [
                'model' => $model->localizacionVariables($id),
            ]);

    }
}
