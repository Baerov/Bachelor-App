<?php

namespace backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InterestPointXPatient;

/**
 * InterestPointXPatientSearch represents the model behind the search form about `backend\models\InterestPointXPatient`.
 */
class InterestPointXPatientSearch extends InterestPointXPatient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'InterestPointId', 'PatientId', 'Enabled', 'created_at', 'updated_at'], 'integer'],
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
        $query = InterestPointXPatient::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'InterestPointId' => $this->InterestPointId,
            'PatientId' => $this->PatientId,
            'Enabled' => $this->Enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
