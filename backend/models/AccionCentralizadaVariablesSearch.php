<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccionCentralizadaVariables;

/**
 * AccionCentralizadaVariablesSearch represents the model behind the search form about `app\models\AccionCentralizadaVariables`.
 */
class AccionCentralizadaVariablesSearch extends AccionCentralizadaVariables
{
    public $localizacion, $unidad_medida, $nombreEspecifica, $nombreAccion, $codigoAccion;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'responsable', 'meta_programada_variable', 'unidad_ejecutora', 'acc_accion_especifica'], 'integer'],
            [['nombre_variable', 'definicion', 'base_calculo', 'fuente_informacion',  'unidad_medida', 'nombreEspecifica', 'nombreAccion', 'codigoAccion'], 'safe'],
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
        $query = AccionCentralizadaVariables::find();
        $query->joinWith(['unidadMedida']);
        $query->joinWith(['accAccionEspecifica']);
        $query->joinWith(['accAccionEspecifica.idAcCentr']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'unidad_medida' => $this->unidad_medida,
            //'localizacion' => $this->localizacion,
            'responsable' => $this->responsable,
            'meta_programada_variable' => $this->meta_programada_variable,
            'unidad_ejecutora' => $this->unidad_ejecutora,
            'acc_accion_especifica' => $this->acc_accion_especifica,
        ]);

        $query->andFilterWhere(['like', 'nombre_variable', $this->nombre_variable])
            ->andFilterWhere(['like', 'accion_centralizada.codigo_accion', $this->codigoAccion])
            ->andFilterWhere(['like', 'accion_centralizada.nombre_accion', $this->nombreAccion])
            ->andFilterWhere(['like', 'accion_centralizada_accion_especifica.nombre', $this->nombreEspecifica]);
            

        return $dataProvider;
    }
}
