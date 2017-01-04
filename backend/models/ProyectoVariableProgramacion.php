<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proyecto_variable_programacion".
 *
 * @property integer $id
 * @property integer $id_localizacion
 * @property string $enero
 * @property string $febrero
 * @property string $marzo
 * @property string $abril
 * @property string $mayo
 * @property string $junio
 * @property string $julio
 * @property string $agosto
 * @property string $septiembre
 * @property string $octubre
 * @property string $noviembre
 * @property string $diciembre
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 * @property string $fecha_eliminacion
 *
 * @property ProyectoVariableEjecucion[] $proyectoVariableEjecucions
 * @property ProyectoVariableLocalizacion $idLocalizacion
 */
class ProyectoVariableProgramacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variable_programacion';
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
    public function rules()
    {
        return [
            [['id_localizacion'], 'integer'],
             [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],  'default', 'value' => '0'],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'integer', 'min' => 0],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'numero_ingresado'],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'number'],
            [['fecha_creacion', 'fecha_modificacion', 'fecha_eliminacion'], 'safe'],
            [['id_localizacion'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariableLocalizacion::className(), 'targetAttribute' => ['id_localizacion' => 'id']],
        ];
    }

    /**
    *regla se debe colocar una cantidad mayor a 0 en algun mes, no pueden quedar todos los meses vacios
    *
    */
    public function numero_ingresado($attribute)
    {

        if($this->enero<=0 && $this->febrero<=0 && $this->marzo<=0 && $this->abril<=0 && $this->mayo<=0 && $this->junio<=0 && $this->julio<=0 && $this->agosto<=0 && $this->septiembre<=0 && $this->octubre<=0 && $this->noviembre<=0 && $this->diciembre<=0 )
             $this->addError($attribute, 'Error, Necesita Cargar Al Menos Una Cantidad Positiva En Uno De Los Meses');

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_localizacion' => 'Id Localizacion',
            'enero' => 'Enero',
            'febrero' => 'Febrero',
            'marzo' => 'Marzo',
            'abril' => 'Abril',
            'mayo' => 'Mayo',
            'junio' => 'Junio',
            'julio' => 'Julio',
            'agosto' => 'Agosto',
            'septiembre' => 'Septiembre',
            'octubre' => 'Octubre',
            'noviembre' => 'Noviembre',
            'diciembre' => 'Diciembre',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
            'fecha_eliminacion' => 'Fecha Eliminacion',
            'trimestre1' => 'Trimestre I',
            'trimestre2' => 'Trimestre II',
            'trimestre3' => 'Trimestre III',
            'trimestre4' => 'Trimestre IV',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoVariableEjecucions()
    {
        return $this->hasMany(ProyectoVariableEjecucion::className(), ['id_programacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLocalizacion()
    {
        return $this->hasOne(ProyectoVariableLocalizacion::className(), ['id' => 'id_localizacion']);
    }

    /** retorna la suma del trimestre uno
     * @return string
     */
    public function getTrimestre1()
    {
        return ($this->enero+$this->febrero+$this->marzo);
    }

    /** retorna la suma del trimestre dos
     * @return string
     */
    public function getTrimestre2()
    {
        return ($this->abril+$this->mayo+$this->junio);
    }

    /** retorna la suma del trimestre tres
     * @return string
     */
    public function getTrimestre3()
    {
        return ($this->julio+$this->agosto+$this->septiembre);
    }

    /** retorna la suma del trimestre cuatro
     * @return string
     */
    public function getTrimestre4()
    {
        return ($this->octubre+$this->noviembre+$this->diciembre);
    }

    /** retorna la suma del total de los trimestres
     * @return integer
     */
    public function getTotalTrimestre()
    {
        return (
            $this->trimestre1 +
            $this->trimestre2 +
            $this->trimestre3 +
            $this->trimestre4
        );
    }
}
