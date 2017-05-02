<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\AccionCentralizada;
use common\models\AcAcEspec;
use common\models\Proyecto;
use common\models\MaterialesServicios;
use common\models\UnidadEjecutora;
use common\models\ProyectoAccionEspecifica;
use backend\models\AccionCentralizadaVariables;
use backend\models\ProyectoVariables;
use backend\models\ReportePlanificacion;
use kartik\mpdf\Pdf;
use yii\data\ArrayDataProvider;


/**
 * ReportesPresupuestoController implements the CRUD actions for Feedback model.
 */
class ReportesPlanificacionController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    public function actionReporte1()
   	{
   		$accioncentralizada= AccionCentralizada::find()->all();
        array_unshift($accioncentralizada, ['id' => 'x999', 'nombre_accion' => 'Todos']);
        array_push($accioncentralizada, ['id' => '-1', 'nombre_accion' => 'Ninguno']);
   		$proyectos= Proyecto::find()->all();
        array_unshift($proyectos, ['id' => 'x999', 'nombre' => 'Todos']);
        array_push($proyectos, ['id' => '-1', 'nombre' => 'Ninguno']);
   		$variablescentral = AccionCentralizadaVariables::find()->all();
        array_unshift($variablescentral, ['id' => 'x999', 'nombre_variable' => 'Todos']);
        array_push($variablescentral, ['id' => '-1', 'nombre_variable' => 'Ninguno']);
        $variablesproyecto = ProyectoVariables::find()->all();
        array_unshift($variablesproyecto, ['id' => 'x999', 'nombre_variable' => 'Todos']);
        array_push($variablesproyecto, ['id' => '-1', 'nombre_variable' => 'Ninguno']);
   		$unidadesejecutoras = UnidadEjecutora::find()->all();
        array_unshift($unidadesejecutoras, ['id' => 'x999', 'nombre' => 'Todos']);
        array_push($unidadesejecutoras, ['id' => '-1', 'nombre' => 'Ninguno']);
        $meses=ReportePlanificacion::meses();
        array_unshift($meses, ['id' => 'x999', 'nombre' => 'Todos']);
        
        if(Yii::$app->request->post() || Yii::$app->request->get('page'))
        {
            $reporte=new ReportePlanificacion;
            $meses['id']=Yii::$app->request->post('meses');
            return $this->render('resultado_reporte1',[
            'model' => $reporte->reporte1(Yii::$app->request->post()),
            'meses' => $meses,
            'post' => Yii::$app->request->post(),
            ]);
        }
        else
        {

       		return $this->render('reporte1',
       			[
       				'proyectos' => $proyectos, 
       				'accion_centralizada' => $accioncentralizada,
       				'unidadesejecutoras' => $unidadesejecutoras,
       				'variablesproyecto' => $variablesproyecto,
                    'variablescentral' => $variablescentral,
                    'meses' => $meses,

       			]);
        }
   	}

   	/**
     * Funcion de respuesta para el AJAX de
     * acciones especificas
     * @return array JSON 
     */
    
    public function actionAccespecifica()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Acciones Especificas

                $ace = AcAcEspec::find()
                    ->select(["accion_centralizada_accion_especifica.id", "CONCAT(accion_centralizada_accion_especifica.cod_ac_espe,' - ',accion_centralizada_accion_especifica.nombre) AS name"])
                    ->innerjoin('accion_centralizada', 'accion_centralizada.id=accion_centralizada_accion_especifica.id_ac_centr')
                    ->where(['accion_centralizada.id' => $request->post('depdrop_parents'), 'accion_centralizada_accion_especifica.estatus' => 1])
                    ->asArray()
                    ->all();
                //si trae algo, colocamos en la primera opcion "todos"
                if($ace!=null)
                {
                    array_unshift($ace, ['id' => 'x999', 'name' => 'Todos']);
                    
                }
                return [
                    'output' => $ace
                ];
            }
        }
        
    }

    /**
     * Funcion de respuesta para el AJAX de
     * acciones especificas
     * @return array JSON 
     */
    
    public function actionProyectoespecifica()
    {
        $request = Yii::$app->request;

        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isPost)
            {
                //Acciones Especificas
                $ace = ProyectoAccionEspecifica::find()
                    ->select(["proyecto_accion_especifica.id", "CONCAT(proyecto_accion_especifica.codigo_accion_especifica,' - ',proyecto_accion_especifica.nombre) AS name"])
                    ->innerjoin('proyecto', 'proyecto.id=proyecto_accion_especifica.id_proyecto')
                    ->where(['proyecto.id' => $request->post('depdrop_parents'), 'proyecto_accion_especifica.estatus' => 1])
                    ->asArray()
                    ->all();                

                 //si trae algo, colocamos en la primera opcion "todos"
                if($ace!=null)
                {
                    array_unshift($ace, ['id' => 'x999', 'name' => 'Todos']);
                }
                return [
                    'output' => $ace
                ];
            }
        }
        
    }

    public function actionPdf1()
    {
        
        $request = Yii::$app->request->get();
        //print_r($request['model']); exit();  
        $datos=$request['model'];
        $reporte=new ReportePlanificacion;
        $meses['id']=$datos['meses'];
        
    // get your HTML raw content without any layouts or scripts
    
    $content = $this->renderPartial('resultado_reportepdf1',[
        'model' => $reporte->reportepdf1($datos),
        'meses' => $meses,
        'post' => Yii::$app->request->post(),
        ]);
 
    // setup kartik\mpdf\Pdf component
    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        
        // portrait orientation
        'orientation' => Pdf::ORIENT_LANDSCAPE,//ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        // any css to be embedded if required
        'cssInline' => '.kv-heading-1{font-size:18px}', 
         // set mPDF properties on the fly
        'options' => ['title' => 'Planificación Reporte 1'],
         // call mPDF methods on the fly
        'methods' => [ 
            'SetHeader'=>['<img src="img/cintillo.jpg" height="35px;" width="100%;">'], 
            'SetFooter'=>['{PAGENO}'],
            
        ]
    ]);
        //$pdf->SetHTMLHeader('<div><img src="img/cintillo.jpg"/></div>');
        $pdf->marginHeader=3;
        return $pdf->render(); 
        
    }

    public function actionXls1()
    {
        //header("Content-type: application/vnd.ms-excel charset=UTF-8");
        //header("Content-Disposition: attachment;Filename=Planificacion_Reporte1.xls");

        header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
        header("Content-Disposition: filename=ficheroExcel.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $request = Yii::$app->request->get();
        //print_r($request['model']); exit();  
        $datos=$request['model'];
        $reporte=new ReportePlanificacion;
        $meses['id']=$datos['meses'];
        // get your HTML raw content without any layouts or scripts
        
        $content = $this->renderPartial('resultado_reportexls1',[
        'model' => $reporte->reportepdf1($datos),
        'meses' => $meses,
        'post' => Yii::$app->request->post(),
        ]);
        
        echo utf8_decode($content);
        exit();
        //Yii::app()->end();
    }

}