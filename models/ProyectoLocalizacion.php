<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto_localizacion".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property integer $id_pais
 * @property integer $id_estado
 * @property integer $id_municipio
 * @property integer $id_parroquia
 *
 * @property Estados $idEstado
 * @property Municipio $idMunicipio
 * @property Parroquia $idParroquia
 * @property Proyecto $idProyecto
 */
class ProyectoLocalizacion extends \yii\db\ActiveRecord
{

    //Escenarios
    const SCENARIO_INTERNACIONAL = 'Internacional';
    const SCENARIO_NACIONAL = 'Nacional';
    const SCENARIO_ESTADAL = 'Estadal';
    const SCENARIO_MUNICIPAL = 'Municipal';
    const SCENARIO_PARROQUIAL = 'Parroquial';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_localizacion';
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_INTERNACIONAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_NACIONAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_ESTADAL => ['id_proyecto', 'id_pais', 'id_estado'],
            self::SCENARIO_MUNICIPAL => ['id_proyecto', 'id_pais', 'id_estado', 'id_municipio'],
            self::SCENARIO_PARROQUIAL => ['id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'id_pais'], 'required'],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'integer'],
            //Escenarios
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_INTERNACIONAL],
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_NACIONAL],
            [['id_proyecto', 'id_pais', 'id_estado'], 'required', 'on' => self::SCENARIO_ESTADAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio'], 'required', 'on' => self::SCENARIO_MUNICIPAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'required', 'on' => self::SCENARIO_PARROQUIAL],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Proyecto',
            'id_pais' => 'País',
            'id_estado' => 'Estado',
            'id_municipio' => 'Municipio',
            'id_parroquia' => 'Parroquia',
            'nombrePais' => Yii::t('app', 'País'),
            'nombreEstado' => Yii::t('app', 'Estado'),
            'nombreMunicipio' => Yii::t('app', 'Municipio'),
            'nombreParroquia' => Yii::t('app', 'Parroquia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPais()
    {
        return $this->hasOne(Pais::className(), ['id' => 'id_pais']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombrePais()
    {
        return $this->idPais->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estados::className(), ['id' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreEstado()
    {
        if($this->idEstado == null)
        {
            return null;
        }

        return $this->idEstado->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['id' => 'id_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreMunicipio()
    {
        if($this->idMunicipio == null)
        {
            return null;
        }

        return $this->idMunicipio->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreParroquia()
    {
        if($this->idParroquia == null)
        {
            return null;
        }

        return $this->idParroquia->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }

    /**
     * @inheritdoc
     * @return ProyectoLocalizacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProyectoLocalizacionQuery(get_called_class());
    }
}
