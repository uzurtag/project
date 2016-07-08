<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }



    /*
    Связь через промежуточную таблицу;
    */
    public function getRelationTag()
    {
        return $this->hasMany(RelationTag::classname(), ['tag_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Products::classname(), ['id' => 'product_id'])->via('relationTag');
    }
}
