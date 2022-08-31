<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class SignupForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'users'; //подключается к таблице users
    }
    public function rules()
    {
        return [
            [['password', 'username', 'email'], 'safe'], //правила валидации
        ];
    }


}


