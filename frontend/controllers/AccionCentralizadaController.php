<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use common\models\AccionCentralizada;
use common\models\AccionCentralizadaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use frontend\models\UploadForm;
/**
 * AccionCentralizadaController implements the CRUD actions for AccionCentralizada model.
 */
class AccionCentralizadaController extends Controller
{
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
     * Lists all AccionCentralizada models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionCentralizadaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccionCentralizada model.
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
     * Creates a new AccionCentralizada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccionCentralizada();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AccionCentralizada model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AccionCentralizada model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
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
            return ['forceClose'=>true,'forceReload'=>'true'];    
        }else{

        return $this->redirect(['index']);
    }

}
    /**
     * Finds the AccionCentralizada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccionCentralizada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccionCentralizada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Importar modelos.
     * @return mixed
     */
    public function actionImportar()
    {
        $request = Yii::$app->request;
        $modelo = new UploadForm();

        if($request->isPost)
        {
            $archivo = file($_FILES['UploadForm']['tmp_name']['importFile']);
            $mensaje="";
            $transaccion = AccionCentralizada::getDb()->beginTransaction();

            try
            {
                foreach ($archivo as $llave => $valor) 
                {
                    $exploded = explode(';', str_replace("'", '',$valor));

                    $ue = AccionCentralizada::find()
                        ->where(['codigo_accion' => $exploded[0]])
                        ->orwhere(['codigo_accion_sne'=>$exploded[1]])
                        ->one();

                    if($ue == null)
                    {                        
                        $ue = new AccionCentralizada;
                   
                    }else{
                        $mensaje="Accion Ya Existe: Codigo Accion:".$exploded[0]." SNE:".$exploded[1];
                        $ue="";
                    }
                                                                    
                    if(!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', trim($exploded[3])) || !preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', trim($exploded[4])))
                    {                        
                        $mensaje="El Formato De Fecha Debe Ser 'dd/mm/yyyy' ";
                        unset($ue);
                    }

                    //guardando a mysql
                    $date = explode('/', $exploded[3]);
                    $exploded[3]=$date[2]."/".$date[1]."/".$date[0];
                    if(!checkdate ( (int) $date[1], (int) $date[0] , (int) rtrim($date[2]))){
                         $mensaje="Fecha No Valida, Verifique Fecha";
                        unset($ue);
                    }
                    $date_fin = explode('/', $exploded[4]);
                    if(!checkdate ( (int) $date_fin[1] , (int) $date_fin[0], (int) rtrim($date_fin[2]))){
                         $mensaje="Fecha No Valida, Verifique Fecha";
                        unset($ue);
                    }
                    $exploded[4]=rtrim($date_fin[2])."/".$date_fin[1]."/".$date_fin[0];
                    //validar que inicio sea menor a fin
                    $fecha1 = new \DateTime($exploded[3]);
                    $fecha2 = new \DateTime($exploded[4]);
                  
                    if($fecha1>$fecha2){
                        $mensaje="Fecha Inicio Debe Ser Menor A Fecha Fin";
                        unset($ue);
                    }// fin validar fechas
                     //fin de guardar a mysql


                    $ue->codigo_accion= $exploded[0];
                    $ue->codigo_accion_sne=$exploded[1];
                    $ue->nombre_accion = $exploded[2];
                    $ue->fecha_inicio= $exploded[3];
                    $ue->fecha_fin= $exploded[4];
                    $ue->estatus = 0;
                    $ue->save(false);
                        
                    //    print_r($ue->getErrors()); exit();
                    
                }
                
                $transaccion->commit();

                Yii::$app->session->setFlash('importado', '<div class="alert alert-success">Registros importados exitosamente.</div>');
                return $this->refresh();

            }catch(\Exception $e){
                $transaccion->rollBack();
                Yii::$app->session->setFlash('importado', '<div class="alert alert-danger">'.$mensaje.'</div>');
            }
                        
        }

        return $this->render('importar', [
            'modelo' => $modelo,
        ]);
    }



    /**
     * Activar modelo.
     * @param integer $id ID del modelo
     * @return array
     */
    public function actionToggleActivo($id){
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model != null && $model->toggleActivo()) {
            return ['forceClose' => true, 'forceReload' => 'true'];
        } else {
            return [
                'title' => 'Ocurrió un error.',
                'content' => '<span class="text-danger">No se pudo realizar la operación. Error desconocido</span>',
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
        }
    }


    /**
     * Elminar multiples modelos.
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        
        
        foreach ($pks as $key) 
        {
            //$model=AcAcEspec::findAll(json_decode($key));
            $model=$this->findModel($key);
            $model->delete();
        }        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'true']; 
        }
        else
        {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['/accion_centralizada/index']);
        }
       
    }


    /**
     * Activar multiples modelos.
     */ 
    public function actionBulkEstatusactivo()
    {        
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        
        
        foreach ($pks as $key) 
        {        
            //$model=AcAcEspec::findAll(json_decode($key));
            $model=$this->findModel($key);
            //$model->delete();
            $model->activar();
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'true']; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }


    /**
     * Activar multiples modelos.
     */
    public function actionBulkEstatusdesactivo()
    {        
        $request = Yii::$app->request;
        $pks = json_decode($request->post('pks')); // Array or selected records primary keys
        
        
        foreach ($pks as $key) 
        {
            //$model=AcAcEspec::findAll(json_decode($key));
            $model=$this->findModel($key);
            //$model->delete();
            $model->desactivar();
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'true']; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }
}
