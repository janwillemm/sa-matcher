<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_type".
 *
 * @property integer $id
 * @property string $type
 */
class WorkType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 257]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Internal identifier',
            'type' => 'The type of work',
        ];
    }
}
