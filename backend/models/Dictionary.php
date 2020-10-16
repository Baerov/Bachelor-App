<?php

namespace backend\models;

use backend\components\CsActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Dictionary".
 *
 * @property integer $Id
 * @property string $Name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $Enabled

 *
 * @property DictionaryDetail[] $dictionaryDetails
 */
class Dictionary extends CsActiveRecord
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


    const USER_TYPE = 1;
    const PATIENT_STATUS = 2;
    const GENERAL_STATUS = 3;
    const SECTION = 4;
    const CITY = 5;
    const EXTRA_STATUS = 6;
    const PATIENT_CATEGORY = 7;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dictionary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['Name'], 'string', 'max' => 255],
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
            'Enabled' => 'Activat',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictionaryDetails()
    {
        return $this->hasMany(DictionaryDetail::className(), ['DictionaryId' => 'Id']);
    }
}
