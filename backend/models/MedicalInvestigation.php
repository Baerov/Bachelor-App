<?php

namespace backend\models;

use backend\components\CsActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "medicalinvestigation".
 *
 * @property integer $Id
 * @property string $Name
 * @property integer $Enabled
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property MedicalInvestigationXSection[] $medicalinvestigationxsections
 */
class MedicalInvestigation extends CsActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medicalinvestigation';
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
            [['Enabled'], 'integer'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Denumire',
            'Enabled' => 'Activat',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalInvestigationXSections()
    {
        return $this->hasMany(MedicalInvestigationXSection::className(), ['MedicalInvestigationId' => 'Id']);
    }
}
