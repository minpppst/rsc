<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProyectoPedido;

/**
 * ProyectoPedidoSearch represents the model behind the search form about `app\models\ProyectoPedido`.
 */
class ProyectoPedidoSearch extends ProyectoPedido
{
    public $nombreMaterial;
    public $proyectoEspecifica;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_material', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'asignado', 'estatus'], 'integer'],
            [['precio'], 'number'],
            [['fecha_creacion', 'nombreMaterial', 'proyectoEspecifica'], 'safe'],
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
        $query = ProyectoPedido::find();
        // Join para la relacion
        $query->joinWith(['idMaterial']);
        $query->joinWith(['asignado0']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombreMaterial'] = [
            'asc' => ['materiales_servicios.nombre' => SORT_ASC],
            'desc' => ['materiales_servicios.nombre' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'proyecto_pedido.id' => $this->id,
            'id_material' => $this->id_material,
            'enero' => $this->enero,
            'febrero' => $this->febrero,
            'marzo' => $this->marzo,
            'abril' => $this->abril,
            'mayo' => $this->mayo,
            'junio' => $this->junio,
            'julio' => $this->julio,
            'agosto' => $this->agosto,
            'septiembre' => $this->septiembre,
            'octubre' => $this->octubre,
            'noviembre' => $this->noviembre,
            'diciembre' => $this->diciembre,
            'precio' => $this->precio,
            'fecha_creacion' => $this->fecha_creacion,
            'asignado' => $this->asignado,
            'proyecto_pedido.estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like','materiales_servicios.nombre',$this->nombreMaterial]);
        $query->andFilterWhere(['like','proyecto_usuario_asignar.proyecto_especifica',$this->proyectoEspecifica]);

        return $dataProvider;
    }
}
