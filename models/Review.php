<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property integer $writer_id
 * @property integer $receiver_id
 * @property integer $vacancy_id
 * @property integer $is_anonymous
 * @property double $score
 * @property string $explanation
 * @property string $creation_date
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['writer_id', 'receiver_id', 'vacancy_id', 'is_anonymous', 'score', 'explanation', 'creation_date'], 'required'],
            [['writer_id', 'receiver_id', 'vacancy_id', 'is_anonymous'], 'integer'],
            [['score'], 'number'],
            [['explanation'], 'string'],
            [['creation_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Internal identifier',
            'writer_id' => 'The person writing the review',
            'receiver_id' => 'The person subject in the review',
            'vacancy_id' => 'The vacancy the review is written for',
            'is_anonymous' => 'Should the from person be anonymous for the receiver',
            'score' => 'The score given by the from person',
            'explanation' => 'The explanation',
            'creation_date' => 'The date on which the review is written',
        ];
    }

    /**
     *
     * Returns the writer Person of this Review
     *
     * @return \yii\db\ActiveQuery Person
     */
    public function getWriter(){
        return $this->hasOne(Person::className(), ['writer_id' => 'id']);
    }

    /**
     * Returns the receiving Person of this Review
     *
     * @return \yii\db\ActiveQuery Person
     */
    public function getReceiver(){
        return $this->hasOne(Person::className(), ['receiver_id' => 'id']);
    }

    /**
     * Returns the Vacancy which indicates the context about the review
     *
     * @return \yii\db\ActiveQuery Vacancy
     */
    public function getVacancy(){
        return $this->hasOne(Vacancy::className(), ['vacancy_id' => 'id']);
    }
}
