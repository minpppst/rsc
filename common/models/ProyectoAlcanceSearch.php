<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProyectoAlcance;

/**
 * ProyectoAlcanceSearch represents the model behind the search form about `app\models\ProyectoAlcance`.
 */
class ProyectoAlcanceSearch extends ProyectoAlcance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_proyecto', 'unidad_medida', 'requiere_accion_no_financiera', 'especifique_con_cual', 'contribuye_complementa', 'especifique_complementa_cual', 'vinculado_otro', 'vinculado_especifique'], 'integer'],
            [['enunciado_problema', 'poblacion_afectada', 'indicador_situacion', 'formula_indicador', 'fuente_indicador', 'fecha_indicador_inicial', 'enunciado_situacion_deseada', 'poblacion_objetivo', 'indicador_situacion_deseada', 'resultado_esperado', 'meta_proyecto', 'denominacion_beneficiario', 'requiere_nombre_institucion', 'requiere_nombre_instancia', 'requiere_mencione_acciones', 'contribuye_nombre_institucion', 'contribuye_nombre_instancia', 'contribuye_mencione_acciones', 'vinculado_nombre_institucion', 'vinculado_nombre_instancia', 'vinculado_nombre_proyecto', 'vinculado_medida', 'obstaculos'], 'safe'],
            [['benficiarios_femeninos', 'beneficiarios_masculinos', 'total_empleos_directos_femeninos', 'total_empleos_directos_masculino', 'empleos_directos_nuevos_femeninos', 'empleos_directos_nuevos_masculino', 'empleos_directos_sostenidos_femeninos', 'empleos_directos_sostenidos_masculino'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProyectoAlcance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_proyecto' => $this->id_proyecto,
            'fecha_indicador_inicial' => $this->fecha_indicador_inicial,
            'unidad_medida' => $this->unidad_medida,
            'benficiarios_femeninos' => $this->benficiarios_femeninos,
            'beneficiarios_masculinos' => $this->beneficiarios_masculinos,
            'total_empleos_directos_femeninos' => $this->total_empleos_directos_femeninos,
            'total_empleos_directos_masculino' => $this->total_empleos_directos_masculino,
            'empleos_directos_nuevos_femeninos' => $this->empleos_directos_nuevos_femeninos,
            'empleos_directos_nuevos_masculino' => $this->empleos_directos_nuevos_masculino,
            'empleos_directos_sostenidos_femeninos' => $this->empleos_directos_sostenidos_femeninos,
            'empleos_directos_sostenidos_masculino' => $this->empleos_directos_sostenidos_masculino,
            'requiere_accion_no_financiera' => $this->requiere_accion_no_financiera,
            'especifique_con_cual' => $this->especifique_con_cual,
            'contribuye_complementa' => $this->contribuye_complementa,
            'especifique_complementa_cual' => $this->especifique_complementa_cual,
            'vinculado_otro' => $this->vinculado_otro,
            'vinculado_especifique' => $this->vinculado_especifique,
        ]);

        $query->andFilterWhere(['like', 'enunciado_problema', $this->enunciado_problema])
            ->andFilterWhere(['like', 'poblacion_afectada', $this->poblacion_afectada])
            ->andFilterWhere(['like', 'indicador_situacion', $this->indicador_situacion])
            ->andFilterWhere(['like', 'formula_indicador', $this->formula_indicador])
            ->andFilterWhere(['like', 'fuente_indicador', $this->fuente_indicador])
            ->andFilterWhere(['like', 'enunciado_situacion_deseada', $this->enunciado_situacion_deseada])
            ->andFilterWhere(['like', 'poblacion_objetivo', $this->poblacion_objetivo])
            ->andFilterWhere(['like', 'indicador_situacion_deseada', $this->indicador_situacion_deseada])
            ->andFilterWhere(['like', 'resultado_esperado', $this->resultado_esperado])
            ->andFilterWhere(['like', 'meta_proyecto', $this->meta_proyecto])
            ->andFilterWhere(['like', 'denominacion_beneficiario', $this->denominacion_beneficiario])
            ->andFilterWhere(['like', 'requiere_nombre_institucion', $this->requiere_nombre_institucion])
            ->andFilterWhere(['like', 'requiere_nombre_instancia', $this->requiere_nombre_instancia])
            ->andFilterWhere(['like', 'requiere_mencione_acciones', $this->requiere_mencione_acciones])
            ->andFilterWhere(['like', 'contribuye_nombre_institucion', $this->contribuye_nombre_institucion])
            ->andFilterWhere(['like', 'contribuye_nombre_instancia', $this->contribuye_nombre_instancia])
            ->andFilterWhere(['like', 'contribuye_mencione_acciones', $this->contribuye_mencione_acciones])
            ->andFilterWhere(['like', 'vinculado_nombre_institucion', $this->vinculado_nombre_institucion])
            ->andFilterWhere(['like', 'vinculado_nombre_instancia', $this->vinculado_nombre_instancia])
            ->andFilterWhere(['like', 'vinculado_nombre_proyecto', $this->vinculado_nombre_proyecto])
            ->andFilterWhere(['like', 'vinculado_medida', $this->vinculado_medida])
            ->andFilterWhere(['like', 'obstaculos', $this->obstaculos]);

        return $dataProvider;
    }
}
