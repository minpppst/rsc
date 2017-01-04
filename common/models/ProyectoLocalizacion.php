<?php

namespace common\models;

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
    const SCENARIO_REGIONAL = 'Regional';
    const SCENARIO_COMUNAL = 'Comunal';
    const SCENARIO_OTROS = 'Otros';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_localizacion';
    }
    /*
    *Guargar los cambios hechos(auditoria)
    */
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            '' => ['proyecto', 'id_pais'],
            self::SCENARIO_INTERNACIONAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_REGIONAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_COMUNAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_OTROS => ['id_proyecto', 'id_pais'],
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
            [[ 'id_pais'], 'comNacional', 'on' => self::SCENARIO_NACIONAL],
            [[ 'id_pais'], 'comNacional', 'on' => self::SCENARIO_INTERNACIONAL],
            [[ 'id_pais'], 'comNacional', 'on' => self::SCENARIO_REGIONAL],
            [[ 'id_pais'], 'comNacional', 'on' => self::SCENARIO_COMUNAL],
            [[ 'id_estado'], 'comEstado', 'on' => self::SCENARIO_ESTADAL],
            [[ 'id_municipio'], 'comMunicipal', 'on' => self::SCENARIO_MUNICIPAL],
            [[ 'id_parroquia'], 'comParroquial', 'on' => self::SCENARIO_PARROQUIAL],
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_INTERNACIONAL],
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_NACIONAL],
            [['id_proyecto', 'id_pais', 'id_estado'], 'required', 'on' => self::SCENARIO_ESTADAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio'], 'required', 'on' => self::SCENARIO_MUNICIPAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'required', 'on' => self::SCENARIO_PARROQUIAL],
        ];
    }

    /**
     * rules para escenario nacional
     * @param int $idpais
     * @return bool
     */
    function comNacional($idpais)
    {
        
            $existe=ProyectoLocalizacion::find()->where(['id_proyecto' => $this->id_proyecto])->One();
            if($existe!=null)
            {
                $this->addError($idpais, "Error, Ya Se Agregó a Venezuela");
            }
        

    }

    /**
     * rules para escenario estado
     * @param int $estado
     * @return bool
     */
    function comEstado($estado)
    {

        
            $existe=ProyectoLocalizacion::find()->where(['id_proyecto' => $this->id_proyecto])->andWhere(['id_estado' => $this->id_estado])->One();
            if($existe!=null)
            {
                $this->addError($estado, "Error, Ya Se Agregó Este Estado");
            }
        
    }

    /**
     * rules para escenario estado
     * @param int $estado
     * @return bool
     */
    function comMunicipal($municipio)
    {

        if($this->isNewRecord)
        {
            $existe=ProyectoLocalizacion::find()->where(['id_proyecto' => $this->id_proyecto])->andWhere(['id_municipio' => $this->id_municipio])->One();
            if($existe!=null)
            {
                $this->addError($municipio, "Error, Ya Se Agregó Este Municipio");
            }
        }
    }

    /**
     * rules para escenario estado
     * @param int $estado
     * @return bool
     */
    function comParroquial($parroquia)
    {

        
            $existe=ProyectoLocalizacion::find()->where(['id_proyecto' => $this->id_proyecto])->andWhere(['id_parroquia' => $this->id_parroquia])->One();
            if($existe!=null)
            {
                $this->addError($parroquia, "Error, Ya Se Agregó Esta Parroquia");
            }
        
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
     * @return String
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
     * @return String
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
     * @return String
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
     * @return String
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
     * @return String
     */
    public function getNombreProyecto()
    {
        if($this->idProyecto == null)
        {
            return null;
        }

        return $this->idProyecto->nombre;
    }
    /**
    *busca los municipios asociados a un id de estado
    *$estado integer
    *@return array 
    **/
    public function MunicipiosEstados($estado)
    {
        $municipios=Municipio::find()->select(['id', 'nombre as name'])->where(['id_estado' => $estado])->asArray()->all();
        return $municipios;
    }
    /**
    *busca las parroquias asociados a un id de municipio
    *$municipio integer
    *@return array 
    **/
    public function ParroquiasMunicipios($municipio)
    {
        $parroquias=Parroquia::find()->select(['id', 'nombre as name'])->where(['id_municipio' => $municipio])->asArray()->all();
        return $parroquias;
    }

}
