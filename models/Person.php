<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $name
 * @property string $emailaddress
 * @property string $picture
 * @property string $register_date
 * @property integer $person_type_id
 * @property integer $tud_id
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'emailaddress', 'picture', 'person_type_id', 'tud_id'], 'required'],
            [['picture'], 'string'],
            [['register_date'], 'safe'],
            [['person_type_id', 'tud_id'], 'integer'],
            [['name', 'emailaddress'], 'string', 'max' => 257]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Internal identifier',
            'name' => 'Name',
            'emailaddress' => 'Emailaddress',
            'picture' => 'Picture',
            'register_date' => 'Register Date',
            'person_type_id' => 'Person Type ID',
            'tud_id' => 'Tud ID',
        ];
    }

    /**
     * Returns the type of this person.
     *
     * @return \yii\db\ActiveQuery PersonType
     */
    public function getPersonType(){
        return $this->hasOne(PersonType::className(), ['person_type_id' => 'id']);
    }


}
