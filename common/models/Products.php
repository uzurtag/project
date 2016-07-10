<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_en
 * @property string $logo
 * @property integer $status
 * @property integer $price
 * @property integer $count
 * @property integer $date_create
 * @property integer $date_update
 * @property integer $tag_id
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_en', 'description_ru', 'description_en', 'logo', 'status', 'price', 'count', 'date_create', 'date_update', 'tag_id'], 'required'],
            [['description_ru', 'description_en'], 'string'],
            [['status', 'price', 'count', 'date_create', 'date_update'], 'integer'],
            [['title_ru', 'title_en', 'logo'], 'string', 'max' => 255],
            [['tag_id'], 'safe'],
            [['logo'], 'file', 'extensions' => 'jpg, png'],
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
            'description_ru' => 'Description Ru',
            'description_en' => 'Description En',
            'logo' => 'Logo',
            'status' => 'Status',
            'price' => 'Price',
            'count' => 'Count',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'tag_id' => 'Tag ID',
        ];
    }


    public function getRelationTag()
    {
        return $this->hasMany(RelationTag::classname(), ['product_id' => 'id']);
    }

    public function getTag()
    {
        return $this->hasMany(Tag::classname(), ['id' => 'tag_id'])->via('relationTag');
    }
}
