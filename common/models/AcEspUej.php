<?php

namespace common\models;

use Yii;
use common\models\AcAcEspec;
use common\components\Notification as Notificaciones;
use yii\db\Expression;
/**
 * This is the model class for table "accion_centralizada_ac_especifica_uej".
 *
 * @property integer $id
 * @property integer $id_ue
 * @property integer $id_ac_esp
 * @property integer $estatus
 * @property integer $aprobado
 *
 * @property AcEspUej $idAcEsp
 * @property AcEspUej[] $acEspUejs
 * @property UnidadEjecutora $idUe
 */
class AcEspUej extends \yii\db\ActiveRecord
{

    const EVENT_ACPEDIDOAPROBADO = 'ACAprobacionPedido';
    const EVENT_ACPEDIDODESAPROBADO = 'ACDesaprobacionPedido';

    
    
    public function init()
    {

        $this->on(self::EVENT_ACPEDIDOAPROBADO, [$this, 'notificacionAprobacion']);
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_ac_especifica_uej';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ue', 'id_ac_esp'], 'required'],
            [['id_ue', 'id_ac_esp'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ue' => 'Unidad Ejecutora',
            'id_ac_esp' => 'Accion Especifica',
            'estatus' => 'Estatus',
            'aprobado' => 'Aprobado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcEsp()
    {
        return $this->hasOne(AcAcEspec::className(), ['id' => 'id_ac_esp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcEspUejs()
    {
        return $this->hasMany(AcEspUej::className(), ['id_ac_esp' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUe()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_ue']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getIdAccionEspecifica()
    {
        return $this->hasOne(AcAcEspec::className(), ['id' => 'id_ac_esp']);
    }

    /*
    *Obtener el codigo de unidad ejecutora
    *return string
    */
    public function getnombreunidadejecutora()
    {
        
        if($this->idUe == null)
        {
            return null;
        }

        return $this->idUe->nombre;//idAcCentr->nombre_accion;
    } 


    /*
    *Obtener el codigo de accion central especifica
    *return string
    */
    public function getnombreaccion()
    {
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->nombre;
    }

    /*
    *Obtener el nombre de accion central
    *return string
    */
    public function getnombrecentral(){
        
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->idAcCentr->nombre_accion;//idAcCentr->nombre_accion;
    }

    
    /*
    *Obtener el codigo de accion central
    *return string
    */
    public function getCodigocentral()
    {
        
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->idAcCentr->codigo_accion;
    }


    /*
    *verificar si ya cargaron algo en el pedido
    *return boolean
    */
    public function getPedidoEjecutado()
    {
        //buscar si la asignacion ya fue ejecutada
        $asignacion=AccionCentralizadaAsignar::find()
            ->select(['accion_centralizada_pedido.id'])
            ->innerjoin('accion_centralizada_pedido', 'accion_centralizada_pedido.asignado=accion_centralizada_asignar.id')
            ->where(['accion_centralizada_asignar.accion_especifica_ue' => $this->id])
            ->One();

            if($asignacion!=NULL)
            {
                return 1;
            }
            else
            {
                return 0;
            }
    }


     
    /*
    *Aprobar o Desaprobar Requerimientos
    *return booleam
    */
    public function toggleAprobar()
    {
        if($this->aprobado == 1)
        {
            $this->aprobado = 0;
        }
        else
        {
            $this->aprobado = 1;
        }
        
        if($this->save())
        {
            $this->trigger(AcEspUej::EVENT_ACPEDIDOAPROBADO);
            return true;
        }
        else
        {
            return false; 
        }
    }

    /* Eliminar unidad Ejecutora asociada a accion especica
    *@integer id
    *return booleam
    */
    public  function uej_eliminar($id)
    {
        $model = AcEspUej::findOne($id);
        $model->estatus=2;
        return $model->save();
    }



     /* Unidades ejecutoras relaciones 
     *@integer $id
     *@return array
     */
     public function obtener_uej_relacionadas($id)
     {
        $ue="";
        $uej=AcEspUej::find()
        ->select(['unidad_ejecutora.nombre as name'])
        ->innerjoin('unidad_ejecutora', 'accion_centralizada_ac_especifica_uej.id_ue=unidad_ejecutora.id')
        ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $id])
        ->andwhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
        ->asArray()
        ->all();
        foreach ($uej as $key => $value) {
        $ue.=$value['name'].", ";
        }
        $ue = substr($ue, 0, -2);
        return $ue;
    }


     /**
     *Carga De las notificaciones pueden darse dos casos aprobados y desaprobados.
     */
    public function notificacionAprobacion($evento)
    {
        
        if($this->aprobado==1)
        {
            //Ids de los usuarios con el rol "proyecto_pedido"
            $usuarios =AcEspUej::find()
            ->select(["accion_centralizada_asignar.usuario"])
            ->innerjoin('accion_centralizada_asignar', 'accion_centralizada_ac_especifica_uej.id=accion_centralizada_asignar.accion_especifica_ue')
            ->where(['accion_centralizada_asignar.accion_especifica_ue' => $this->id])
            ->andWhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
            ->asArray()
            ->all();
            $bandera=0;
            foreach ($usuarios as $key => $value) 
            {
                //verificar si quien aprueba/desaprueba esta asociado al proyecto
                if($value['usuario']==\Yii::$app->user->id)
                {
                    $bandera=1;
                }
                // usuarios pertenecientes a esa unidad ejecutora
                Notificaciones::notify(Notificaciones::KEY_ACPEDIDOAPROBADO, $value['usuario'], $this->id);
            }
            
            if($bandera==0)
            {
                //enviar a quien lo hace, pues no necesariamente este asociada al proyecto
                Notificaciones::notify(Notificaciones::KEY_ACPEDIDOAPROBADO, \Yii::$app->user->id, $this->id);
            }
            /**
            /*NOTA
            /*puede darse el caso que existan usuarios del backend que no este asociados, pero igual por su rol 
            /*deben llegarle las notificaciones, una vez definidos estos roles se les debe enviar las notificaciones.
            */
            
        }
        else
        {
            $usuarios =AcEspUej::find()
            ->select(["accion_centralizada_asignar.usuario"])
            ->innerjoin('accion_centralizada_asignar', 'accion_centralizada_ac_especifica_uej.id=accion_centralizada_asignar.accion_especifica_ue')
            ->where(['accion_centralizada_asignar.accion_especifica_ue' => $this->id])
            ->andWhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
            ->asArray()
            ->all();
            $bandera=0;
            foreach ($usuarios as $key => $value) 
            {
                //verificar si quien aprueba/desaprueba esta asociado al proyecto
                if($value['usuario']==\Yii::$app->user->id)
                {
                    $bandera=1;
                }
                // usuarios pertenecientes a esa unidad ejecutora
                Notificaciones::notify(Notificaciones::KEY_ACPEDIDODESAPROBADO, $value['usuario'], $this->id); 
            }
            if($bandera==0)
            {
                //enviar a quien lo hace, pues no necesariamente este asociada al proyecto
                Notificaciones::notify(Notificaciones::KEY_ACPEDIDOAPROBADO, \Yii::$app->user->id, $this->id);
            }
            /**
            /*NOTA
            /*puede darse el caso que existan usuarios del backend que no este asociados, pero igual por su rol 
            /*deben llegarle las notificaciones, una vez definidos estos roles se les debe enviar las notificaciones.
            */

        }
    }

    /*
    *Ejemplo de la eliminacion falsa, donde solo se guarda fecha de eliminacion y no se borra el modelo
    */
    public function cambiar()
    {
        $this->fecha_eliminacion=new Expression('NOW()');
        $this->save();
    }





}
