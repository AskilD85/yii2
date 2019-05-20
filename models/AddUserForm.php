<?php
 namespace app\models;
 
 use yii\base\Model;
 use yii\db\ActiveRecord;
 
 class AddUserForm extends ActiveRecord{
     
    public $fullname;
    public $password;

    public static function tableName(){
        return 'user';
    }
    public function attributeLabels() {
        return [
            'username'=>'Login',
            'email'=>'E-mail',
            'fullname'=>'ФИО',
            
        ];
        parent::attributeLabels();
    }
    public function rules() {
        return [
            [['fullname','username','email','password'],'required'],
            ['email','email'],
            ['username','string','min'=>3,'max'=>20],
            ['email', 'unique','message' => 'Извините, такой e-mail уже существует в базе данных',],
            ['username', 'unique','message' => 'Извините, такое имя уже существует в базе данных',],
            
           
        ];
        
        parent::rules();
    }
   
 }

