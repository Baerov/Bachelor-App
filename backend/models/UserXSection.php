<?php

namespace backend\models;

use backend\components\CsActiveRecord;
use Yii;

/**
 * This is the model class for table "UserXSection".
 *
 * @property integer $Id
 * @property integer $UserId
 * @property integer $SectionId
 * @property integer $Enabled
 *
 * @property User $user
 * @property DictionaryDetail $section
 */
class UserXSection extends CsActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userxsection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId', 'SectionId'], 'required'],
            [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserId' => 'id']],
            [['SectionId'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['SectionId' => 'Id']],
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
            'UserId' => 'Utilizator',
            'SectionId' => 'Secție',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'SectionId']);
    }
}
