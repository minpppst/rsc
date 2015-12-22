<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ObjetivosNacionales;

/**
 * ObjetivosNacionalesSearch represents the model behind the search form about `app\models\ObjetivosNacionales`.
 */
class ObjetivosNacionalesSearch extends ObjetivosNacionales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'objetivo_historico'], 'integer'],
            [['objetivo_nacional'], 'safe'],
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
        $query = ObjetivosNacionales::find();

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
            'objetivo_historico' => $this->objetivo_historico,
        ]);

        $query->andFilterWhere(['like', 'objetivo_nacional', $this->objetivo_nacional]);

        return $dataProvider;
    }
}
