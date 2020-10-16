<?php

namespace backend\models;

use backend\components\CsActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "DictionaryDetail".
 *
 * @property integer $Id
 * @property string $Name
 * @property string $Code
 * @property string $Value
 * @property integer $Default
 * @property integer $DictionaryId
 * @property integer $Enabled
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Patient[] $Patients
 * @property Patient[] $Patients0
 * @property Dictionary $dictionary
 * @property UserXSECTION[] $userXSECTIONs
 * @property User[] $users
 */
class DictionaryDetail extends CsActiveRecord
{

    const ADMIN = 1;
    const DOCTOR = 2;
    const MEDICAL_ASSISTANT = 3;
    const INTERNMENT_EXTRA_STATUS_ACTIVE = 4;
    const INTERNMENT_EXTRA_STATUS_INACTIVE = 5;
    const PATIENT_STATUS_NEW = 6;
    const GENERAL_STATUS_NEW = 7;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dictionarydetail';
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
            [['Name'], 'required'],
            [['Name', 'Code', 'Value'], 'string', 'max' => 255],
            [['DictionaryId'], 'exist', 'skipOnError' => true, 'targetClass' => Dictionary::className(), 'targetAttribute' => ['DictionaryId' => 'Id']],
            [['Enabled'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Nume',
            'Code' => 'Cod',
            'Value' => 'Valoare',
            'Default' => 'Implicit',
            'DictionaryId' => 'ID Dictionar',
            'Enabled' => 'Activat',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientCity()
    {
        return $this->hasMany(Patient::className(), ['CityId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientSection()
    {
        return $this->hasMany(Patient::className(), ['SectionId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientCategory()
    {
        return $this->hasMany(Patient::className(), ['CategoryId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictionary()
    {
        return $this->hasOne(Dictionary::className(), ['Id' => 'DictionaryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserXSections()
    {
        return $this->hasMany(UserXSection::className(), ['SectionId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['type_id' => 'Id']);
    }
}
