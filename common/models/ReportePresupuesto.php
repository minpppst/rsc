<?php

namespace backend\models;

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

    public function reporte1($pos)
    {
        $sql="select a.codigo_accion as cod_proyecto_central, a.nombre_accion as nombre_proyecto_central, b.cod_ac_espe as cod_especifica, b.nombre as nombre_especifica, concat(f.cuenta, f.partida, f.generica, f.especifica, f.subespecifica) partida, f.nombre as material, g.unidad_medida as unidad_medida, h.nombre as presentacion 
            from accion_centralizada as a 
            inner join accion_centralizada_accion_especifica as b on a.id=b.id_ac_centr 
            inner join accion_centralizada_ac_especifica_uej as c  on b.id=c.id_ac_esp 
            inner join accion_centralizada_asignar as d on c.id=d.accion_especifica_ue 
            inner join accion_centralizada_pedido as e on d.id=e.asignado
            inner join materiales_servicios as f on e.id_material=f.id
            inner join unidad_medida as g on f.unidad_medida=g.id
            inner join presentacion as h on  f.presentacion=h.id

            union all


            SELECT a.codigo_proyecto as cod_proyecto_central, a.nombre as nombre_proyecto_central, b.codigo_accion_especifica as cod_especifica, b.nombre as nombre_especifica, concat(f.cuenta, f.partida, f.generica, f.especifica, f.subespecifica) partida, f.nombre as material, g.unidad_medida as unidad_medida, h.nombre as presentacion 
            FROM proyecto as a 
            inner join proyecto_accion_especifica as b on a.id=b.id_proyecto 
            inner join proyecto_usuario_asignar as c on b.id=c.accion_especifica_id
            inner join proyecto_pedido as d  on c.id=d.asignado
            inner join materiales_servicios as f on d.id_material=f.id
            inner join unidad_medida as g on f.unidad_medida=g.id
            inner join presentacion as h on  f.presentacion=h.id";

    }
}