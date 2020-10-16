<?php

namespace backend\models;

use backend\components\CsActiveRecord;
use backend\search\InternmentSearch;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Internment".
 *
 * @property integer $Id
 * @property integer $DoctorId
 * @property integer $MedicalAssistantId
 * @property integer $Status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $PatientId
 * @property integer $Date
 * @property integer $Comment
 * @property integer $Notification
 * @property integer $ExtraStatus
 * @property integer $Enabled
 *
 * @property Patient $Patient
 * @property User $MedicalAssistant
 * @property User $Doctor
 */
class Internment extends CsActiveRecord
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
        return 'internment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DoctorId', 'MedicalAssistantId', 'Status', 'PatientId', 'Date'], 'required'],
//            [['MedicalAssistantId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['MedicalAssistantId' => 'id']],
//            [['DoctorId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['DoctorId' => 'id']],
            [['ExtraStatus', 'Enabled'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'DoctorId' => 'Medic',
            'MedicalAssistantId' => 'Asistent Medical',
            'Status' => 'Stare',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
            'PatientId' => 'Pacient',
            'Notification' => 'Notificare',
            'ExtraStatus' => 'Status extra',
            'Comment' => 'Detalii/Comentarii',
            'Date' => 'Dată',
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
    public function getMedicalAssistant()
    {
        return $this->hasOne(User::className(), ['id' => 'MedicalAssistantId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(User::className(), ['id' => 'DoctorId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'Status']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtraStatus()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'ExtraStatus']);
    }
    public static function getAccess(){
        $priorityInternmentSearchModel = new InternmentSearch();
        $priorityInternmentDataProvider = $priorityInternmentSearchModel->search(Yii::$app->request->queryParams);
        $startDate = (new \DateTime('now'))->sub(new \DateInterval('P1D'))->format('Y-m-d');
        $priorityInternmentDataProvider->query->andWhere(['<=', 'DATE(Date)', $startDate]);
        $priorityInternmentDataProvider->query->andWhere(['Status' => DictionaryDetail::GENERAL_STATUS_NEW]);
        $priorityInternmentDataProvider->query->orderBy(['Date' => SORT_ASC]);
        if ($priorityInternmentDataProvider->totalCount > 0) {
            return false;
        }
        return true;
    }

}
