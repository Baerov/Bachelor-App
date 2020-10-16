<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "PatientRequest".
 *
 * @property integer $Id
 * @property integer $UserId
 * @property integer $PatientId
 * @property string $RecallDate
 * @property integer created_at
 * @property integer $updated_at
 *
 * @property Patient $Patient
 * @property User $user
 */
class PatientRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patientrequest';
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
            [['UserId', 'PatientId'], 'required'],
            [['UserId', 'PatientId'], 'integer'],
            [['RecallDate'], 'safe'],
            [['PatientId'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['PatientId' => 'Id']],
            [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'UserId' => 'Utilizator',
            'PatientId' => 'Pacient',
            'RecallDate' => 'Dată reprogramare',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserId']);
    }
}
