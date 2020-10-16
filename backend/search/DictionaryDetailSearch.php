<?php

namespace backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DictionaryDetail;

/**
 * DictionaryDetailSearch represents the model behind the search form about `backend\models\DictionaryDetail`.
 */
class DictionaryDetailSearch extends DictionaryDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Code', 'Value'], 'safe'],
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
        $query = DictionaryDetail::find();

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
            'Default' => $this->Default,
            'DictionaryId' => $this->DictionaryId,
            'Enabled' => $this->Enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Code', $this->Code])
            ->andFilterWhere(['like', 'Value', $this->Value]);

        $query->andWhere(['Enabled' => 1]);
        return $dataProvider;
    }
}
