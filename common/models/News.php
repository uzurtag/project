<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $text_ru
 * @property string $text_en
 * @property integer $date
 * @property integer $status
 * @property integer $user_id
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_en', 'text_ru', 'text_en', 'date', 'status', 'user_id'], 'required'],
            [['text_ru', 'text_en'], 'string'],
            [['date', 'status', 'user_id'], 'integer'],
            [['title_ru', 'title_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Title Ru',
            'title_en' => 'Title En',
            'text_ru' => 'Text Ru',
            'text_en' => 'Text En',
            'date' => 'Date',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }
}
