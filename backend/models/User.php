<?php
namespace backend\models;

use backend\components\CsActiveRecord;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use backend\behaviors\UserBehavior;
use yii\web\IdentityInterface;

/**
 * User model
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property integer $Enabled
 *
 * @property Internment[] $InternmentsMedicalAssistant
 * @property Internment[] $InternmentsDoctor
 * @property UserXSection[] $userXSections
 * @property DictionaryDetail $type
 * @property PatientRequest[] $patientRequest
 */
class User extends CsActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $section;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByType($type)
    {
        return static::findOne(['user_type' => $type, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            UserBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['section', 'Enabled'], 'safe'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictionaryDetail::className(), 'targetAttribute' => ['type_id' => 'Id']],
            ['section', 'required', 'on' => 'update', 'message' => 'Trebuie selectată cel puțin o secție'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Tip utilizator',
            'username' => 'Nume utilizator',
            'auth_key' => 'Cheie autentificare',
            'password_hash' => 'Parolă',
            'password_reset_token' => 'Token resetare parolă',
            'email' => 'E-mail',
            'status' => 'Stare',
            'created_at' => 'Creat la',
            'updated_at' => 'Modificat la',
            'section' => 'Secție',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternmentsMedicalAssistant()
    {
        return $this->hasMany(Internment::className(), ['MedicalAssistant' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternmentsDoctor()
    {
        return $this->hasMany(Internment::className(), ['DoctorId' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserXSections()
    {
        return $this->hasMany(UserXSection::className(), ['UserId' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientRequests()
    {
        return $this->hasMany(PatientRequest::className(), ['UserId' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(DictionaryDetail::className(), ['Id' => 'type_id']);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
