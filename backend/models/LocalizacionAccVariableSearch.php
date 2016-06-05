<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LocalizacionAccVariable;

/**
 * LocalizacionAccVariableSearch represents the model behind the search form about `backend\models\LocalizacionAccVariable`.
 */
class LocalizacionAccVariableSearch extends LocalizacionAccVariable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_variable', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'integer'],
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
        $query = LocalizacionAccVariable::find();

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
            'id_variable' => $this->id_variable,
            'id_pais' => $this->id_pais,
            'id_estado' => $this->id_estado,
            'id_municipio' => $this->id_municipio,
            'id_parroquia' => $this->id_parroquia,
        ]);

        return $dataProvider;
    }
}
