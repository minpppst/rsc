<?php

namespace frontend\controllers;

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
use common\models\Estados;
use backend\models\AccionCentralizadaVariables;
use backend\models\ProyectoVariables;
use frontend\models\Reporte;
use kartik\mpdf\Pdf;
use yii\data\ArrayDataProvider;


/**
 * ReportesPresupuestoController implements the CRUD actions for Feedback model.
 */
class ReporteController extends \common\controllers\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
    *Filtro para el reporte
    *
    */
    public function actionFiltro()
   	{
   		//datos del filtro
        $accioncentralizada= Reporte::EjecuccionAC();
   		$proyectos= Reporte::EjecuccionP();
   		$variablescentral = Reporte::EjecuccionVAC();
        $variablesproyecto = Reporte::EjecuccionVP();
        $estados =Reporte::Estados();
        
   		return $this->render('filtro',
   			[
   				'proyectos' => $proyectos,
   				'accion_centralizada' => $accioncentralizada,
   				'variablesproyecto' => $variablesproyecto,
                'variablescentral' => $variablescentral,
                'estados' => $estados,
   			]);
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

    /**
    * Generar PDF
    */
    public function actionPdf1()
    {
        $request = Yii::$app->request;
        
        /* [accion_centralizada] => x999 [proyectos] => -1 [variablescentral] => x999 [variablesproyecto] => -1 [estados] => x999*/
        $reporte=new Reporte;
        $content = $this->renderPartial('resultado_reportepdf1',[
        'model' => $reporte->reportepdf1($request->post()),
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

}