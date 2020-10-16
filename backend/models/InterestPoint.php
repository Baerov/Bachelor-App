<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "InterestPoint".
 *
 * @property integer $Id
 * @property integer $CategoryId
 * @property string $Name
 * @property integer $Enabled
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property DictionaryDetail $category
 * @property InterestPointXPatient[] $interestPointXPatients
 */
class InterestPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interestpoint';
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


            [['CategoryId', 'Name'], 'required'],
            [['Enabled'], 'integer'],
            [['Name'], 'string', 'max' => 255],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['CategoryId' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'CategoryId' => 'Categorie',
            'Name' => 'Nume',
            'Enabled' => 'Activat',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'CategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterestPointXPatients()
    {
        return $this->hasMany(InterestPointXPatient::className(), ['InterestPointId' => 'Id']);
    }
}
