<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProyectoVariableUsuarios;

/**
 * ProyectoVariableUsuariosSearch represents the model behind the search form about `backend\models\ProyectoVariableUsuarios`.
 */
class ProyectoVariableUsuariosSearch extends ProyectoVariableUsuarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_variable', 'id_usuario', 'estatus'], 'integer'],
            [['fecha_creacion', 'fecha_eliminacion'], 'safe'],
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
        $query = ProyectoVariableUsuarios::find();

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
            'id_variable' => $this->id_variable,
            'id_usuario' => $this->id_usuario,
            'estatus' => $this->estatus,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_eliminacion' => $this->fecha_eliminacion,
        ]);

        return $dataProvider;
    }
}
