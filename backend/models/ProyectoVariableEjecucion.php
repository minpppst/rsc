<?php

namespace backend\models;
use johnitvn\userplus\base\models\UserAccounts;

use Yii;

/**
 * This is the model class for table "proyecto_variable_ejecucion".
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
 * @property string $fecha_creacion
 *
 * @property ProyectoVariableDesbloqueoMes[] $proyectoVariableDesbloqueoMes
 * @property ProyectoVariableProgramacion $idProgramacion
 * @property UserAccounts $idUsuario
 */
class ProyectoVariableEjecucion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variable_ejecucion';
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
            [['id_programacion', 'id_usuario'], 'required'],
            [['id_programacion', 'id_usuario', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'integer'],
            [['fecha', 'fecha_creacion'], 'safe'],
            [['id_programacion'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariableProgramacion::className(), 'targetAttribute' => ['id_programacion' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoVariableDesbloqueoMes()
    {
        return $this->hasMany(ProyectoVariableDesbloqueoMes::className(), ['id_ejecucion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProgramacion()
    {
        return $this->hasOne(ProyectoVariableProgramacion::className(), ['id' => 'id_programacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'id_usuario']);
    }
}
