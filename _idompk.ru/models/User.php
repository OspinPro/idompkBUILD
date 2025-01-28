<?php

namespace app\models;

/**
 * This is the model class for table "Users".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $role
 */

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'email', 'role'], 'required'],
            [['date_aut', 'date_last'], 'safe'],
            [['name', 'password', 'email'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 50],
            [['authKey', 'accessToken'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'password' => 'Password',
            'email' => 'Email',
            'date_aut' => 'Date Aut',
            'date_last' => 'Date Last',
            'role' => 'Role',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    public static function findIdentity($id)
    {
      if($_COOKIE['moment_auth_sha'])
      {
        $usr = self::findOne($id);
        if($usr && $usr->accessToken==$_COOKIE['moment_auth_sha'])
          return new static($usr);
      }
      return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = self::find()->where(['accessToken'=>$token])->one();
        if (!empty($user)) {
                return new static($user);
            }

        return null;
    }

    /**
     * Finds user by login
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        $user = self::find()->where(['email'=>$email])->one();
        if (!empty($user)) {
            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
