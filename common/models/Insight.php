<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "insights".
 *
 * @property integer $id
 * @property integer $book_id
 * @property integer $user_id
 * @property string $text
 * @property string $keywords
 * @property integer $status
 *
 * @property Books $book
 */
class Insight extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'user_id', 'text', 'keywords','title'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['text'], 'string'],
            [['keywords'], 'string', 'max' => 500],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'user_id' => 'User ID',
			'title' => 'Title',
            'text' => 'Text',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['book_id' => 'book_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
    }
}
