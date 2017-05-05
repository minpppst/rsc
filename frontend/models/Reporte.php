<?php

namespace frontend\models;
use common\models\AccionCentralizadaAsignar;
use common\models\AccionCentralizada;
use backend\models\accion_centralizada_variables;
use common\models\Proyecto;
use backend\models\ProyectoVariables;
use common\models\Estados;
use yii\data\ArrayDataProvider;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property integer $id
 * @property string $nombre
 */
class Reporte extends \yii\db\ActiveRecord
{
    /*
    *Obtener array de meses.
    *@return array
    */
    public function meses()
    {
        return $meses=[['id' => 1, 'nombre' =>'Enero'],['id' =>  2, 'nombre'=>'Febrero'],['id' => 3, 'nombre' => 'Marzo'],['id' => 4,'nombre' => 'Abril'],['id' => 5, 'nombre' => 'Mayo'],['id' =>  6, 'nombre' => 'Junio'],[ 'id' => 7, 'nombre' => 'Julio'],['id' => 8, 'nombre' => 'Agosto'],['id'=> 9, 'nombre' => 'Septiembre'],['id'=> 10, 'nombre' => 'Octubre'],['id' => 11, 'nombre' => 'Noviembre'],[ 'id' => 12, 'nombre' => 'Diciembre']];
    }

    /**
    **sql para generar el reporte con los filtros necesarios
    **@param $pos array
    **@return array
    **/
    public function reportepdf1($pos=null)
    {
        //declarando variables del filtro
        $accioncentralizada="";
        $proyecto="";
        $ACvariable="";
        $Pvariable="";
        $estado="";
        $estadosFiltro="";
        $innerjoin="";
        $unidades="";
        $whereNacional="";
        
        //filtro accion centralizada
        if($pos['accion_centralizada']!='x999')
        {
            $accioncentralizada=" and a.id=".$pos['accion_centralizada'].' ';
        }

        //filtro proyecto
        if($pos['proyectos']!='x999'  )
        {
            $proyecto=" and a.id=".$pos['proyectos'].' ';
        }

        //filtro variable accion_central
        if($pos['variablescentral']!='x999')
        {
            $ACvariable=' and c.id='.$pos['variablescentral'].' ';
        }


        //filtro variable proyecto
        if($pos['variablesproyecto']!='x999')
        {
            $Pvariable=' and c.id='.$pos['variablesproyecto'].' ';
        }

        //filtro estados
        if($pos['estados']!='x999')
        {
            $estado=' and i.id='.$pos['estados'].' ';
            $estadosFiltro= " if(i.nombre is null, 'Nacional', i.nombre) as estado,";
            $innerjoin="INNER JOIN estados AS i ON d.id_estado=i.id";

        }
        else
        {
            $estadosFiltro= " 'Nacional'  as estado,";
            $whereNacional=" and d.id_estado is null ";
        }


        $ueaccion=AccionCentralizadaAsignar::find()
        ->select('accion_centralizada_ac_especifica_uej.id_ue')
        ->innerjoin('accion_centralizada_ac_especifica_uej', 'accion_centralizada_asignar.accion_especifica_ue=accion_centralizada_ac_especifica_uej.id')
        ->where(['accion_centralizada_asignar.usuario' => Yii::$app->user->id])
        ->Asarray()
        ->all();
        
        $ueproyecto=ProyectoUsuarioAsignar::find()
        ->select('proyecto_accion_especifica.id_unidad_ejecutora as id_ue')
        ->innerjoin('proyecto_accion_especifica', 'proyecto_accion_especifica.id=proyecto_usuario_asignar.accion_especifica_id')
        ->where(['proyecto_usuario_asignar.usuario_id' => Yii::$app->user->id])
        ->Asarray()
        ->all();

        if($ueaccion!=NULL || $ueproyecto!=NULL)
        {
            $unidades1=array_unique(array_merge($ueaccion,$ueproyecto), SORT_REGULAR); 
            
            foreach ($unidades1 as $key => $value) 
            {
                $unidades.="'".$value['id_ue']."',";
            }
            $unidades=substr($unidades, 0, -1);
            
            $unidades=" and g.id in (".$unidades.")";
            
            if($ueaccion==null)
            {
                $unidadesc="and g.id in ('-1')";
            }
            else
            {
                $unidadesc=$unidades;   
            }
            if($ueproyecto==null)
            {
                $unidadesp="and g.id in ('-1')";
            }
            else
            {
                $unidadesp=$unidades;   
            }

        if(isset($pos['agruparvariables']) && $pos['agruparvariables']==1)
        {
            $sql="

            SELECT a.codigo_accion as codigo, a.nombre_accion AS nombre, c.nombre_variable, h.unidad_medida, 'Nacional' as estado, 
            sum(e.enero) as enero,sum(e.enero) as enero_acu, sum(e.febrero) as febrero, (sum(e.febrero)+sum(e.enero)) as febrero_acu, sum(e.marzo) as marzo, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)) as marzo_acu, sum(e.abril) as abril, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)) as abril_acu, sum(e.mayo) as mayo, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)) as mayo_acu, sum(e.junio) as junio, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)) as junio_acu, sum(e.julio) as julio, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)) as julio_acu, sum(e.agosto) as agosto, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)) as agosto_acu, sum(e.septiembre) as septiembre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)) as septiembre_acu, sum(e.octubre) as octubre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)+sum(e.octubre)) as octubre_acu, sum(e.noviembre) as noviembre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)+sum(e.octubre)+sum(e.noviembre)) as noviembre_acu, sum(e.diciembre) as diciembre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)+sum(e.octubre)+sum(e.noviembre)+sum(e.diciembre)) as diciembre_acu,
            sum(f.enero) as enero_eje, (ifnull(sum(f.enero),0)) as enero_acu_eje, sum(f.febrero) as febrero_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)) as febrero_acu_eje, sum(f.marzo) as marzo_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)) as marzo_acu_eje, sum(f.abril) as abril_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)) as abril_acu_eje, sum(f.mayo) as mayo_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)) as mayo_acu_eje, sum(f.junio) as junio_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)) as junio_acu_eje, sum(f.julio) as julio_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)) as julio_acu_eje, sum(f.agosto) as agosto_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)) as agosto_acu_eje, sum(f.septiembre) as septiembre_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)) as septiembre_acu_eje, sum(f.octubre) as octubre_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)+ifnull(sum(f.octubre),0)) as octubre_acu_eje, sum(f.noviembre) as noviembre_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)+ifnull(sum(f.octubre),0)+ifnull(sum(f.noviembre),0)) as noviembre_acu_eje, sum(f.diciembre) as diciembre_eje, 
            (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)+ifnull(sum(f.octubre),0)+ifnull(sum(f.noviembre),0)+ifnull(sum(f.diciembre),0)) as diciembre_acu_eje, 
            g.nombre as unidad_ejecutora 
            FROM accion_centralizada AS a
            INNER JOIN accion_centralizada_accion_especifica AS b ON a.id = b.id_ac_centr
            INNER JOIN accion_centralizada_variables AS c ON b.id = c.acc_accion_especifica
            INNER JOIN localizacion_acc_variable AS d ON c.id = d.id_variable
            INNER JOIN accion_centralizada_variable_programacion AS e ON d.id = e.id_localizacion
            INNER JOIN accion_centralizada_variable_ejecucion AS f ON e.id = f.id_programacion
            INNER JOIN unidad_ejecutora AS g ON c.unidad_ejecutora = g.id
            INNER JOIN unidad_medida AS h ON c.unidad_medida=h.id
            ".$innerjoin."
            where 1=1 
            ".$unidadesc.$accioncentralizada.$ACvariable.$estado.$whereNacional."

        union all

            SELECT a.codigo_proyecto as codigo, a.nombre AS nombre, c.nombre_variable, h.unidad_medida, 'Nacional' as estado, 
        sum(e.enero) as enero,sum(e.enero) as enero_acu, sum(e.febrero) as febrero, (sum(e.febrero)+sum(e.enero)) as febrero_acu, sum(e.marzo) as marzo, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)) as marzo_acu, sum(e.abril) as abril, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)) as abril_acu, sum(e.mayo) as mayo, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)) as mayo_acu, sum(e.junio) as junio, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)) as junio_acu, sum(e.julio) as julio, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)) as julio_acu, sum(e.agosto) as agosto, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)) as agosto_acu, sum(e.septiembre) as septiembre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)) as septiembre_acu, sum(e.octubre) as octubre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)+sum(e.octubre)) as octubre_acu, sum(e.noviembre) as noviembre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)+sum(e.octubre)+sum(e.noviembre)) as noviembre_acu, sum(e.diciembre) as diciembre, (sum(e.febrero)+sum(e.enero)+sum(e.marzo)+sum(e.abril)+sum(e.mayo)+sum(e.junio)+sum(e.julio)+sum(e.agosto)+sum(e.septiembre)+sum(e.octubre)+sum(e.noviembre)+sum(e.diciembre)) as diciembre_acu,
        sum(f.enero) as enero_eje, sum(f.enero) as enero_acu_eje, sum(f.febrero) as febrero_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)) as febrero_acu_eje, sum(f.marzo) as marzo_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)) as marzo_acu_eje, sum(f.abril) as abril_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)) as abril_acu_eje, sum(f.mayo) as mayo_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)) as mayo_acu_eje, sum(f.junio) as junio_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)) as junio_acu_eje, sum(f.julio) as julio_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)) as julio_acu_eje, sum(f.agosto) as agosto_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)) as agosto_acu_eje, sum(f.septiembre) as septiembre_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)) as septiembre_acu_eje, sum(f.octubre) as octubre_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)+ifnull(sum(f.octubre),0)) as octubre_acu_eje, sum(f.noviembre) as noviembre_eje, (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)+ifnull(sum(f.octubre),0)+ifnull(sum(f.noviembre),0)) as noviembre_acu_eje, sum(f.diciembre) as diciembre_eje, 
        (ifnull(sum(f.febrero),0)+ifnull(sum(f.enero),0)+ifnull(sum(f.marzo),0)+ifnull(sum(f.abril),0)+ifnull(sum(f.mayo),0)+ifnull(sum(f.junio),0)+ifnull(sum(f.julio),0)+ifnull(sum(f.agosto),0)+ifnull(sum(f.septiembre),0)+ifnull(sum(f.octubre),0)+ifnull(sum(f.noviembre),0)+ifnull(sum(f.diciembre),0)) as diciembre_acu_eje, 
       g.nombre as unidad_ejecutora 
            FROM proyecto AS a
            INNER JOIN proyecto_accion_especifica AS b ON a.id = b.id_proyecto
            INNER JOIN proyecto_variables AS c ON b.id = c.accion_especifica
            INNER JOIN proyecto_variable_localizacion AS d ON c.id = d.id_variable
            INNER JOIN proyecto_variable_programacion AS e ON d.id = e.id_localizacion
            INNER JOIN proyecto_variable_ejecucion AS f ON e.id = f.id_programacion
            INNER JOIN unidad_ejecutora AS g ON c.unidad_ejecutora = g.id
            INNER JOIN unidad_medida AS h ON c.unidad_medida=h.id
            ".$innerjoin."
            where 1=1 
            ".$unidadesp.$proyecto.$Pvariable.$estado.$whereNacional."
            ";        
        }else
        {
            $sql="

        SELECT a.codigo_accion as codigo, a.nombre_accion AS nombre, c.nombre_variable, h.unidad_medida, ".$estadosFiltro."
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
        ".$innerjoin."
        where 1=1 
        ".$unidadesc.$accioncentralizada.$ACvariable.$estado.$whereNacional."

    union all

        SELECT a.codigo_proyecto as codigo, a.nombre AS nombre, c.nombre_variable, h.unidad_medida, ".$estadosFiltro."
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
        ".$innerjoin."
        where 1=1 
        ".$unidadesp.$proyecto.$Pvariable.$estado.$whereNacional."
        ";        
        }
        
        //Arreglo para el DataProvider
        //print_r($sql); exit();
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        return $query;
        }// fin de encontrar unidades
    
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

    /**
    * Busca las acciones centralizadas por unidad ejecutora
    *@return array
    */
    public static function EjecuccionAC()
    {
        $accion=AccionCentralizada::find()
        ->select('accion_centralizada.id, accion_centralizada.nombre_accion')
        ->innerjoin('accion_centralizada_accion_especifica', 'accion_centralizada.id=accion_centralizada_accion_especifica.id_ac_centr')
        ->innerjoin('accion_centralizada_ac_especifica_uej', 'accion_centralizada_accion_especifica.id=accion_centralizada_ac_especifica_uej.id_ac_esp')
        ->innerjoin('accion_centralizada_asignar', 'accion_centralizada_asignar.accion_especifica_ue=accion_centralizada_ac_especifica_uej.id')
        ->where(['accion_centralizada_asignar.usuario' => Yii::$app->user->id])
        ->orderby([('accion_centralizada.nombre_accion')=> SORT_ASC])
        ->asarray()
        ->all();
        if($accion!=null)
        {
            
            
            array_unshift($accion, ['id' => 'x999', 'nombre_accion' => 'Todos']);
            array_push($accion, ['id' => '-1', 'nombre_accion' => 'Ninguno']);
            return $accion;
        }
        else
        {
            $accion=[];
            array_push($accion, ['id' => '-1', 'nombre_accion' => 'No Posee']);
            return $accion;
        }
    }


    /**
    * Busca los proyectos por unidad ejecutora
    *@return array
    */
    public static function EjecuccionP()
    {
        $proyecto=Proyecto::find()
        ->select('proyecto.id, proyecto.nombre')
        ->innerjoin('proyecto_usuario_asignar', 'proyecto.id=proyecto_usuario_asignar.proyecto_id')
        ->where(['proyecto_usuario_asignar.usuario_id' => Yii::$app->user->id])
        ->asarray()
        ->orderby([('proyecto.nombre') => SORT_ASC])
        ->all();
        if($proyecto!=null)
        {
            array_unshift($proyecto, ['id' => 'x999', 'nombre' => 'Todos']);
            array_push($proyecto, ['id' => '-1', 'nombre' => 'Ninguno']);
            return $proyecto;

        }
        else
        {
            $proyecto=[];
            array_push($proyecto, ['id' => '-1', 'nombre' => 'No Posee']);
            return $proyecto;
            
        }
    }

    /**
    * Busca las variables de las acciones por unidad ejecutora
    *@return array
    */
    public static function EjecuccionVAC()
    {
        $accion=AccionCentralizadaAsignar::find()
        ->select('accion_centralizada_variables.id, accion_centralizada_variables.nombre_variable')
        ->innerjoin('accion_centralizada_ac_especifica_uej', 'accion_centralizada_asignar.accion_especifica_ue=accion_centralizada_ac_especifica_uej.id')
        ->innerjoin('accion_centralizada_variables', 'accion_centralizada_variables.unidad_ejecutora=accion_centralizada_ac_especifica_uej.id_ue')
        ->where(['accion_centralizada_asignar.usuario' => Yii::$app->user->id])
        ->asarray()
        ->orderby([('accion_centralizada_variables.nombre_variable') => SORT_ASC])
        ->all();
        if($accion!=null)
        {
            array_unshift($accion, ['id' => 'x999', 'nombre_variable' => 'Todos']);
            array_push($accion, ['id' => '-1', 'nombre_variable' => 'Ninguno']);
            return $accion;
        }
        else
        {
            $accion=[];
            array_push($accion, ['id' => '-1', 'nombre_variable' => 'No Posee']);
            return $accion;
        }
    }

    /**
    * Busca las variables de proyectos por unidad ejecutora
    *@return array
    */
    public static function EjecuccionVP()
    {
        $proyecto=ProyectoVariables::find()
        ->select('proyecto_variables.id, proyecto_variables.nombre_variable')
        ->innerjoin('proyecto_accion_especifica', 'proyecto_variables.accion_especifica=proyecto_accion_especifica.id')
        ->innerjoin('proyecto_usuario_asignar', 'proyecto_accion_especifica.id=proyecto_usuario_asignar.accion_especifica_id')
        ->where(['proyecto_usuario_asignar.usuario_id' => Yii::$app->user->id])
        ->asarray()
        ->orderby([('proyecto_variables.nombre_variable') => SORT_ASC])
        ->all();
        if($proyecto!=null)
        {
            array_unshift($proyecto, ['id' => 'x999', 'nombre_variable' => 'Todos']);
            array_push($proyecto, ['id' => '-1', 'nombre_variable' => 'Ninguno']);
            return $proyecto;
        }
        else
        {
            $proyecto=[];
            array_push($proyecto, ['id' => '-1', 'nombre_variable' => 'No Posee']);
            return $proyecto;
        }
    }

    public static function Estados()
    {
        $estados= Estados::find()->asarray()->orderby([('nombre') => SORT_ASC])->all();
        array_unshift($estados, ['id' => 'x999', 'nombre' => 'Nacional']);
        return $estados;
    }

}