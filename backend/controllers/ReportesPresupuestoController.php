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
use backend\models\ReportePresupuesto;
/**
 * ReportesPresupuestoController implements the CRUD actions for Feedback model.
 */
class ReportesPresupuestoController extends \common\controllers\BaseController
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
   		$materiales = MaterialesServicios::find()->all();
        array_unshift($materiales, ['id' => 'x999', 'nombre' => 'Todos']);
        array_push($materiales, ['id' => '-1', 'nombre' => 'Ninguno']);
   		$unidadesejecutoras = UnidadEjecutora::find()->all();
        array_unshift($unidadesejecutoras, ['id' => 'x999', 'nombre' => 'Todos']);
        array_push($unidadesejecutoras, ['id' => '-1', 'nombre' => 'Ninguno']);
        
        if(Yii::$app->request->post())
        {
            $reporte=new ReportePresupuesto;
            return $this->render('resultado_reporte1',[
            'model' => $reporte->reporte1(Yii::$app->request->post()),
            ]);
            
        }
        else
        {

       		return $this->render('reporte1',
       			[
       				'proyectos' => $proyectos, 
       				'accion_centralizada' => $accioncentralizada,
       				'unidadesejecutoras' => $unidadesejecutoras,
       				'materiales' => $materiales,
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

}