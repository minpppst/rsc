<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form about `app\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estatus_proyecto', 'situacion_presupuestaria', 'clasificacion_sector', 'sub_sector', 'plan_operativo', 'objetivo_estrategico'], 'integer'],
            [['codigo_proyecto', 'codigo_sne', 'nombre', 'descripcion'], 'safe'],
            [['monto_proyecto'], 'number'],
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
        $query = Proyecto::find();

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
            'estatus_proyecto' => $this->estatus_proyecto,
            'situacion_presupuestaria' => $this->situacion_presupuestaria,
            'monto_proyecto' => $this->monto_proyecto,
            'clasificacion_sector' => $this->clasificacion_sector,
            'sub_sector' => $this->sub_sector,
            'plan_operativo' => $this->plan_operativo,
            'objetivo_estrategico' => $this->objetivo_estrategico,
        ]);

        $query->andFilterWhere(['like', 'codigo_proyecto', $this->codigo_proyecto])
            ->andFilterWhere(['like', 'codigo_sne', $this->codigo_sne])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
