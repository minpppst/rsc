<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UePartidaEntidad;

/**
 * UePartidaEntidadSearch represents the model behind the search form about `backend\models\UePartidaEntidad`.
 */
class UePartidaEntidadSearch extends UePartidaEntidad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ue', 'id_tipo_entidad'], 'integer'],
            [['cuenta', 'partida'], 'safe'],
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
        $query = UePartidaEntidad::find();

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
            'id_ue' => $this->id_ue,
            'id_tipo_entidad' => $this->id_tipo_entidad,
        ]);

        $query->andFilterWhere(['like', 'cuenta', $this->cuenta])
              ->andFilterWhere(['like', 'partida', $this->partida])
              ->groupBy('partida, cuenta');

        return $dataProvider;
    }
}
