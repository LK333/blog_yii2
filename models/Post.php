<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts'; //подключается к таблице posts
    }
    public function rules()
    {
        return [
            [['name', 'text', 'author'], 'safe'], //правила валидации
        ];
    }
}


