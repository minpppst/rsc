<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto_alcance".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $enunciado_problema
 * @property string $poblacion_afectada
 * @property string $indicador_situacion
 * @property string $formula_indicador
 * @property string $fuente_indicador
 * @property string $fecha_indicador_inicial
 * @property string $enunciado_situacion_deseada
 * @property string $poblacion_objetivo
 * @property string $indicador_situacion_deseada
 * @property string $resultado_esperado
 * @property integer $unidad_medida
 * @property string $meta_proyecto
 * @property double $benficiarios_femeninos
 * @property double $beneficiarios_masculinos
 * @property string $denominacion_beneficiario
 * @property double $total_empleos_directos_femeninos
 * @property double $total_empleos_directos_masculino
 * @property double $empleos_directos_nuevos_femeninos
 * @property double $empleos_directos_nuevos_masculino
 * @property double $empleos_directos_sostenidos_femeninos
 * @property double $empleos_directos_sostenidos_masculino
 * @property integer $requiere_accion_no_financiera
 * @property integer $especifique_con_cual
 * @property string $requiere_nombre_institucion
 * @property string $requiere_nombre_instancia
 * @property string $requiere_mencione_acciones
 * @property integer $contribuye_complementa
 * @property integer $especifique_complementa_cual
 * @property string $contribuye_nombre_institucion
 * @property string $contribuye_nombre_instancia
 * @property string $contribuye_mencione_acciones
 * @property integer $vinculado_otro
 * @property integer $vinculado_especifique
 * @property string $vinculado_nombre_institucion
 * @property string $vinculado_nombre_instancia
 * @property string $vinculado_nombre_proyecto
 * @property string $vinculado_medida
 * @property string $obstaculos
 */
class ProyectoAlcance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_alcance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'enunciado_problema', 'poblacion_afectada', 'indicador_situacion', 'formula_indicador', 'fuente_indicador', 'fecha_indicador_inicial', 'enunciado_situacion_deseada', 'poblacion_objetivo', 'indicador_situacion_deseada', 'resultado_esperado', 'unidad_medida', 'meta_proyecto', 'benficiarios_femeninos', 'beneficiarios_masculinos', 'denominacion_beneficiario', 'total_empleos_directos_femeninos', 'total_empleos_directos_masculino', 'empleos_directos_nuevos_femeninos', 'empleos_directos_nuevos_masculino', 'empleos_directos_sostenidos_femeninos', 'empleos_directos_sostenidos_masculino','requiere_accion_no_financiera','contribuye_complementa','vinculado_otro', 'obstaculos'], 'required'],
            [['id_proyecto', 'unidad_medida', 'requiere_accion_no_financiera',  'contribuye_complementa', 'especifique_complementa_cual', 'vinculado_otro', 'vinculado_especifique'], 'integer'],
            [['enunciado_problema', 'poblacion_afectada', 'indicador_situacion', 'formula_indicador', 'enunciado_situacion_deseada', 'poblacion_objetivo', 'indicador_situacion_deseada', 'resultado_esperado', 'meta_proyecto', 'requiere_mencione_acciones', 'contribuye_mencione_acciones', 'vinculado_nombre_proyecto', 'vinculado_medida', 'obstaculos'], 'string'],
            [['fecha_indicador_inicial'], 'safe'],
            [['benficiarios_femeninos', 'beneficiarios_masculinos', 'total_empleos_directos_femeninos', 'total_empleos_directos_masculino', 'empleos_directos_nuevos_femeninos', 'empleos_directos_nuevos_masculino', 'empleos_directos_sostenidos_femeninos', 'empleos_directos_sostenidos_masculino'], 'number'],
            [['fuente_indicador', 'denominacion_beneficiario'], 'string', 'max' => 45],
            //reglas de campo que dependendientes
            [['especifique_con_cual','requiere_nombre_institucion','requiere_nombre_instancia','requiere_mencione_acciones'], 'required', 'when' => function ($model) {
            return $model->requiere_accion_no_financiera == 1;
            }, 'whenClient' => "function (attribute, value) {
            return $('#proyectoalcance-requiere_accion_no_financiera').val() ==1;
            }"],
            [['contribuye_complementa', 'especifique_complementa_cual','contribuye_nombre_institucion','contribuye_nombre_instancia','contribuye_mencione_acciones'], 'required', 'when' => function ($model) {
            return $model->contribuye_complementa == 1;
            }, 'whenClient' => "function (attribute, value) {
            return $('#proyectoalcance-contribuye_complementa').val() ==1;
            }"],
             [['vinculado_especifique', 'vinculado_nombre_institucion','vinculado_nombre_instancia','vinculado_nombre_proyecto','vinculado_medida'], 'required', 'when' => function ($model) {
            return $model->vinculado_otro == 1;
            }, 'whenClient' => "function (attribute, value) {
            return $('#proyectoalcance-vinculado_otro').val() ==1;
            }"],
            //fin de las reglas de campos dependientes
            
            [['requiere_nombre_institucion', 'requiere_nombre_instancia', 'contribuye_nombre_institucion', 'contribuye_nombre_instancia', 'vinculado_nombre_institucion', 'vinculado_nombre_instancia'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Id Proyecto',
            'enunciado_problema' => 'Enunciado del problema o necesidad',
            'poblacion_afectada' => 'Población afectada',
            'indicador_situacion' => 'Indicador de la situación inicial',
            'formula_indicador' => 'Fórmula del indicador',
            'fuente_indicador' => 'Fuente del indicador',
            'fecha_indicador_inicial' => 'Fecha del indicador de la situación inicial',
            'enunciado_situacion_deseada' => 'Enunciado de la situación deseada',
            'poblacion_objetivo' => 'Población objetivo',
            'indicador_situacion_deseada' => 'Indicador de la situación deseada',
            'resultado_esperado' => 'Resultado esperado',
            'unidad_medida' => 'Unidad de medida',
            'meta_proyecto' => 'Meta del proyecto',
            'benficiarios_femeninos' => 'Número de beneficiarios femeninos',
            'beneficiarios_masculinos' => 'Número de beneficiarios masculinos',
            'denominacion_beneficiario' => 'Denominación del beneficiario',
            'total_empleos_directos_femeninos' => 'Total de empleos directos femeninos',
            'total_empleos_directos_masculino' => 'Total de empleos directos masculinos',
            'empleos_directos_nuevos_femeninos' => 'Empleos directos nuevos femeninos',
            'empleos_directos_nuevos_masculino' => 'Empleos directos nuevos masculinos',
            'empleos_directos_sostenidos_femeninos' => 'Empleos directos sostenidos femeninos',
            'empleos_directos_sostenidos_masculino' => 'Empleos directos sostenidos masculinos',
            'requiere_accion_no_financiera' => '¿Este proyecto requiere acciones no financieras de otra institución o instancia del Poder Popular?',
            'especifique_con_cual' => 'Si es si, especifique con cual',
            'requiere_nombre_institucion' => 'Nombre de la institución',
            'requiere_nombre_instancia' => 'Nombre de la instancia',
            'requiere_mencione_acciones' => 'Mencione las acciones',
            'contribuye_complementa' => '¿Contribuye o complementa acciones de otra institución o instancia del Poder Popular?',
            'especifique_complementa_cual' => 'Si es si, especifique',
            'contribuye_nombre_institucion' => 'Nombre de la institución',
            'contribuye_nombre_instancia' => 'Nombre de la instancia',
            'contribuye_mencione_acciones' => 'Mencione las acciones',
            'vinculado_otro' => '¿Este proyecto está vinculado a otro?',
            'vinculado_especifique' => 'Si es si, especifique',
            'vinculado_nombre_institucion' => 'Nombre de la institución responsable del proyecto con el que este se encuentra vinculado',
            'vinculado_nombre_instancia' => 'Nombre de la instancia responsable del proyecto con el que este se encuentra vinculado',
            'vinculado_nombre_proyecto' => 'Nombre del proyecto con el que se encuentra vinculado',
            'vinculado_medida' => '¿En que medida se encuentran vinculados los proyectos?',
            'obstaculos' => ' ¿Cuáles serían los supuestos obstáculos para la ejecución de este proyecto? Especifique:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'unidad_medida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstanciaInstitucionFinanciera()
    {
        return $this->hasOne(InstanciaInstitucion::className(), ['id' => 'especifique_con_cual']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstanciaInstitucionContribuye()
    {
        return $this->hasOne(InstanciaInstitucion::className(), ['id' => 'especifique_complementa_cual']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstanciaInstitucionVinculado()
    {
        return $this->hasOne(InstanciaInstitucion::className(), ['id' => 'vinculado_especifique']);
    }
}
