<?php

namespace app\models;
use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
    private $user_id;
    private $name;
    private $phone;
    private $email;
    // Array of books that user borrowed
    public $borrowed_books = [];

    public function rules()
    {
        return [
            [['name', 'phone', 'email'], 'required'],
            [['name'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 100],
        ];
    }
}