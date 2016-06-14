<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccionCentralizadaDesbloqueoMes;

/**
 * AccionCentralizadaDesbloqueoMesSearch represents the model behind the search form about `backend\models\AccionCentralizadaDesbloqueoMes`.
 */
class AccionCentralizadaDesbloqueoMesSearch extends AccionCentralizadaDesbloqueoMes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ejecucion', 'mes'], 'integer'],
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
        $query = AccionCentralizadaDesbloqueoMes::find();

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
            'id_ejecucion' => $this->id_ejecucion,
            'mes' => $this->mes,
        ]);

        return $dataProvider;
    }
}
