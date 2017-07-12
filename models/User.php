<?php

namespace app\models;

use Yii;
use yii\base\Security;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $username
 * @property string $password
 * @property string $isActive
 * @property string $auth_key
 * @property string $access_token
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends Model implements \yii\web\IdentityInterface {

    private $security;
    public $newPassword;
    public $verifyNewPassword;

    public function __construct($config = array()) {
        parent::__construct($config);

        $this->security = new Security();
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'username'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['img'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 20],
            [['password', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['isActive'], 'string', 'max' => 1],
            [['newPassword', 'verifyNewPassword'], 'string', 'min' => 6, 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'img' => Yii::t('app', 'Img'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'isActive' => Yii::t('app', 'Is Active'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function beforeSave($insert) {

        $this->securingPassword();
        $this->generateAuthKey();

        return parent::beforeSave($insert);
    }

    public function getAuthKey(): string {
        return $this->auth_key;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey): bool {
        return $this->auth_key === $authKey;
    }

    public static function findIdentity($id): \yii\web\IdentityInterface {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): \yii\web\IdentityInterface {
        return self::findOne(['access_token' => $token]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return password_verify($password, $this->password);
    }

    private function generateAuthKey() {
        $this->auth_key = $this->security->generateRandomKey();
    }

    private function securingPassword() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return self::findOne(['username' => $username, 'isActive' => '1']);
    }

    public static function resetAccount($id) {
        $admin = self::findOne(['username' => 'admin']);
        $user = self::findOne($id);

        $user->updateAll(['isActive' => 0]);
        $admin->updateAll(['isActive' => 1]);

        return TRUE;
    }

}
