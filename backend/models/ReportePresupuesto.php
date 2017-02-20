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
class ReportePresupuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada';
    }

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

        //print_r($pos); exit();
        //verificacion de filtros acciones centrales
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

        //verificando Filtros de materiales o servicios
        if($pos['materiales-servicios']!='x999')
        {
            $materiales=" and f.id=".$pos['materiales-servicios'];
        }

        //verificando Filtros de unidad ejecutora
        if($pos['unidadessejecutoras']!='x999')
        {
            $unidades=" and i.id=".$pos['unidadessejecutoras'];
        }

        //filtro partida
        if(isset($pos['partida']) && $pos['partida']!="")
        {
            $array_partida=explode(",", $pos['partida']);
            $partida=" and (";
            foreach ($array_partida as $key => $value) 
            {
                $partida.= "concat(f.cuenta, f.partida, f.generica, f.especifica, f.subespecifica) like '%".$value."%' || ";
            }
            $partida=substr($partida, 0, -3);
            $partida.=") ";
        }

        //construyendo el query
        $sql="

            select a.cod_proyecto_central, a.nombre_proyecto_central, a.cod_especifica, a.nombre_especifica, a.nombre_unidad_ejecutora, a.partida, a.material, a.unidad_medida, a.presentacion, a.precio, a.iva, a.trim1, a.total_trim1, a.trim2, a.total_trim2, a.trim3, a.total_trim3, a.trim4, a.total_trim4, format(a.total_iva,2, 'de_DE') as total_iva, format(a.total, 2, 'de_DE') as total
            from 
            (
            select a.codigo_accion as cod_proyecto_central, a.nombre_accion as nombre_proyecto_central, b.cod_ac_espe as cod_especifica, b.nombre as nombre_especifica, concat(f.cuenta, f.partida, f.generica, f.especifica, f.subespecifica) partida, f.nombre as material, g.unidad_medida as unidad_medida, h.nombre as presentacion, e.precio,
            e.iva, i.nombre as nombre_unidad_ejecutora,
            (e.enero+e.febrero+e.marzo) as trim1, ((e.enero+e.febrero+e.marzo) * e.precio) as total_trim1, 
            (e.abril+e.mayo+e.junio) as trim2, 
            ((e.abril+e.mayo+e.junio) * e.precio) as total_trim2, 
            (e.julio+e.agosto+e.septiembre) as trim3, 
            ((e.julio+e.agosto+e.septiembre) * e.precio) as total_trim3, 
            (e.octubre+e.noviembre+e.diciembre) as trim4, 
            ((e.octubre+e.noviembre+e.diciembre) * e.precio) as total_trim4,
            round((((e.enero+e.febrero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre+e.diciembre) * e.precio)/e.iva)) as total_iva,
            ((e.enero+e.febrero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre+e.diciembre) * e.precio) + round((((e.enero+e.febrero+e.marzo+e.abril+e.mayo+e.junio+e.julio+e.agosto+e.septiembre+e.octubre+e.noviembre+e.diciembre) * e.precio)/e.iva))  as total
            from accion_centralizada as a
            inner join accion_centralizada_accion_especifica as b on a.id=b.id_ac_centr 
            inner join accion_centralizada_ac_especifica_uej as c  on b.id=c.id_ac_esp 
            inner join accion_centralizada_asignar as d on c.id=d.accion_especifica_ue 
            inner join accion_centralizada_pedido as e on d.id=e.asignado
            inner join materiales_servicios as f on e.id_material=f.id
            inner join unidad_medida as g on f.unidad_medida=g.id
            inner join presentacion as h on  f.presentacion=h.id
            inner join unidad_ejecutora as i on c.id_ue=i.id
            where
            1=1
            ".$accioncentralizada.$accespecifica.$materiales.$unidades.$partida." 


            union all

            SELECT a.codigo_proyecto as cod_proyecto_central, a.nombre as nombre_proyecto_central, b.codigo_accion_especifica as cod_especifica, b.nombre as nombre_especifica, concat(f.cuenta, f.partida, f.generica, f.especifica, f.subespecifica) partida, f.nombre as material, g.unidad_medida as unidad_medida, h.nombre as presentacion, d.precio,
            d.iva, i.nombre as nombre_unidad_ejecutora,
            (d.enero+d.febrero+d.marzo) as trim1, ((d.enero+d.febrero+d.marzo) * d.precio) as total_trim1, 
            (d.abril+d.mayo+d.junio) as trim2, 
            ((d.abril+d.mayo+d.junio) * d.precio) as total_trim2, 
            (d.julio+d.agosto+d.septiembre) as trim3, 
            ((d.julio+d.agosto+d.septiembre) * d.precio) as total_trim3, 
            (d.octubre+d.noviembre+d.diciembre) as trim4, 
            ((d.octubre+d.noviembre+d.diciembre) * d.precio) as total_trim4,
            (((d.enero+d.febrero+d.marzo+d.abril+d.mayo+d.junio+d.julio+d.agosto+d.septiembre+d.octubre+d.noviembre+d.diciembre) * d.precio)/d.iva) as total_iva,
            ((d.enero+d.febrero+d.marzo+d.abril+d.mayo+d.junio+d.julio+d.agosto+d.septiembre+d.octubre+d.noviembre+d.diciembre) * d.precio) + round((((d.enero+d.febrero+d.marzo+d.abril+d.mayo+d.junio+d.julio+d.agosto+d.septiembre+d.octubre+d.noviembre+d.diciembre) * d.precio)/d.iva))  as total
            FROM proyecto as a
            inner join proyecto_accion_especifica as b on a.id=b.id_proyecto
            inner join proyecto_usuario_asignar as c on b.id=c.accion_especifica_id
            inner join proyecto_pedido as d  on c.id=d.asignado
            inner join materiales_servicios as f on d.id_material=f.id
            inner join unidad_medida as g on f.unidad_medida=g.id
            inner join presentacion as h on  f.presentacion=h.id
            inner join unidad_ejecutora as i on b.id_unidad_ejecutora=i.id
            where
            1=1
            ".$proyecto.$proyectoespecifica.$materiales.$unidades.$partida."

            ) as a
            where a.cod_proyecto_central is not null
            
            ";

            
        //print_r($sql); exit();
        //Arreglo para el DataProvider
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        //DataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
        ]);
        return $dataProvider;
    }
}