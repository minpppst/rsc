<?php

namespace backend\models;

use Yii;

use common\models\AccionCentralizada;
use common\models\UnidadEjecutora;
/**
 * This is the model class for table "accion_centralizada_accion_especifica".
 *
 * @property integer $id
 * @property integer $id_ac_centr
 * @property string $cod_ac_espe
 * @property string $nombre
 * @property string $estatus
 *
 * @property AccionCentralizada $idAcCentr
 * @property AcVariable[] $acVariables
 */
class AcAcEspec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_accion_especifica';
    }

    /*
    *Guargar los cambios hechos(auditoria)
    */
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             
            [['id_ac_centr', 'cod_ac_espe', 'nombre', 'estatus'], 'required'],
            [['id_ac_centr'], 'integer'],
            [['cod_ac_espe'], 'unique'],
            [['nombre'], 'string'],
            [['cod_ac_espe'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ac_centr' => 'Id Accion Centralizada',
            'cod_ac_espe' => 'Cod. Accion Especifica',
            'nombre' => 'Nombre Accion Especifica',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcCentr()
    {
        return $this->hasOne(AccionCentralizada::className(), ['id' => 'id_ac_centr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVariables()
    {
        return $this->hasMany(AcVariable::className(), ['id_ac_esp' => 'id']);
    }

    /**
     * Verificar si tiene unidad ejecutora asociada
     * @return bool
     */
    public function existe_uej()
    {
        $resultado =ArrayHelper::map(AcEspUej::find()->limit(1)->where('id_ac_esp= :id', ['id'=>$this->id])->all(),'id','id_ue');
        if(count($resultado)>0)
        {
        return(1);
        }
        else
        {
        return(0);
        }
    }

    /**
     * Mostrar el codigo de la accion centraliada
     * @return string
     */
     public function getCodigoAccionCentralizada()
    {
        if($this->idAcCentr == null)
        {
            return null;
        }

        return $this->idAcCentr->codigo_accion;
    }

    /**
     * mostrar nombre de la accion centralizada
     * @return string
    */
    public function getNombreaccioncentralizada()
     {
        if($this->idAcCentr == null)
        {
            return null;
        }

        return $this->idAcCentr->nombre_accion;
    }

    /**
     * mostrar nombre del estatus
     * @return string
     */
    public   function getnombreEstatus()
    {
        return ($this->estatus == 1)? 'Activo':'Inactivo';
    }

    /**
     * Colocar estatus en 0 "Desactivo"
     * @return mixed
     */
    public function desactivar()
    {
        $this->estatus = 0;
        $this->save();
    }

     /**
     * Colocar estatus en 1 "Activo"
     * @return mixed
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save();
     }

     /**
      * Activar o desactivar
      * @return bool
      */
     public function toggleActivo()
     {
        if($this->estatus == 1)
        {
            $this->desactivar();
        }
        else
        {
            $this->activar();
        }

        return true;
     }
}
