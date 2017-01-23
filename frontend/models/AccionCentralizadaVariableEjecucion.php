<?php

namespace frontend\models;
use Yii;
use johnitvn\userplus\base\models\UserAccounts;
use common\models\AccionCentralizadaVariableProgramacion;
use backend\models\AccionCentralizadaVariables;
use backend\models\LocalizacionAccVariable;
use yii\data\ArrayDataProvider;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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
 * @property string $observacion_enero
 * @property string $observacion_febrero
 * @property string $observacion_marzo
 * @property string $observacion_abril
 * @property string $observacion_mayo
 * @property string $observacion_junio
 * @property string $observacion_julio'
 * @property string $observacion_agosto
 * @property string $observacion_septiembre
 * @property string $observacion_octubre
 * @property string $observacion_noviembre
 * @property string $observacion_diciembre
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
            //[['id_programacion', 'id_usuario', 'fecha', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'required'],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'numero_ingresado'],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'validar_vacio'],
            [['id_programacion', 'id_usuario', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'integer'],

            
            [['fecha', 'observacion_enero', 'observacion_febrero', 'observacion_marzo', 'observacion_abril', 'observacion_mayo', 'observacion_junio', 'observacion_julio', 'observacion_agosto', 'observacion_septiembre', 'observacion_octubre', 'observacion_noviembre', 'observacion_diciembre'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_programacion'], 'exist', 'skipOnError' => true, 'targetClass' => AccionCentralizadaVariableProgramacion::className(), 'targetAttribute' => ['id_programacion' => 'id']],
        ];
    }

    public function numero_ingresado($attribute){

        if(($this->enero<=0 && $this->febrero<=0 && $this->marzo<=0 && $this->abril<=0 && $this->mayo<=0 && $this->junio<=0 && $this->julio<=0 && $this->agosto<=0 && $this->septiembre<=0 && $this->octubre<=0 && $this->noviembre<=0 && $this->diciembre<=0))
        $this->addError($attribute, 'Error, Necesita Cargar Una Cantidad Positiva');

        
    }

    public function validar_vacio($attribute){

    if(empty($this->enero) && $this->febrero==NULL && $this->marzo==NULL && $this->abril==NULL && $this->mayo==NULL && $this->junio==NULL && $this->julio==NULL && $this->agosto==NULL && $this->septiembre==NULL && $this->octubre==NULL && $this->noviembre==NULL && $this->diciembre==NULL)
        $this->addError($attribute, 'Error, Necesita Cargar Una Cantidad Positiva');
        
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
            'observacion_enero' => 'Observación Enero',
            'observacion_febrero' => 'Observación Febrero',
            'observacion_marzo' => 'Observación Marzo',
            'observacion_abril' => 'Observación Abril',
            'observacion_mayo' => 'Observación Mayo',
            'observacion_junio' => 'Observación Junio',
            'observacion_julio' => 'Observación Julio',
            'observacion_agosto' => 'Observación Agosto',
            'observacion_septiembre' => 'Observación Septiembre',
            'observacion_octubre' => 'Observación Octubre',
            'observacion_noviembre' => 'Observación Noviembre',
            'observacion_diciembre' => 'Observación Diciembre'
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

    /*
    * retorna las variables que han sido asignadas al usuario activo
    * @return $arrayprovider
    */
    public function VariablesAsignadas()
    {
        $ace = AccionCentralizadaVariables::find()
                ->select(["accion_centralizada_variables.nombre_variable as nombre", "accion_centralizada_variables.id", "accion_centralizada_variables.localizacion as localizacion", "localizacion_acc_variable.id id_localizacion"])
                ->innerjoin('accion_centralizada_variables_usuarios', 'accion_centralizada_variables_usuarios.id_variable=accion_centralizada_variables.id')
                ->innerjoin('localizacion_acc_variable', 'localizacion_acc_variable.id_variable=accion_centralizada_variables.id')
                ->where(['accion_centralizada_variables_usuarios.id_usuario' =>Yii::$app->user->getId()])
                ->asArray()
                ->all();
                    
                $provider=new ArrayDataProvider([
                'allModels' => $ace,
                'sort' => [
                    'attributes' => ['nombre'],
                ],
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

                return $provider;
    }

    /*
    * Localización de las variables, caso de tener ambitos estadales, municipales o parroquiales
    *
    * @return $arrayprovider
    */
    public function LocalizacionVariables($id)
    {
        $ace = LocalizacionAccVariable::find()  
        ->select("estados.nombre as nombre_estados, id_variable, localizacion_acc_variable.id, accion_centralizada_variables.nombre_variable as nombre")
        ->innerjoin("accion_centralizada_variables", "localizacion_acc_variable.id_variable=accion_centralizada_variables.id")
        ->innerjoin("estados", 'localizacion_acc_variable.id_estado=estados.id')
        ->where(['localizacion_acc_variable.id_variable' => $id])
        ->asArray()
        ->All();
        
        $provider=new ArrayDataProvider([
            'allModels' => $ace,
            'sort' => 
            [
                'attributes' => ['nombre'],
            ],
            'pagination' => 
            [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }
}