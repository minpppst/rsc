<?php

namespace backend\models;
use common\models\AcAcEspec;
use common\models\UnidadEjecutora;
use common\models\UnidadMedida;
use backend\models\LocalizacionAccVariable;
use Yii;

/**
 * This is the model class for table "accion_centralizada_variables".
 *
 * @property integer $id
 * @property string $nombre_variable
 * @property integer $unidad_medida
 * @property integer $localizacion
 * @property string $definicion
 * @property string $base_calculo
 * @property string $fuente_informacion
 * @property integer $meta_programada_variable
 * @property integer $unidad_ejecutora
 * @property integer $acc_accion_especifica
 *
 * @property AccionCentralizadaAcEspecificaUej $accAccionEspecifica
 * @property UnidadEjecutora $unidadEjecutora
 * @property UnidadMedida $unidadMedida
 * @property LocalizacionAccVariable[] $localizacionAccVariables
 */
class AccionCentralizadaVariables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_variables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_variable', 'unidad_medida', 'localizacion', 'definicion', 'base_calculo', 'fuente_informacion', 'unidad_ejecutora', 'acc_accion_especifica'], 'required'],
            [['nombre_variable', 'definicion', 'base_calculo', 'fuente_informacion'], 'string'],
            //[['unidad_medida', 'localizacion', 'responsable', 'meta_programada_variable', 'unidad_ejecutora', 'acc_accion_especifica'], 'integer'],
            [['acc_accion_especifica'], 'exist', 'skipOnError' => true, 'targetClass' => AcAcEspec::className(), 'targetAttribute' => ['acc_accion_especifica' => 'id']],
            [['unidad_ejecutora'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['unidad_ejecutora' => 'id']],
            [['unidad_medida'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadMedida::className(), 'targetAttribute' => ['unidad_medida' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_variable' => 'Nombre Variable',
            'unidad_medida' => 'Unidad Medida',
            'localizacion' => 'Localizacion',
            'definicion' => 'Definicion',
            'base_calculo' => 'Base Calculo',
            'fuente_informacion' => 'Fuente Informacion',
            'meta_programada_variable' => 'Meta Programada Variable',
            'unidad_ejecutora' => 'Unidad Ejecutora',
            'acc_accion_especifica' => 'Accion Especifica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccAccionEspecifica()
    {
        return $this->hasOne(AcAcEspec::className(), ['id' => 'acc_accion_especifica']);
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'unidad_ejecutora']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'unidad_medida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizacionAccVariables()
    {
        return $this->hasMany(LocalizacionAccVariable::className(), ['id_variable' => 'id']);
    }


    public function getResponsable()
    {
        return $this->hasOne(ResponsableAccVariable::className(), ['id_variable' => 'id']);
    }


    public function getLocal_variable(){

        $resultado=LocalizacionAccVariable::find()->andWhere('id_variable='.$this->id)->one();
        if($resultado!=null){
            return true;
        }
        else{
            return false;
        }

    }
public function getLocal_variable_estados(){
            
            $count = LocalizacionAccVariable::find()->where("id_variable=".$this->id)->count();
            
            if($count<=24)
             return false;
            else
              return true;

                        }
}
