<?php

namespace backend\models;
use common\models\Pais;
use common\models\Estados;
use common\models\Municipio;
use common\models\Parroquia;
use Yii;

/**
 * This is the model class for table "proyecto_variable_localizacion".
 *
 * @property integer $id
 * @property integer $id_variable
 * @property integer $id_pais
 * @property integer $id_estado
 * @property integer $id_municipio
 * @property integer $id_parroquia
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * @property ProyectoVariables $idVariable
 * @property ProyectoVariableProgramacion[] $proyectoVariableProgramacions
 */
class ProyectoVariableLocalizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variable_localizacion';
    }

     //Escenarios
    const SCENARIO_INTERNACIONAL = 'Internacional';
    const SCENARIO_REGIONAL = 'Regional';
    const SCENARIO_COMUNAL = 'Comunal';
    const SCENARIO_OTROS = 'Otros';
    const SCENARIO_NACIONAL = 'Nacional';
    const SCENARIO_ESTADAL = 'Estadal';
    const SCENARIO_MUNICIPAL = 'Municipal';
    const SCENARIO_PARROQUIAL = 'Parroquial';

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_INTERNACIONAL => ['id_proyecto_ac', 'id_pais'],
            self::SCENARIO_REGIONAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_COMUNAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_OTROS => ['id_proyecto', 'id_pais'],
            self::SCENARIO_NACIONAL => ['id_proyecto_ac', 'id_pais'],
            self::SCENARIO_ESTADAL => ['id_proyecto_ac', 'id_pais', 'id_estado'],
            self::SCENARIO_MUNICIPAL => ['id_proyecto_ac', 'id_pais', 'id_estado', 'id_municipio'],
            self::SCENARIO_PARROQUIAL => ['id_proyecto_ac', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_variable', 'id_pais'], 'required'],
            [['id_variable', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['id_variable'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariables::className(), 'targetAttribute' => ['id_variable' => 'id']],
            //Escenarios
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_INTERNACIONAL],
            [[ 'id_pais'], 'com_default', 'on' => self::SCENARIO_INTERNACIONAL],
            [[ 'id_pais'], 'com_default', 'on' => self::SCENARIO_NACIONAL],
            [[ 'id_pais'], 'com_default', 'on' => self::SCENARIO_REGIONAL],
            [[ 'id_pais'], 'com_default', 'on' => self::SCENARIO_COMUNAL],
            [[ 'id_pais'], 'com_default', 'on' => self::SCENARIO_OTROS],
            [[ 'id_estado'], 'com_estado', 'on' => self::SCENARIO_ESTADAL],
            [[ 'id_municipio'], 'com_municipio', 'on' => self::SCENARIO_MUNICIPAL],
            [[ 'id_parroquia'], 'com_parroquia', 'on' => self::SCENARIO_PARROQUIAL],
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_NACIONAL],
            [['id_proyecto', 'id_pais', 'id_estado'], 'required', 'on' => self::SCENARIO_ESTADAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio'], 'required', 'on' => self::SCENARIO_MUNICIPAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'required', 'on' => self::SCENARIO_PARROQUIAL],
        ];
    }

    /**
     * rules para escenario nacional
     * @param attribute $idpais
     * @return bool
     */
    function com_default($idpais)
    {
        if($this->isNewRecord)
        {
            //si es venezuela solo debe existir una localización
            $existe=ProyectoVariableLocalizacion::find()->where(['id_variable' => $this->id_variable])->One();
            if($existe!=null)
            {
                $this->addError($idpais, "Error, Ya Se Agregó a Venezuela");
            }
        }

    }

    /**
     * rules para escenario estado
     * @param attribute $estado
     * @return bool
     */
    function com_estado($estado)
    {

        if($this->isNewRecord)
        {
            $existe=ProyectoVariableLocalizacion::find()->where(['id_variable' => $this->id_variable])->andWhere(['id_estado' => $this->id_estado])->One();
        
            if($existe!=null)
            {
                $this->addError($estado, "Error, Ya Se Agregó Este Estado");
            }
        }
    }

    /**
     * rules para escenario municipio
     * @param attribute $municipio
     * @return bool
     */
    function com_municipio($municipio)
    {

        if($this->isNewRecord)
        {
            $existe=ProyectoVariableLocalizacion::find()->where(['id_variable' => $this->id_variable])->andWhere(['id_municipio' => $this->id_municipio])->One();
        
            if($existe!=null)
            {
                $this->addError($municipio, "Error, Ya Se Agregó Este Municipio");
            }
        }
    }

    /**
     * rules para escenario parroquia
     * @param attribute $parroquia
     * @return bool
     */
    function com_parroquia($parroquia)
    {

        if($this->isNewRecord)
        {
            $existe=ProyectoVariableLocalizacion::find()->where(['id_variable' => $this->id_variable])->andWhere(['id_parroquia' => $this->id_parroquia])->One();
        
            if($existe!=null)
            {
                $this->addError($parroquia, "Error, Ya Se Agregó Esta Parroquia");
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_variable' => 'Id Variable',
            'id_pais' => 'Id Pais',
            'id_estado' => 'Id Estado',
            'id_municipio' => 'Id Municipio',
            'id_parroquia' => 'Id Parroquia',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVariable()
    {
        return $this->hasOne(ProyectoVariables::className(), ['id' => 'id_variable']);
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
    public function getIdEstado()
    {
        return $this->hasOne(Estados::className(), ['id' => 'id_estado']);
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
    public function getIdParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoVariableProgramacions()
    {
        return $this->hasMany(ProyectoVariableProgramacion::className(), ['id_localizacion' => 'id']);
    }
}
