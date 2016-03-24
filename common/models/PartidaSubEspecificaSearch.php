<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PartidaSubEspecifica;

/**
 * SeSearch represents the model behind the search form about `app\models\Se`.
 */
class PartidaSubEspecificaSearch extends PartidaSubEspecifica
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'especifica', 'sub_especifica', 'estatus'], 'integer'],
            [['nombre'], 'safe'],
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
        $query = PartidaSubEspecifica::find();

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
            'especifica' => $this->especifica,
            'sub_especifica' => $this->sub_especifica,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
