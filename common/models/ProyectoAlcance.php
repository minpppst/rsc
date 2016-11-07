<?php

namespace common\models;

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
            [['id_proyecto', 'formula_indicador', 'fuente_indicador', 'unidad_medida', 'meta_proyecto','empleos_directos_nuevos_femeninos', 'empleos_directos_nuevos_masculino', 'empleos_directos_sostenidos_femeninos', 'empleos_directos_sostenidos_masculino', 'relacion_instituciones', 'beneficiarios', 'objetivo_estrategico_institucional', 'objetivo_especifico_proyecto','causas_criticas_proyecto', 'problemas_aborda_proyecto','consecuencias_problema','justificacion_proyecto','alcance_proyecto','descripcion_situacion_actual', 'fecha_ultima_data', 'situacion_objetivo', 'meta_proyecto', 'tiempo_impacto', 'servicio_bien', 'tipo_impacto', 'cualitativa_efectos', 'importancia', 'mitigar_impacto_ambiental', 'balance_servicio_energetico', 'programacion_anual_consumidor'], 'required'],
            [['id_proyecto', 'unidad_medida'], 'integer'],
            [['formula_indicador', 'meta_proyecto', 'causas_criticas_proyecto', 'problemas_aborda_proyecto','consecuencias_problema', 'justificacion_proyecto', 'alcance_proyecto', 'descripcion_situacion_actual'], 'string'],
            [['empleos_directos_nuevos_femeninos', 'empleos_directos_nuevos_masculino', 'empleos_directos_sostenidos_femeninos', 'empleos_directos_sostenidos_masculino', 'beneficiarios_femeninos', 'beneficiarios_masculinos', 'beneficiarios'], 'number'],
            [['fuente_indicador'], 'string', 'max' => 45],
                        
            
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
            'relacion_instituciones' => 'Relación con instituciones (conexiones interinstitucionales para la ejecución del proyecto)',
            'empleos_directos_nuevos_femeninos' => 'Empleos directos nuevos femeninos',
            'empleos_directos_nuevos_masculino' => 'Empleos directos nuevos masculinos',
            'empleos_directos_sostenidos_femeninos' => 'Empleos directos sostenidos femeninos',
            'empleos_directos_sostenidos_masculino' => 'Empleos directos sostenidos masculinos',
            'beneficiarios_masculinos' => 'Beneficiarios Masculinos',
            'beneficiarios_femeninos' => 'Beneficiarios Femeninos',
            'beneficiarios' => 'Total Beneficiarios',
            'objetivo_estrategico_institucional' => 'Objetivo Estratégico Institucional',
            'objetivo_especifico_proyecto' => 'Objetivo Específico del Proyecto',
            'causas_criticas_proyecto' => 'Causas del problema que se aborda con el proyecto (causas críticas)',
            'problemas_aborda_proyecto' => 'Problemas que se abordan con el proyecto',
            'consecuencias_problema' => 'Consecuencias del Problema',
            'justificacion_proyecto' => 'Justificación del proyecto',
            'alcance_proyecto' => 'Alcance del Proyecto',
            'descripcion_situacion_actual' => 'Descripcion de la situación actual del problema',
            'formula_indicador' => 'Fórmula del indicador',
            'fuente_indicador' => 'Fuente del indicador',
            'fecha_ultima_data' => 'Fecha la última data',
            'situacion_objetivo' => 'Situación Objetivo',
            'meta_proyecto' => 'Meta del proyecto',
            'tiempo_impacto' => 'Tiempo de Impacto',
            'servicio_bien' => 'Descripción del Bien o Servicio (Resultados)',
            'unidad_medida' => 'Unidad de medida',
            'tipo_impacto' => 'Tipo De Impacto Ambiental',
            'cualitativa_efectos' => 'Caracterización cualitativa de los efectos',
            'importancia' => 'Importancia',
            'mitigar_impacto_ambiental' => '¿Cúales serán las medidas para mitigar o eliminar los impactos ambientales de este proyecto?',
            'balance_servicio_energetico' => 'Balance Estimado Nacional de Servicios Energéticos',
            'programacion_anual_consumidor' => 'Programación Anual por Consumidor',


        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
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
    public function getTipoImpacto()
    {
        return $this->hasOne(TipoImpacto::className(), ['id' => 'tipo_impacto']);
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

    /**
     * Obtener la meta del proyecto
     * @return null | int Cantidad total de la meta del proyecto
     */
    /*
    public function getMeta()
    {
        if(empty($this->proyecto->accionesEspecificas))
        {
            return null;
        }

        return $this->proyecto->accionesEspecificas;
    }
    */

        /**
     * Antes de guardar en BD
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //Cambiar el formato de las fechas
            $formato = 'd/m/Y';
            $inicio = date_create_from_format($formato,$this->fecha_ultima_data);

            if($inicio != false)
            {
                $this->fecha_ultima_data = date_format($inicio,'Y-m-d');
            }
            
            return true;
        } 
        else
        {
            return false;
        }
    }
    

}
