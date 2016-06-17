<?php

namespace backend\models;
use frontend\models\AccionCentralizadaVariableEjecucion;
use Yii;

/**
 * This is the model class for table "accion_centralizada_desbloqueo_mes".
 *
 * @property integer $id
 * @property integer $id_ejecucion
 * @property integer $mes
 *
 * @property AccionCentralizadaVariableEjecucion $idEjecucion
 */
class AccionCentralizadaDesbloqueoMes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_desbloqueo_mes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ejecucion', 'mes'], 'required'],
            [['id_ejecucion', 'mes'], 'integer'],
            [[ 'mes'], 'com_mes',],
            [['id_ejecucion'], 'exist', 'skipOnError' => true, 'targetClass' => AccionCentralizadaVariableEjecucion::className(), 'targetAttribute' => ['id_ejecucion' => 'id']],
        ];
    }



    function com_mes($mes){

    
    $existe=AccionCentralizadaDesbloqueoMes::find()->where(['id_ejecucion' => $this->id_ejecucion])->andWhere(['mes' => $this->mes])->One();
 
    
    if($existe!=null){
    $this->addError($mes, "Error, Ya Se Agregó Este Mes");
    }
    

    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ejecucion' => 'Id Ejecucion',
            'mes' => 'Mes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEjecucion()
    {
        return $this->hasOne(AccionCentralizadaVariableEjecucion::className(), ['id' => 'id_ejecucion']);
    }

    public function getObtenerEstado(){
        return $nombre=$this->idEjecucion->idProgramacion->idLocalizacion->NombreEstado;

    }

    public function getObtenerMes(){
        
            if($this->mes==1)
            return 'Enero';
            if($this->mes==2)
            return 'Febrero';
            if($this->mes==3)
            return 'Marzo';
            if($this->mes==4)
            return 'Abril';
            if($this->mes==5)
            return 'Mayo';
            if($this->mes==6)
            return 'Junio';
            if($this->mes==7)
            return 'Julio';
            if($this->mes==8)
            return 'Agosto';
            if($this->mes==9)
            return 'Septiembre';
            if($this->mes==10)
            return 'Octubre';
            if($this->mes==11)
            return 'Noviembre';
            if($this->mes==12)
            return 'Diciembre';


    }
}
