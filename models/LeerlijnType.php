<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leerlijn_type".
 *
 * @property integer $id
 * @property string $leerlijn
 */
class LeerlijnType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leerlijn_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leerlijn'], 'required'],
            [['leerlijn'], 'string', 'max' => 257]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Internal identifier',
            'leerlijn' => 'The leerlijn waar een vak onder valt',
        ];
    }
}
