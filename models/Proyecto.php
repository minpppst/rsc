<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property integer $id
 * @property string $codigo_proyecto
 * @property string $codigo_sne
 * @property string $nombre
 * @property integer $estatus_proyecto
 * @property integer $situacion_presupuestaria
 * @property string $monto_proyecto
 * @property string $descripcion
 * @property integer $sector
 * @property integer $sub_sector
 * @property integer $plan_operativo
 * @property integer $objetivo_general
 * @property string $objetivo_estrategico_institucional
 * @property integer $ambito
 *
 * @property AccionEspecificaProyecto[] $accionEspecificaProyectos
 * @property Localizacion[] $localizacions
 * @property ResponsableAdministrativo[] $responsableAdministrativos
 * @property ResponsableProyecto[] $responsableProyectos
 * @property ResponsableTecnico[] $responsableTecnicos
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'estatus_proyecto', 'situacion_presupuestaria', 'plan_operativo', 'objetivo_general', 'objetivo_estrategico_institucional', 'ambito', 'estatus'], 'required'],
            [['estatus_proyecto', 'situacion_presupuestaria', 'sector', 'sub_sector', 'plan_operativo', 'objetivo_general', 'ambito', 'estatus'], 'integer'],
            [['monto_proyecto'], 'number'],
            [['descripcion', 'objetivo_estrategico_institucional'], 'string'],
            [['codigo_proyecto', 'codigo_sne', 'nombre'], 'string', 'max' => 45],
            [['codigo_proyecto'], 'unique'],
            [['codigo_sne'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_proyecto' => 'Código Proyecto',
            'codigo_sne' => 'Código SNE',
            'nombre' => 'Nombre',
            'estatus_proyecto' => 'Estatus',
            'situacion_presupuestaria' => 'Situación Presupuestaria',
            'monto_proyecto' => 'Monto Proyecto',
            'descripcion' => 'Descripción',
            'sector' => 'Sector',
            'sub_sector' => 'Sub Sector',
            'plan_operativo' => 'Plan Operativo',
            'objetivo_general' => 'Objetivo General',
            'objetivo_estrategico_institucional' => 'Objetivo Estrategico Institucional',
            'ambito' => 'Ambito',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionEspecificaProyectos()
    {
        return $this->hasMany(AccionEspecificaProyecto::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizacions()
    {
        return $this->hasMany(Localizacion::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableAdministrativos()
    {
        return $this->hasMany(ResponsableAdministrativo::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableProyectos()
    {
        return $this->hasMany(ResponsableProyecto::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableTecnicos()
    {
        return $this->hasMany(ResponsableTecnico::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAmbito()
    {
        return $this->hasOne(Ambito::className(), ['id' => 'ambito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreAmbito()
    {
        return $this->idAmbito->ambito;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus()
    {
        return $this->hasOne(EstatusProyecto::className(), ['id' => 'estatus_proyecto']);
    }

    /**
     * @return string
     */
    public function getNombreEstatus()
    {
        if($this->estatus == 1)
        {
            return "Activo";
        }

        return "Inactivo";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrador()
    {
        return $this->hasOne(ProyectoRegistrador::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable()
    {
        return $this->hasOne(ProyectoResponsable::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableAdministrativo()
    {
        return $this->hasOne(ProyectoResponsableAdministrativo::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableTecnico()
    {
        return $this->hasOne(ProyectoResponsableTecnico::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlcance()
    {
        return $this->hasOne(ProyectoAlcance::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionesEspecificas()
    {
        return $this->hasMany(ProyectoAccionEspecifica::className(), ['id_proyecto' => 'id']);
    }

    /**
     * Colocar estatus en 0 "Inactivo"
     */
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
