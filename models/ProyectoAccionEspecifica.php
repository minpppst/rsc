<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "proyecto_accion_especifica".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $codigo_accion_especifica
 * @property string $nombre
 * @property integer $id_unidad_ejecutora
 *
 * @property ProgramacionFisicaPresupuestaria[] $programacionFisicaPresupuestarias
 * @property Proyecto $idProyecto
 * @property UnidadEjecutora $idUnidadEjecutora
 */
class ProyectoAccionEspecifica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_accion_especifica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'codigo_accion_especifica', 'id_unidad_ejecutora'], 'required'],
            [['id_proyecto', 'id_unidad_ejecutora'], 'integer'],
            [['nombre'], 'string'],
            [['codigo_accion_especifica'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Id Proyecto',
            'codigo_accion_especifica' => 'Codigo Accion Especifica',
            'nombre' => 'Nombre',
            'id_unidad_ejecutora' => 'Unidad Ejecutora',
            'nombreUnidadEjecutora' => 'Unidad Ejecutora',
        ];
    }

    /**
     * Guardar en la tabla proyecto_distribucion_presupuestaria
     * @return \yii\db\ActiveQuery
     */
    public function afterSave($insert,$changedAttributes) 
    {
        $partidas = Partida::find()->all();

        if (!$insert) {
            //nada
        }
        else{
            foreach($partidas as $key => $value)
            {
                $distribucion = new ProyectoDistribucionPresupuestaria();
                $distribucion->id_accion_especifica = $this->id;
                $distribucion->id_partida = $value->id;
                $distribucion->cantidad = 0;
                $distribucion->save(false);
            }
        }

        return parent::afterSave($insert,$changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramacionFisicaPresupuestarias()
    {
        return $this->hasMany(ProgramacionFisicaPresupuestaria::className(), ['id_proyecto_accion_especifica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidadEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_unidad_ejecutora']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreUnidadEjecutora()
    {
        if($this->idUnidadEjecutora == null)
        {
            return null;
        }

        return $this->idUnidadEjecutora->nombre;
    }

    /**
    * @inheritdoc
    * @return ProyectoAccionEspecificaQuery the active query used by this AR class.
    */
   public static function find()
   {
       return new ProyectoAccionEspecificaQuery(get_called_class());
   }
}
