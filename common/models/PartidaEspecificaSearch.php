<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PartidaEspecifica;

/**
 * EsSearch represents the model behind the search form about `app\models\PartidaEspecifica`.
 */
class PartidaEspecificaSearch extends PartidaEspecifica
{
    public $partidaPartida;
    public $partidaGenerica;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'generica', 'especifica', 'estatus'], 'integer'],
            [['nombre','partidaGenerica', 'partidaPartida'], 'safe'],
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
        $query = PartidaEspecifica::find();
        // Join para la relacion
        $query->joinWith(['idGenerica']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['partidaGenerica'] = [
            'asc' => ['partida_generica.generica' => SORT_ASC],
            'desc' => ['partida_generica.generica' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'generica' => $this->generica,
            'especifica' => $this->especifica,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);
        $query->andFilterWhere(['partida_generica.generica'=> $this->partidaGenerica]);
        $query->andFilterWhere(['partida_partida.partida'=> $this->partidaPartida]);

        return $dataProvider;
    }
}
