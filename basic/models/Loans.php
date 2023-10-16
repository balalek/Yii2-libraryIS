<?php

namespace app\models;
use yii\db\ActiveRecord;

class Loans extends ActiveRecord
{
    private $loan_id;
    private $user_id;
    private $book_id;
    private $loan_date;
    private $return_date;

    public function rules()
    {
        return [
            [['user_id', 'book_id', 'loan_date', 'return_date'], 'required'],
            [['user_id', 'book_id'], 'integer'],
            [['loan_date', 'return_date'], 'safe'],
        ];
    }
}