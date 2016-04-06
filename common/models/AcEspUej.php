<?php

namespace common\models;

use Yii;
use common\models\AcAcEspec;
/**
 * This is the model class for table "accion_centralizada_ac_especifica_uej".
 *
 * @property integer $id
 * @property integer $id_ue
 * @property integer $id_ac_esp
 *
 * @property AcEspUej $idAcEsp
 * @property AcEspUej[] $acEspUejs
 * @property UnidadEjecutora $idUe
 */
class AcEspUej extends \yii\db\ActiveRecord
{
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

    public function nombre_accion($accion){
         $especifica = AcAcEspec::find()->where(['id'=>$accion])->one();

         
         return $especifica->nombre;
    }


    public function getnombreunidadejecutora(){
        
        if($this->idUe == null)
        {
            return null;
        }

        return $this->idUe->nombre;//idAcCentr->nombre_accion;
    } 


public function getnombreaccion(){
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->nombre;
    }

    public function getnombrecentral(){
        
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->idAcCentr->nombre_accion;//idAcCentr->nombre_accion;
    }

    public function getCodigocentral(){
        
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->idAcCentr->codigo_accion;//idAcCentr->nombre_accion;
    }






}
