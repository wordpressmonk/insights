<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $c_id
 * @property integer $parent_id
 * @property integer $insight_id
 * @property integer $comment_author
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comments $parent
 * @property Comments[] $comments
 * @property Insights $insight
 * @property User $commentAuthor
 */
class Comments extends \yii\db\ActiveRecord
{
	public $replies;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'insight_id', 'comment_author'], 'required'],
            [['parent_id', 'insight_id', 'comment_author'], 'integer'],
			[['text'],'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::className(), 'targetAttribute' => ['parent_id' => 'c_id']],
            [['insight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insight::className(), 'targetAttribute' => ['insight_id' => 'id']],
            [['comment_author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['comment_author' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'C ID',
            'parent_id' => 'Parent ID',
            'insight_id' => 'Insight ID',
            'comment_author' => 'Comment Author',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comments::className(), ['c_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['parent_id' => 'c_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsight()
    {
        return $this->hasOne(Insights::className(), ['id' => 'insight_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'comment_author']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentAuthorProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'comment_author']);
    }
}
