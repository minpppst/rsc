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
            [['id', 'usuario_id', 'proyecto_id', 'accion_especifica_id', 'estatus'], 'integer'],
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
        $query->joinWith(['proyecto']);

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
            'proyecto_id' => $this->proyecto_id,
            'accion_especifica_id' => $this->accion_especifica_id ,
            'proyecto_usuario_asignar.estatus' => 1          
        ]);

        $query->andFilterWhere(['proyecto.aprobado' => $this->aprobado]);

        return $dataProvider;
    }
}
