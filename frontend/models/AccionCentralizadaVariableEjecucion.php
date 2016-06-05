<?php

namespace app\models;

use Yii;
use johnitvn\userplus\base\models\UserAccounts;
use backend\models\AccionCentralizadaVariableProgramacion;

/**
 * This is the model class for table "accion_centralizada_variable_ejecucion".
 *
 * @property integer $id
 * @property integer $id_programacion
 * @property integer $id_usuario
 * @property string $fecha
 * @property integer $enero
 * @property integer $febrero
 * @property integer $marzo
 * @property integer $abril
 * @property integer $mayo
 * @property integer $junio
 * @property integer $julio
 * @property integer $agosto
 * @property integer $septiembre
 * @property integer $octubre
 * @property integer $noviembre
 * @property integer $diciembre
 *
 * @property AccionCentralizadaDesbloqueoMes[] $accionCentralizadaDesbloqueoMes
 * @property UserAccounts $idUsuario
 * @property AccionCentralizadaVariableProgramacion $idProgramacion
 */
class AccionCentralizadaVariableEjecucion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_variable_ejecucion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_programacion', 'id_usuario', 'fecha', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'required'],
            [['id_programacion', 'id_usuario', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'integer'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_programacion'], 'exist', 'skipOnError' => true, 'targetClass' => AccionCentralizadaVariableProgramacion::className(), 'targetAttribute' => ['id_programacion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_programacion' => 'Id Programacion',
            'id_usuario' => 'Id Usuario',
            'fecha' => 'Fecha',
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionCentralizadaDesbloqueoMes()
    {
        return $this->hasMany(AccionCentralizadaDesbloqueoMes::className(), ['id_ejecucion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProgramacion()
    {
        return $this->hasOne(AccionCentralizadaVariableProgramacion::className(), ['id' => 'id_programacion']);
    }
}
