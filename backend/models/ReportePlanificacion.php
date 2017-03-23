<?php

namespace backend\models;
use yii\data\ArrayDataProvider;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property integer $id
 * @property string $nombre
 */
class ReportePlanificacion extends \yii\db\ActiveRecord
{

    

    /**
    **sql para generar el reporte con los filtros necesarios
    **@param $pos array
    **@return dataprovider array
    **/
    public function reporte1($pos)
    {
        //declarando variables del filtro
        $accioncentralizada="";
        $accespecifica="";
        $proyecto="";
        $proyectoespecifica="";
        $materiales="";
        $unidades="";
        $partida=""; 

        if($pos['accion_centralizada']!='-1')
        {
            if($pos['accion_centralizada']!='x999')
            {
                $accioncentralizada=" and a.id=".$pos['accion_centralizada'];
            }
            

            if(isset($pos['acc_especifica']) && $pos['acc_especifica']!='x999' && $pos['acc_especifica']!='')
            {
                $accespecifica=" and b.id=".$pos['acc_especifica'];
            }
        }
        else
        {
            $accioncentralizada=" and a.id=-1 ";
        }
        //verificacion de filtros proyectos
        if($pos['proyectos']!='-1')
        {
            if($pos['proyectos']!='x999')
            {
                $proyecto=" and a.id=".$pos['proyectos'];
            }
            
            if(isset($pos['proyectos_especifica']) && $pos['proyectos_especifica']!='x999' && $pos['proyectos_especifica']!='')
            {
                $proyectoespecifica=" and b.id=".$pos['proyectos_especifica'];
            }
        }
        else
        {
            $proyecto=" and a.id=-1 ";
        }

        //variables
        if(isset($pos['variablescentral']) && $pos['variablescentral']!='x999' && $pos['variablescentral']!='')
        {
            $variablescentral=" and c.id=".$pos['variablescentral'];
        }
        else
        {
            $variablescentral="";   
        }

        if(isset($pos['variablesproyecto']) && $pos['variablesproyecto']!='x999' && $pos['variablesproyecto']!='')
        {
            $variablesproyecto=" and c.id=".$pos['variablesproyecto'];
        }
        else
        {
            $variablesproyecto="";   
        }
        
        //verificando Filtros de unidad ejecutora
        if($pos['unidadessejecutoras']!='x999')
        {
            $unidades=" and g.id=".$pos['unidadessejecutoras'];
        }

    $sql="

    SELECT a.codigo_accion as codigo, a.nombre_accion AS nombre, c.nombre_variable, h.unidad_medida, 
    e.enero, 
    e.febrero, 
    (e.febrero+e.enero) as febrero_acu, 
    e.marzo, 
    (e.febrero+e.enero+e.marzo) as marzo_acu,
    e.abril, (e.febrero+e.enero+e.marzo+e.abril) as abril_acu,
    e.mayo,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo) as mayo_acu,
    e.junio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio) as junio_acu,
    e.julio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio) as julio_acu,
    e.agosto,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto) as agosto_acu,
    e.septiembre, 
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre) as septiembre_acu,
    e.octubre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre) as octubre_acu, 
    e.noviembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre) as noviembre_acu,
    e.diciembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre+e.diciembre) as diciembre_acu,
    f.enero as enero_eje,
    f.febrero as febrero_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)) as febrero_acu_eje,
    f.marzo as marzo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)) as marzo_acu_eje,
    f.abril as abril_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)) as abril_acu_eje, f.mayo as mayo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)) as mayo_acu_eje,
    f.junio as junio_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)) as junio_acu_eje,
    f.julio as julio_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)) as julio_acu_eje,
    f.agosto as agosto_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)) as agosto_acu_eje,
    f.septiembre as septiembre_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)) as septiembre_acu_eje,
    f.octubre as octubre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)) as octubre_acu_eje,
    f.noviembre as noviembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)) as noviembre_acu_eje,
    f.diciembre as diciembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)+ifnull(f.diciembre,0)) as diciembre_acu_eje,
    g.nombre as unidad_ejecutora
    FROM accion_centralizada AS a
    INNER JOIN accion_centralizada_accion_especifica AS b ON a.id = b.id_ac_centr
    INNER JOIN accion_centralizada_variables AS c ON b.id = c.acc_accion_especifica
    INNER JOIN localizacion_acc_variable AS d ON c.id = d.id_variable
    INNER JOIN accion_centralizada_variable_programacion AS e ON d.id = e.id_localizacion
    INNER JOIN accion_centralizada_variable_ejecucion AS f ON e.id = f.id_programacion
    INNER JOIN unidad_ejecutora AS g ON c.unidad_ejecutora = g.id
    INNER JOIN unidad_medida AS h ON c.unidad_medida=h.id
    where 1=1 
    ".$accioncentralizada.$accespecifica.$variablescentral.$unidades."

union all

    SELECT a.codigo_proyecto as codigo, a.nombre AS nombre, c.nombre_variable, h.unidad_medida, 
    e.enero,
    e.febrero,
    (e.febrero+e.enero) as febrero_acu,
    e.marzo,
    (e.febrero+e.enero+e.marzo) as marzo_acu,
    e.abril,
    (e.febrero+e.enero+e.marzo+e.abril) as abril_acu,
    e.mayo,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo) as mayo_acu,
    e.junio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio) as junio_acu,
    e.julio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio) as julio_acu,
    e.agosto,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto) as agosto_acu,
    e.septiembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre) as septiembre_acu,
    e.octubre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre) as octubre_acu,
    e.noviembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre) as noviembre_acu,
    e.diciembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre+e.diciembre) as diciembre_acu,
    f.enero as enero_eje,
    f.febrero as febrero_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)) as febrero_acu_eje,
    f.marzo as marzo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)) as marzo_acu_eje,
    f.abril as abril_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)) as abril_acu_eje, f.mayo as mayo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)) as mayo_acu_eje,
    f.junio as junio_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)) as junio_acu_eje,
    f.julio as julio_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)) as julio_acu_eje,
    f.agosto as agosto_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)) as agosto_acu_eje,
    f.septiembre as septiembre_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)) as septiembre_acu_eje,
    f.octubre as octubre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)) as octubre_acu_eje,
    f.noviembre as noviembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)) as noviembre_acu_eje,
    f.diciembre as diciembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)+ifnull(f.diciembre,0)) as diciembre_acu_eje,
    g.nombre as unidad_ejecutora
    FROM proyecto AS a
    INNER JOIN proyecto_accion_especifica AS b ON a.id = b.id_proyecto
    INNER JOIN proyecto_variables AS c ON b.id = c.accion_especifica
    INNER JOIN proyecto_variable_localizacion AS d ON c.id = d.id_variable
    INNER JOIN proyecto_variable_programacion AS e ON d.id = e.id_localizacion
    INNER JOIN proyecto_variable_ejecucion AS f ON e.id = f.id_programacion
    INNER JOIN unidad_ejecutora AS g ON c.unidad_ejecutora = g.id
    INNER JOIN unidad_medida AS h ON c.unidad_medida=h.id
    where 1=1 
    ".$proyecto.$proyectoespecifica.$variablesproyecto.$unidades."
    ";    
    //Arreglo para el DataProvider
    $query = Yii::$app->db->createCommand($sql)->queryAll();
    //DataProvider
    $dataProvider = new ArrayDataProvider([
        'allModels' => $query,
    ]);
    return $dataProvider;
    
    }

    /*
    *Obtener array de meses.
    *@return array
    */
    public function meses()
    {
        return $meses=[['id' => 1, 'nombre' =>'Enero'],['id' =>  2, 'nombre'=>'Febrero'],['id' => 3, 'nombre' => 'Marzo'],['id' => 4,'nombre' => 'Abril'],['id' => 5, 'nombre' => 'Mayo'],['id' =>  6, 'nombre' => 'Junio'],[ 'id' => 7, 'nombre' => 'Julio'],['id' => 8, 'nombre' => 'Agosto'],['id'=> 9, 'nombre' => 'Noviembre'],['id'=> 10, 'nombre' => 'Octubre'],['id' => 11, 'nombre' => 'Noviembre'],[ 'id' => 12, 'nombre' => 'Diciembre']];
    }


    /**
    **sql para generar el reporte con los filtros necesarios
    **@param $pos array
    **@return array
    **/
    public function reportepdf1($pos)
    {
        //declarando variables del filtro
        $accioncentralizada="";
        $accespecifica="";
        $proyecto="";
        $proyectoespecifica="";
        $materiales="";
        $unidades="";
        $partida=""; 

        if($pos['accion_centralizada']!='-1')
        {
            if($pos['accion_centralizada']!='x999')
            {
                $accioncentralizada=" and a.id=".$pos['accion_centralizada'];
            }
            

            if(isset($pos['acc_especifica']) && $pos['acc_especifica']!='x999' && $pos['acc_especifica']!='')
            {
                $accespecifica=" and b.id=".$pos['acc_especifica'];
            }
        }
        else
        {
            $accioncentralizada=" and a.id=-1 ";
        }
        //verificacion de filtros proyectos
        if($pos['proyectos']!='-1')
        {
            if($pos['proyectos']!='x999')
            {
                $proyecto=" and a.id=".$pos['proyectos'];
            }
            
            if(isset($pos['proyectos_especifica']) && $pos['proyectos_especifica']!='x999' && $pos['proyectos_especifica']!='')
            {
                $proyectoespecifica=" and b.id=".$pos['proyectos_especifica'];
            }
        }
        else
        {
            $proyecto=" and a.id=-1 ";
        }

        //variables
        if(isset($pos['variablescentral']) && $pos['variablescentral']!='x999' && $pos['variablescentral']!='')
        {
            $variablescentral=" and c.id=".$pos['variablescentral'];
        }
        else
        {
            $variablescentral="";   
        }

        if(isset($pos['variablesproyecto']) && $pos['variablesproyecto']!='x999' && $pos['variablesproyecto']!='')
        {
            $variablesproyecto=" and c.id=".$pos['variablesproyecto'];
        }
        else
        {
            $variablesproyecto="";   
        }
        
        //verificando Filtros de unidad ejecutora
        if($pos['unidadessejecutoras']!='x999')
        {
            $unidades=" and g.id=".$pos['unidadessejecutoras'];
        }

    $sql="

    SELECT a.codigo_accion as codigo, a.nombre_accion AS nombre, c.nombre_variable, h.unidad_medida, 
    e.enero, (e.enero) as enero_acu,
    e.febrero, 
    (e.febrero+e.enero) as febrero_acu, 
    e.marzo, 
    (e.febrero+e.enero+e.marzo) as marzo_acu,
    e.abril, (e.febrero+e.enero+e.marzo+e.abril) as abril_acu,
    e.mayo,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo) as mayo_acu,
    e.junio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio) as junio_acu,
    e.julio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio) as julio_acu,
    e.agosto,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto) as agosto_acu,
    e.septiembre, 
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre) as septiembre_acu,
    e.octubre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre) as octubre_acu, 
    e.noviembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre) as noviembre_acu,
    e.diciembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre+e.diciembre) as diciembre_acu,
    f.enero as enero_eje, (f.enero) as enero_acu_eje,
    f.febrero as febrero_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)) as febrero_acu_eje,
    f.marzo as marzo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)) as marzo_acu_eje,
    f.abril as abril_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)) as abril_acu_eje, f.mayo as mayo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)) as mayo_acu_eje,
    f.junio as junio_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)) as junio_acu_eje,
    f.julio as julio_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)) as julio_acu_eje,
    f.agosto as agosto_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)) as agosto_acu_eje,
    f.septiembre as septiembre_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)) as septiembre_acu_eje,
    f.octubre as octubre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)) as octubre_acu_eje,
    f.noviembre as noviembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)) as noviembre_acu_eje,
    f.diciembre as diciembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)+ifnull(f.diciembre,0)) as diciembre_acu_eje,
    g.nombre as unidad_ejecutora
    FROM accion_centralizada AS a
    INNER JOIN accion_centralizada_accion_especifica AS b ON a.id = b.id_ac_centr
    INNER JOIN accion_centralizada_variables AS c ON b.id = c.acc_accion_especifica
    INNER JOIN localizacion_acc_variable AS d ON c.id = d.id_variable
    INNER JOIN accion_centralizada_variable_programacion AS e ON d.id = e.id_localizacion
    INNER JOIN accion_centralizada_variable_ejecucion AS f ON e.id = f.id_programacion
    INNER JOIN unidad_ejecutora AS g ON c.unidad_ejecutora = g.id
    INNER JOIN unidad_medida AS h ON c.unidad_medida=h.id
    where 1=1 
    ".$accioncentralizada.$accespecifica.$variablescentral.$unidades."

union all

    SELECT a.codigo_proyecto as codigo, a.nombre AS nombre, c.nombre_variable, h.unidad_medida, 
    e.enero, (e.enero) as enero_acu,
    e.febrero,
    (e.febrero+e.enero) as febrero_acu,
    e.marzo,
    (e.febrero+e.enero+e.marzo) as marzo_acu,
    e.abril,
    (e.febrero+e.enero+e.marzo+e.abril) as abril_acu,
    e.mayo,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo) as mayo_acu,
    e.junio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio) as junio_acu,
    e.julio,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio) as julio_acu,
    e.agosto,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto) as agosto_acu,
    e.septiembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre) as septiembre_acu,
    e.octubre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre) as octubre_acu,
    e.noviembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre) as noviembre_acu,
    e.diciembre,
    (e.febrero+e.enero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre+e.diciembre) as diciembre_acu,
    f.enero as enero_eje, (f.enero) as enero_acu_eje,
    f.febrero as febrero_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)) as febrero_acu_eje,
    f.marzo as marzo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)) as marzo_acu_eje,
    f.abril as abril_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)) as abril_acu_eje, f.mayo as mayo_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)) as mayo_acu_eje,
    f.junio as junio_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)) as junio_acu_eje,
    f.julio as julio_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)) as julio_acu_eje,
    f.agosto as agosto_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)) as agosto_acu_eje,
    f.septiembre as septiembre_eje, 
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)) as septiembre_acu_eje,
    f.octubre as octubre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)) as octubre_acu_eje,
    f.noviembre as noviembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)) as noviembre_acu_eje,
    f.diciembre as diciembre_eje,
    (ifnull(f.febrero,0)+ifnull(f.enero,0)+ifnull(f.marzo,0)+ifnull(f.abril,0)+ifnull(f.mayo,0)+ifnull(f.junio,0)+ifnull(f.julio,0)+ifnull(f.agosto,0)+ifnull(f.septiembre,0)+ifnull(f.octubre,0)+ifnull(f.noviembre,0)+ifnull(f.diciembre,0)) as diciembre_acu_eje,
    g.nombre as unidad_ejecutora
    FROM proyecto AS a
    INNER JOIN proyecto_accion_especifica AS b ON a.id = b.id_proyecto
    INNER JOIN proyecto_variables AS c ON b.id = c.accion_especifica
    INNER JOIN proyecto_variable_localizacion AS d ON c.id = d.id_variable
    INNER JOIN proyecto_variable_programacion AS e ON d.id = e.id_localizacion
    INNER JOIN proyecto_variable_ejecucion AS f ON e.id = f.id_programacion
    INNER JOIN unidad_ejecutora AS g ON c.unidad_ejecutora = g.id
    INNER JOIN unidad_medida AS h ON c.unidad_medida=h.id
    where 1=1 
    ".$proyecto.$proyectoespecifica.$variablesproyecto.$unidades."
    ";    
    //Arreglo para el DataProvider
    $query = Yii::$app->db->createCommand($sql)->queryAll();
    
    return $query;
    
    }

    /*Regresa el nombre del mes
    *@paramts integer id
    *@return String
    */
    Public function Nombremes($id)
    {
        switch ($id) {
            case '1':
                return 'Enero';
            break;

            case '2':
                return 'Febrero';
            break;

            case '3':
                return 'Marzo';
            break;
            case '4':
                return 'Abril';
            break;
            case '5':
                return 'Mayo';
            break;
            case '6':
                return 'Junio';
            break;
            case '7':
                return 'Julio';
            break;
            case '8':
                return 'Agosto';
            break;
            case '9':
                return 'Septiembre';
            break;
            case '10':
                return 'Octubre';
            break;
            case '11':
                return 'Noviembre';
            break;
            case '12':
                return 'Diciembre';
            break;
            
            default:
                return 'Error';
            break;
        }
        
    }
}