<?php
namespace app\models;
     
    use Yii;
    use yii\base\NotSupportedException;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;
    use yii\web\IdentityInterface;
    use app\models\User; 
    /**
     * User model
     *
     * @property integer $id
     * @property string $username
     * @property string $password_hash
     * @property string $password_reset_token
     * @property string $email
     * @property string $auth_key
     * @property integer $status
     * @property integer $created_at
     * @property integer $updated_at
     * @property string $password write-only password
     */
    class User extends ActiveRecord implements IdentityInterface
    {
        const STATUS_DELETED = 0;
        const STATUS_ACTIVE = 10;
     
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
                ['email','email'],
                [['username','email'],'required'],
                
            ];
        }
     
        /**
         * @inheritdoc
         */
        public static function findIdentity($id)
        {
            return static::findOne(['id' => $id]);
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
            return static::findOne(['username' => $username]);
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
        public function getAuthKey()
        {
            return $this->auth_key;
        }
     
        /**
         * @inheritdoc
         */
        public function validateAuthKey($authKey)
        {
            return $this->getAuthKey() === $authKey;
        }
     
        /**
         * Validates password
         *
         * @param string $password password to validate
         * @return bool if password provided is valid for current user
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
        
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'username' => 'Login',
                'fullname' => 'ФИО',
                'email' => 'Email',
                'reg_date' => 'Дата создания',

            ];
        }
    }