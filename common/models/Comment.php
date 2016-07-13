<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $title
 * @property string $comment
 * @property integer $date
 * @property integer $status
 * @property integer $parrent_id
 * @property integer $product_id
 * @property integer $user_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string'],
            [['date', 'status', 'parrent_id', 'product_id', 'user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'comment' => 'Comment',
            'date' => 'Date',
            'status' => 'Status',
            'parrent_id' => 'Parrent ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
