<?php

namespace backend\search;

use backend\models\DictionaryDetail;
use backend\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Internment;
use yii\helpers\ArrayHelper;

/**
 * InternmentSearch represents the model behind the search form about `backend\models\Internment`.
 */
class InternmentSearch extends Internment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'DoctorId', 'MedicalAssistantId', 'Status', 'PatientId'], 'safe'],
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
        $query = Internment::find();

        // add conditions that should always apply here
        $model = User::findOne(Yii::$app->user->getId());
        if ($model->type_id == DictionaryDetail::DOCTOR) {
            $query->andWhere(['DoctorId' => $model->id]);
        }
        if ($model->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {
            $query->andWhere(['MedicalAssistantId' => $model->id]);
        }

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
            'DoctorId' => $this->DoctorId,
            'MedicalAssistantId' => $this->MedicalAssistantId,
            'Status' => $this->Status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'PatientId' => $this->PatientId,
        ]);

        $query->andWhere(['Enabled' => 1]);
        return $dataProvider;
    }
}
