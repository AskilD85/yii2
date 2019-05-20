<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $user
 * @property string $email
 * @property string $reg_date
 * @property string $status
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_date'], 'safe'],
            [['user', 'email'], 'string','min'=>6, 'max' => 20],
            [['status'], 'string', 'max' => 10],
            ['email','email'],
            ['email', 'unique','targetAttribute' => 'email','message' => 'Извините, такой e-mail уже существует в базе данных',]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'ФИО',
            'email' => 'Email',
            'reg_date' => 'Дата заявки',
            'status' => 'Статус',
        ];
    }
}
