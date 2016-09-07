<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ProyectoUsuarioAsignar;

/**
 * ProyectoAsignarSearch represents the model behind the search form about `app\models\ProyectoAsignar`.
 */
class ProyectoUsuarioAsignarSearch extends ProyectoUsuarioAsignar
{
    public $aprobado;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'proyecto_especifica', 'estatus'], 'integer'],
            [['aprobado'], 'safe']
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
        $query = ProyectoUsuarioAsignar::find();

        //Join para la relacion
        $query->joinWith(['aprobado']);

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
            'usuario_id' => $this->usuario_id,
            'proyecto_especifica' => $this->proyecto_especifica,
            'estatus' => 1
        ]);

        //Filtros adicionales
        $query->andFilterWhere(['like','proyecto.aprobado',$this->aprobado]);

        return $dataProvider;
    }
}
