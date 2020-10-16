<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "PatientInformation".
 *
 * @property integer $Id
 * @property integer $PatientId
 * @property string $Name
 * @property string $Value
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Patient $Patient
 */
class PatientInformation extends \yii\db\ActiveRecord
{

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
    public static function tableName()
    {
        return 'patientinformation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PatientId', 'Name'], 'required'],
            [['Name'], 'string', 'max' => 255],
            [['Value'], 'string', 'max' => 255],
            [['PatientId'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['PatientId' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'PatientId' => 'Pacient',
            'Name' => 'Nume',
            'Value' => 'Valoare',
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
}
