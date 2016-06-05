<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResponsableAccVariable;

/**
 * ResponsableAccVariableSearch represents the model behind the search form about `app\models\ResponsableAccVariable`.
 */
class ResponsableAccVariableSearch extends ResponsableAccVariable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cedula', 'id_variable'], 'integer'],
            [['nombre', 'email', 'telefono', 'oficina'], 'safe'],
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
        $query = ResponsableAccVariable::find();

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
            'cedula' => $this->cedula,
            'id_variable' => $this->id_variable,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'oficina', $this->oficina]);

        return $dataProvider;
    }
}
