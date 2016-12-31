<?php

namespace backend\models;

use Yii;
use common\models\Pais;
use common\models\Estados;
use common\models\Municipio;
use common\models\Parroquia;
use common\models\AccionCentralizadaVariableProgramacion;

/**
 * This is the model class for table "localizacion_acc_variable".
 *
 * @property integer $id
 * @property integer $id_variable
 * @property integer $id_pais
 * @property integer $id_estado
 * @property integer $id_municipio
 * @property integer $id_parroquia
 *
 * @property Estados $idEstado
 * @property AccionCentralizadaVariables $idVariable
 * @property Municipio $idMunicipio
 * @property Pais $idPais
 * @property Parroquia $idParroquia
 */
class LocalizacionAccVariable extends \yii\db\ActiveRecord
{


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
    public static function tableName()
    {
        return 'localizacion_acc_variable';
    }


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
            [['id_variable', 'id_pais'], 'integer'],

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
            $existe=LocalizacionAccVariable::find()->where(['id_variable' => $this->id_variable])->One();
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
            $existe=LocalizacionAccVariable::find()->where(['id_variable' => $this->id_variable])->andWhere(['id_estado' => $this->id_estado])->One();
        
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
            $existe=LocalizacionAccVariable::find()->where(['id_variable' => $this->id_variable])->andWhere(['id_municipio' => $this->id_municipio])->One();
        
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
            $existe=LocalizacionAccVariable::find()->where(['id_variable' => $this->id_variable])->andWhere(['id_parroquia' => $this->id_parroquia])->One();
        
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
            'nombrePais' => 'Pais',
            'nombreVariable' => 'Nombre Variable',
            'nombreEstado' => 'Estado'
        ];
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
    public function getIdVariable()
    {
        return $this->hasOne(AccionCentralizadaVariables::className(), ['id' => 'id_variable']);
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
    public function getIdPais()
    {
        return $this->hasOne(Pais::className(), ['id' => 'id_pais']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id' => 'id_parroquia']);
    }


    /**
     * mostrasr nombre de la variable
     * @return string
     */
    public function getNombreVariable()
    {
        return $this->idVariable->nombre_variable;
    }

    /**
     * mostrasr nombre del pais
     * @return string
     */
     public function getNombrePais()
    {
        return $this->idPais->nombre;
    }

    /**
     * mostrasr nombre del estado
     * @return string
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
     * mostrasr nombre del estado
     * @return string
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
     * mostrasr nombre del estado
     * @return string
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
     * mostrar si ya existe una ejecucion
     * @return bool
     */
    public function getObtener_Ejecucion(){
    
    $programacion_ejecucion=AccionCentralizadaVariableProgramacion::find()
    ->innerjoin('accion_centralizada_variable_ejecucion','accion_centralizada_variable_programacion.id=accion_centralizada_variable_ejecucion.id_programacion')
    ->where(['accion_centralizada_variable_programacion.id_localizacion' => $this->id])->one();

    if($programacion_ejecucion==NULL){
        return false;
    }else{
        return true;
    }
        

    }












}
