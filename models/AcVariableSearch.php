<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AcVariable;

/**
 * AcVariableSearch represents the model behind the search form about `app\models\AcVariable`.
 */
class AcVariableSearch extends AcVariable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_u_ej'], 'integer'],
            [['nombre_variable'], 'safe'],
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
        $query = AcVariable::find();

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
            'id_u_ej' => $this->id_u_ej,
        ]);

        $query->andFilterWhere(['like', 'nombre_variable', $this->nombre_variable]);

        return $dataProvider;
    }
}
