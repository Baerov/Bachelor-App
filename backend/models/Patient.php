<?php

namespace backend\models;

use backend\behaviors\PatientBehavior;
use backend\components\CsActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Patient".
 *
 * @property integer $Id
 * @property integer $CityId
 * @property integer $SectionId
 * @property string $Name
 * @property string $Address
 * @property string $Phone
 * @property string $MobilePhone
 * @property string $Email
 * @property string $Information
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $CategoryId
 * @property integer $Enabled
 * @property string $RecallDate
 * @property integer $StatusId
 *
 * @property Internment[] $Internments
 * @property DictionaryDetail $category
 * @property DictionaryDetail $city
 * @property DictionaryDetail $Section
 * @property InterestPointXPatient[] $interestPointXPatients
 * @property PatientInformation[] $PatientInformations
 * @property PatientRequest[] $PatientRequests
 */
class Patient extends CsActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * @var []
     */
    public $interestPoint;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            PatientBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CityId', 'SectionId', 'Name', 'Address'], 'required'],
            ['Phone', 'lastOneRequired', 'skipOnEmpty'=> false],
            [['Name', 'Address', 'Email'], 'string', 'max' => 255],
            [['Phone', 'MobilePhone'], 'string', 'max' => 20],
            [['CategoryId', 'Information'], 'string', 'on' => 'import'],
            [['CategoryId', 'file'], 'required', 'on' => 'import'],
            [['file'], 'file', 'extensions' => 'xls, xlt, xlm, xlsx, xlsm, xltx, xltm, xlsb, xla, xlam, xll, xlw', 'on'=>'import'],
            [['CityId'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['CityId' => 'Id']],
            [['SectionId'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['SectionId' => 'Id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['CategoryId' => 'Id']],
            [['StatusId'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['StatusId' => 'Id']],
            [['Name', 'CityId', 'SectionId', 'Address'], 'unique', 'targetAttribute' => ['Name', 'CityId', 'SectionId', 'Address']],
            [['Enabled', 'interestPoint', 'RecallDate', 'StatusId'], 'safe']
        ];
    }

    public function lastOneRequired($attribute, $params)
    {
        if (empty($this->Phone) && empty($this->MobilePhone)) {
            $this->addError('Phone','Phone or MobilePhone is missing!');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'CityId' => 'Oraș',
            'SectionId' => 'Secție',
            'Name' => 'Nume',
            'Address' => 'Adresă',
            'Phone' => 'Telefon fix',
            'MobilePhone' => 'Telefon mobil',
            'Email' => 'E-mail',
            'Information' => 'Informație',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
            'CategoryId' => 'Categorie',
            'RecallDate' => 'Dată reprogramare',
            'StatusId' => 'Stare',
            'interestPoint' => 'Puncte de interes',
            'file'=>'Fișier',
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['import'] = ['file', 'CategoryId'];

        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'CityId']);
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
    public function getCategory()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'CategoryId']);
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
    public function getInterestPointXPatients()
    {
        return $this->hasMany(InterestPointXPatient::className(), ['PatientId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternments()
    {
        return $this->hasMany(Internment::className(), ['PatientId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientRequests()
    {
        return $this->hasMany(PatientRequest::className(), ['PatientId' => 'Id']);
    }

}
