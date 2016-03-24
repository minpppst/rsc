<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             //[['cod_ac_espe'],'unique'],
            [['id_ac_centr', 'cod_ac_espe', 'nombre', 'estatus'], 'required'],
            [['id_ac_centr'], 'integer'],
            [['cod_ac_espe'], 'unique'],
            [['nombre'], 'string'],
            [['cod_ac_espe'], 'string', 'max' => 3]
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

    public function existe_uej(){
        //$resultado=AcEspUej::find()->select('id')->where('=','id_ac_esp',$this->id);
        $resultado =ArrayHelper::map(AcEspUej::find()->limit(1)->where('id_ac_esp= :id', ['id'=>$this->id])->all(),'id','id_ue');
        if(count($resultado)>0){
        return(1);}
    else{
        return(0);
    }
    }


    public   function getnombreEstatus(){
                              return ($this->estatus == 1)? 'Activo':'Inactivo';
                      }


    public function desactivar()
    {
        $this->estatus = 0;
        $this->save();
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save();
     }

     /**
      * Activar o desactivar
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
