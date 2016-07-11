<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $country
 * @property string $first_name
 * @property string $last_name
 * @property integer $mobile
 * @property integer $birthday
 * @property string $skype
 * @property integer $user_id
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'first_name', 'last_name', 'mobile', 'birthday', 'skype', /*'user_id'*/], 'required'],
            [['mobile', 'birthday', /*'user_id'*/], 'integer'],
            [['country', 'first_name', 'last_name', 'skype'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'mobile' => 'Mobile',
            'birthday' => 'Birthday',
            'skype' => 'Skype',
            'user_id' => 'User ID',
        ];
    }
}
