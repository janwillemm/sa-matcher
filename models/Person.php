<?php

namespace app\models;

use Yii;
use yii\base\ErrorException;
use yii\helpers\Url;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $name
 * @property string $emailaddress
 * @property string $picture
 * @property string $register_date
 * @property integer $person_type_id
 * @property string $tud_id
 */
class Person extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['name', 'emailaddress', 'person_type_id', 'tud_id'], 'required'],
            [['picture', 'tud_id'], 'string'],
            [['register_date'], 'safe'],
            [['person_type_id', 'id'], 'integer'],
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
        return $this->hasOne(PersonType::className(), ['id' => 'person_type_id']);
    }

    /**
     * Returns all vacancies this person has
     *
     * @return \yii\db\ActiveQuery Vacancy
     */
    public function getVacancies(){
        return $this->hasMany(Vacancy::className(), ['id' => 'vacancy_id'])->viaTable('person_vacancy_role', ['person_id' => 'id']);
    }

    /**
     * Returns all courses this person has a role to.
     *
     * @return \yii\db\ActiveQuery Person
     */
    public function getCoursesForRole($role){
        return Course::find()
            ->innerJoin("person_course_role", 'course.id = person_course_role.course_id')
            ->where(["person_course_role.person_id" => $this->getId()])
            ->andWhere(["person_course_role.role_id" => $role])->all();

    }

    /**
     * Get avg score
     */

    public function getReviewScore(){
        return round(Review::find()->where(['writer_id' => $this->getPrimaryKey() ])->average('score'), 1,PHP_ROUND_HALF_UP);
    }

    /**
     * return the course preferences of a student
     * @return $this
     */
    public function getWorkPreferences(){
        return $this->hasMany(WorkType::className(), ['id' => 'work_type_id'])
            ->viaTable('student_work_preference', ['student_id' => 'id'])->all();
    }

    public function getPeriodPreferences(){
        return $this->hasMany(PeriodType::className(), ['id' => 'period_type_id'])
            ->viaTable('student_period_preference', ['student_id' => 'id'])->all();
    }

    public function getCoursePreferences(){
        return $this->hasMany(Course::className(), ['id' => 'course_type_id'])
            ->viaTable('student_course_preference', ['student_id' => 'id'])->all();
    }



    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // // Not used
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        $this->getAuthKey();
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function isAllowed($role){
        return $this->personType->id == $role;
    }

    public function isStudent(){
        return $this->personType->id == PersonType::STUDENT;
    }

    public function isEmployee(){
        return $this->personType->id == PersonType::EMPLOYEE;
    }

    public function isReviewed(){
        
    }

    // Creates a person with TUD information
    //$tud = ["uid" => "", "email" => "", "name" => "", "affliation" => ""];
    public static function createPerson($tud){
        $person = new Person();

        $person->updatePerson($tud);

        return $person;

    }

    public function updatePerson($tud){
        $this->name = $tud['name'];
        $this->emailaddress = $tud['email'];
        $this->register_date = time();
        $this->tud_id = $tud['uid'];
        switch($tud['affliation']){
            case "student":
                $affliation = PersonType::STUDENT;
                break;
            case 'employee':
                $affliation = PersonType::EMPLOYEE;
                break;
            default:
                throw new ErrorException("You are not allowed to use this system. (Or it is not implemented yet");
                return;
        }

        $this->person_type_id =$affliation;

        if(!$this->save(true)){
            // TODO: Should never happen!
            throw new ErrorException("You should code better");
        }
    }
}
