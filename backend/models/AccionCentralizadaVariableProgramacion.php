<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "accion_centralizada_variable_programacion".
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
 *
 * @property LocalizacionAccVariable $idLocalizacion
 */
class AccionCentralizadaVariableProgramacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_variable_programacion';
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
            //[['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'number'],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'numero_ingresado'],
            [['id_localizacion'], 'exist', 'skipOnError' => true, 'targetClass' => LocalizacionAccVariable::className(), 'targetAttribute' => ['id_localizacion' => 'id']],
        ];
    }


    public function numero_ingresado($attribute){

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
            'trimestre1' => 'Trimestre I',
            'trimestre2' => 'Trimestre II',
            'trimestre3' => 'Trimestre III',
            'trimestre4' => 'Trimestre IV',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLocalizacion()
    {
        return $this->hasOne(LocalizacionAccVariable::className(), ['id' => 'id_localizacion']);
    }


    public function getTrimestre1()
    {
        return ($this->enero+$this->febrero+$this->marzo);
    }

    /**
     * @return string
     */
    public function getTrimestre2()
    {
        return ($this->abril+$this->mayo+$this->junio);
    }

    /**
     * @return string
     */
    public function getTrimestre3()
    {
        return ($this->julio+$this->agosto+$this->septiembre);
    }

    /**
     * @return string
     */
    public function getTrimestre4()
    {
        return ($this->octubre+$this->noviembre+$this->diciembre);
    }

    /**
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
