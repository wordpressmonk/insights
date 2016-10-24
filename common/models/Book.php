<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $book_id
 * @property string $title
 * @property string $author
 * @property integer $user_id
 * @property string $url
 * @property string $isbn
 * @property string $image
 * @property string $description
 *
 * @property BookTags[] $bookTags
 * @property User $user
 * @property Insights[] $insights
 */
class Book extends \yii\db\ActiveRecord
{
	public $tags;
	public $cover_image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'author', 'tags'], 'required'],
            [['book_id', 'user_id'], 'integer'],
            [['title', 'author'], 'string', 'max' => 1000],
			[['url', 'isbn','description','image'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
			[['cover_image'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'title' => 'Title',
            'author' => 'Author',
            'user_id' => 'User ID',
			'url' => 'Url',
			'isbn' => 'ISBN',
			'description' => 'Description',
			'image' => 'Image'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookTags()
    {
        return $this->hasMany(BookTag::className(), ['book_id' => 'book_id']);
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
    public function getInsights()
    {
        return $this->hasMany(Insight::className(), ['book_id' => 'book_id']);
    }
}
