<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person_type".
 *
 * @property integer $id
 * @property string $type
 */
class PersonType extends \yii\db\ActiveRecord
{

    /**
     * Must be the same as in the DATABASE!!!
     */
    const ADMINISTRATOR = 2;
    const EMPLOYEE = 1;
    const STUDENT = 0;
    const SUPERUSER = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 100],
            [['type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

}
