<?php
    namespace app\models;
    use yii\db\ActiveRecord;


class Books extends ActiveRecord
{
    private $book_id;
    private $title;
    private $author;
    private $isbn;
    public $return_date;

    public function rules()
    {
        return [
            [['title', 'author', 'isbn'], 'required'],
            [['title', 'author'], 'string', 'max' => 200],
            [['isbn'], 'string', 'max' => 40],
        ];
    }
}