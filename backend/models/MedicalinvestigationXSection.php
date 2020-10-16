<?php

namespace backend\models;

use backend\components\CsActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "medicalinvestigationxsection".
 *
 * @property integer $Id
 * @property integer $MedicalInvestigationId
 * @property integer $UserId
 * @property integer $SectionId
 * @property integer $StatusId
 * @property integer $InternmentId
 * @property integer $Enabled
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property DictionaryDetail $section
 * @property MedicalInvestigation $medicalInvestigation
 * @property User $user
 */
class MedicalInvestigationXSection extends CsActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medicalinvestigationxsection';
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
            [['MedicalInvestigationId', 'UserId', 'SectionId', 'StatusId', 'InternmentId'], 'required'],
            [['MedicalInvestigationId', 'UserId', 'SectionId', 'Enabled'], 'integer'],
            [['SectionId'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['SectionId' => 'Id']],
            [['MedicalInvestigationId'], 'exist', 'skipOnError' => true, 'targetClass' => MedicalInvestigation::className(), 'targetAttribute' => ['MedicalInvestigationId' => 'Id']],
            [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserId' => 'id']],
            [['InternmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Internment::className(), 'targetAttribute' => ['InternmentId' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'MedicalInvestigationId' => 'Investigație',
            'UserId' => 'Utilizator',
            'SectionId' => 'De la Secția',
            'InternmentId' => 'Pentru Internarea',
            'StatusId' => 'Stare',
            'Enabled' => 'Activat',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalInvestigation()
    {
        return $this->hasOne(MedicalInvestigation::className(), ['Id' => 'MedicalInvestigationId']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'SectionId']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternment()
    {
        return $this->hasOne(Internment::className(), ['Id' => 'InternmentId']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'StatusId']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserId']);
    }
}
