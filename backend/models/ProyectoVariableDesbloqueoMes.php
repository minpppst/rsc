<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proyecto_variable_desbloqueo_mes".
 *
 * @property integer $id
 * @property integer $id_ejecucion
 * @property integer $mes
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * @property ProyectoVariableEjecucion $idEjecucion
 */
class ProyectoVariableDesbloqueoMes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variable_desbloqueo_mes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ejecucion', 'mes'], 'required'],
            [['id_ejecucion', 'mes'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [[ 'mes'], 'com_mes',],
            [['id_ejecucion'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariableEjecucion::className(), 'targetAttribute' => ['id_ejecucion' => 'id']],
        ];
    }

    /**
     * rules para validar si el mes fue agrgado
     * @param int $mes
     */
    function com_mes($mes)
    {
        $existe=ProyectoVariableDesbloqueoMes::find()->where(['id_ejecucion' => $this->id_ejecucion])->andWhere(['mes' => $this->mes])->One();
        if($existe!=null)
        {
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
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEjecucion()
    {
        return $this->hasOne(ProyectoVariableEjecucion::className(), ['id' => 'id_ejecucion']);
    }

    /**
     * Mostrar el nombre de los meses
     * @return string
     */
    public function getObtenerMes()
    {
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

    /**
    *
    */
    public function getMeses()
    {
        return 
        [
            '1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio',
            '7' => 'Julio', '8' => 'Agosto', '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];
    }
}
