<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "InterestPointXPatient".
 *
 * @property integer $Id
 * @property integer $InterestPointId
 * @property integer $PatientId
 * @property integer $Enabled
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Patient $patient
 * @property InterestPoint $interestPoint
 */
class InterestPointXPatient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interestpointxpatient';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['InterestPointId', 'PatientId'], 'required'],
            [['InterestPointId', 'PatientId', 'Enabled'], 'integer'],
            [['PatientId'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['PatientId' => 'Id']],
            [['InterestPointId'], 'exist', 'skipOnError' => true, 'targetClass' => InterestPoint::className(), 'targetAttribute' => ['InterestPointId' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'InterestPointId' => 'Punct de interes',
            'PatientId' => 'Nume pacient',
            'Enabled' => 'Activat',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['Id' => 'PatientId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterestPoint()
    {
        return $this->hasOne(InterestPoint::className(), ['Id' => 'InterestPointId']);
    }
}
