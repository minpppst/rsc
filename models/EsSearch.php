<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Es;

/**
 * EsSearch represents the model behind the search form about `app\models\Es`.
 */
class EsSearch extends Es
{
    public $partidaGe;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ge', 'codigo_es', 'estatus'], 'integer'],
            [['nombre','partidaGe'], 'safe'],
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
        $query = Es::find();
        // Join para la relacion
        $query->joinWith(['idGe']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['partidaGe'] = [
            'asc' => ['ge.codigo_ge' => SORT_ASC],
            'desc' => ['ge.codigo_ge' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_ge' => $this->id_ge,
            'codigo_es' => $this->codigo_es,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);
        $query->andFilterWhere(['ge.codigo_ge'=> $this->partidaGe]);

        return $dataProvider;
    }
}
