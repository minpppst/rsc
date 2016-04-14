<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccionCentralizada;

/**
 * AccionCentralizadaSearch represents the model behind the search form about `app\models\AccionCentralizada`.
 */
class AccionCentralizadaSearch extends AccionCentralizada
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['codigo_accion', 'codigo_accion_sne', 'nombre_accion', 'fecha_inicio', 'fecha_fin', 'estatus'], 'safe'],
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
        $query = AccionCentralizada::find();

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
        ]);

        $query->andFilterWhere(['like', 'codigo_accion', $this->codigo_accion])
            ->andFilterWhere(['like', 'codigo_accion_sne', $this->codigo_accion_sne])
            ->andFilterWhere(['like', 'fecha_inicio', $this->fecha_inicio])
            
            ->andFilterWhere(['like', 'fecha_fin', $this->fecha_fin])
            ->andFilterWhere(['like', 'estatus', $this->estatus])
            ->andFilterWhere(['like', 'nombre_accion', $this->nombre_accion]);

        return $dataProvider;
    }
}
