<?php

namespace common\models;
use backend\models\ProyectoVariables;
use backend\models\ProyectoVariableLocalizacion;
use backend\models\ProyectoVariableDesbloqueoMes;
use backend\models\ProyectoVariableProgramacion;
use johnitvn\userplus\base\models\UserAccounts;
use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "proyecto_variable_ejecucion".
 *
 * @property integer $id
 * @property integer $id_programacion
 * @property integer $id_usuario
 * @property string $fecha
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
            [['id_usuario', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'numero_ingresado'],
            [['id_usuario','enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'validar_vacio'],
            [['id_programacion', 'id_usuario', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'integer'],
            [['fecha', 'fecha_creacion', 'observacion_enero', 'observacion_febrero', 'observacion_marzo', 'observacion_abril', 'observacion_mayo', 'observacion_junio', 'observacion_julio', 'observacion_agosto', 'observacion_septiembre', 'observacion_octubre', 'observacion_noviembre', 'observacion_diciembre'], 'safe'],
            [['id_programacion'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariableProgramacion::className(), 'targetAttribute' => ['id_programacion' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }


    public function numero_ingresado($attribute){

        if(($this->enero<0 || $this->febrero<0 || $this->marzo<0 || $this->abril<0 || $this->mayo<0 || $this->junio<0 || $this->julio<0 || $this->agosto<0 || $this->septiembre<0 || $this->octubre<0 || $this->noviembre<0 || $this->diciembre<0))
        $this->addError($attribute, 'Error, Necesita Cargar Una Cantidad Positiva');

        
    }

    public function validar_vacio($attribute)
    {
        if($this->enero==NULL && $this->febrero==NULL && $this->marzo==NULL && $this->abril==NULL && $this->mayo==NULL && $this->junio==NULL && $this->julio==NULL && $this->agosto==NULL && $this->septiembre==NULL && $this->octubre==NULL && $this->noviembre==NULL && $this->diciembre==NULL)
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
            'observacion_diciembre' => 'Observación Diciembre',
            'fecha_creacion' => 'Fecha Creacion',
            'trimestre1' => 'Trimestre I',
            'trimestre2' => 'Trimestre II',
            'trimestre3' => 'Trimestre III',
            'trimestre4' => 'Trimestre IV',
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

    /**
    *Busca Las variables Asignadas al usuario actual
    * @return array dataprovider
    */
    public function VariablesAsignadas()
    {
        $ace =ProyectoVariables::find()
        ->select(["proyecto_variables.nombre_variable as nombre_variable","proyecto_variables.id as id", "proyecto_variables.localizacion", "proyecto_variable_localizacion.id as id_localizacion"])
        ->innerjoin('proyecto_variable_usuarios', 'proyecto_variable_usuarios.id_variable=proyecto_variables.id')
        ->innerjoin('proyecto_variable_localizacion', 'proyecto_variable_localizacion.id_variable=proyecto_variables.id')
        ->where(['proyecto_variable_usuarios.id_usuario' => Yii::$app->user->getid()])
        ->asArray()
        ->all();
        
        $provider=new ArrayDataProvider([
            'allModels' => $ace,
            'sort' => [
                'attributes' => ['nombre_variable'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $provider;
    }

    /** Busca la variable asignada al usuario por region(de poseerla)
    * int $id
    * @return array provider
    */
    public function LocalizacionVariables($id){

        $ace = ProyectoVariableLocalizacion::find()
        ->select("estados.nombre as nombre_estados, municipio.nombre as nombre_municipio, parroquia.nombre as nombre_parroquia, id_variable, proyecto_variable_localizacion.id, proyecto_variables.nombre_variable as nombre")
        ->innerjoin("proyecto_variables", "proyecto_variable_localizacion.id_variable=proyecto_variables.id")
        ->innerjoin("estados", 'proyecto_variable_localizacion.id_estado=estados.id')
        ->leftjoin("municipio", 'proyecto_variable_localizacion.id_municipio=municipio.id')
        ->leftjoin("parroquia", 'proyecto_variable_localizacion.id_parroquia=parroquia.id')
        ->where(['proyecto_variable_localizacion.id_variable' => $id])
        ->asArray()
        ->All();
            
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
}
